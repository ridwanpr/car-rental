<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\Brand;
use App\Models\BookingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarListController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with('brand', 'images')
            ->where('status', Car::STATUS_ACTIVE)
            ->orderBy('id', 'desc');

        if ($request->has('carBrand') && $request->carBrand != 'Car Brand') {
            $query->where('brand_id', $request->carBrand);
        }

        if ($request->has('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->has('fuelType')) {
            $query->where('bahan_bakar', $request->fuelType);
        }

        $cars = $query->get();

        return view('frontend.car-list.index', compact('cars'));
    }

    public function show($slug)
    {
        $car = Car::with('brand', 'images')
            ->where('slug', $slug)
            ->first();

        if (!$car) {
            abort(404);
        }

        $isInBookingList = BookingList::where('user_id', auth()->id())
            ->where('car_id', $car->id)
            ->exists();

        return view('frontend.car-list.show', compact('car', 'isInBookingList'));
    }
}
