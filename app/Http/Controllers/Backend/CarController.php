<?php

namespace App\Http\Controllers\Backend;

use App\Models\Car;
use App\Models\Brand;
use App\Models\CarImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('brand', 'images')->orderBy('id', 'desc')->get();

        return view('backend.car.index', compact('cars'));
    }

    public function create()
    {
        $brands = Brand::select('id', 'name')->get();
        return view('backend.car.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'police_number' => 'required|unique:cars,plat_nomor',
            'status' => 'required',
            'rent_price' => 'required|numeric',
            'capacity' => 'required|numeric',
            'fuel' => 'required',
            'transmission' => 'required',
            'primary_image' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $car = Car::create([
                'brand_id' => $request->brand,
                'model' => $request->model,
                'tahun' => $request->year,
                'plat_nomor' => $request->police_number,
                'harga_sewa' => $request->rent_price,
                'jumlah_kursi' => $request->capacity,
                'bahan_bakar' => $request->fuel,
                'transmission' => $request->transmission,
                'status' => $request->status,
                'slug' => Str::slug($request->model . ' ' . $request->year) . '-' . uniqid(),
            ]);

            $imageRecords = [];
            $images = $request->file('images');

            foreach ($images as $index => $image) {
                $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('cars', $filename, 'public');

                $imageRecords[] = [
                    'car_id' => $car->id,
                    'image' => $filename,
                    'is_primary' => $index == $request->primary_image,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            CarImage::insert($imageRecords);

            DB::commit();

            session()->flash('success', 'Car created successfully.');
            return redirect()->route('car.index');
        } catch (\Exception $e) {
            DB::rollback();

            // Clean up any uploaded files in case of failure
            foreach ($imageRecords ?? [] as $record) {
                Storage::delete('cars/' . $record['image']);
            }

            session()->flash('errors', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $car = Car::with('images')->findOrFail($id);
        $brands = Brand::select('id', 'name')->get();

        return view('backend.car.edit', compact('car', 'brands'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $car = Car::findOrFail($id);

            // Update car details
            $car->update([
                'brand_id' => $request->brand,
                'model' => $request->model,
                'tahun' => $request->year,
                'plat_nomor' => $request->police_number,
                'harga_sewa' => $request->rent_price,
                'jumlah_kursi' => $request->capacity,
                'bahan_bakar' => $request->fuel,
                'transmission' => $request->transmission,
                'status' => $request->status,
            ]);

            // Handle deleted images
            if ($request->deleted_images) {
                $deletedImageIds = json_decode($request->deleted_images);
                foreach ($deletedImageIds as $imageId) {
                    $image = CarImage::find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete('cars/' . $image->image);
                        $image->delete();
                    }
                }
            }

            // Handle new images
            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $index => $imageFile) {
                    $imageFile->store('cars', 'public');
                    $filename = $imageFile->hashName();

                    $isPrimary = false;
                    if ($request->primary_image_id === 'new_' . $index) {
                        $isPrimary = true;
                        CarImage::where('car_id', $car->id)->update(['is_primary' => false]);
                    }

                    CarImage::create([
                        'car_id' => $car->id,
                        'image' => $filename,
                        'is_primary' => $isPrimary
                    ]);
                }
            }

            // Update primary image if it's an existing image
            if ($request->primary_image_id && !str_starts_with($request->primary_image_id, 'new_')) {
                CarImage::where('car_id', $car->id)->update(['is_primary' => false]);
                CarImage::where('id', $request->primary_image_id)->update(['is_primary' => true]);
            }

            DB::commit();

            session()->flash('success', 'Car updated successfully.');
            return redirect()->route('car.index');
        } catch (\Exception $e) {
            DB::rollback();

            // Delete any newly uploaded files if transaction failed
            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $imageFile) {
                    Storage::disk('public')->delete('cars/' . $imageFile->hashName());
                }
            }

            session()->flash('errors', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $car = Car::findOrFail($id);
            $imagePaths = $car->images->pluck('image')->toArray();
            $car->delete();
            
            DB::commit();

            foreach ($imagePaths as $image) {
                Storage::disk('public')->delete('cars/' . $image);
            }

            session()->flash('success', 'Car deleted successfully.');
            return redirect()->route('car.index');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('errors', $e->getMessage());
            return redirect()->back();
        }
    }
}
