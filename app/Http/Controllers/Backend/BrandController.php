<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('backend.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Brand::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Brand created successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update([
            'name' => $request->name,
        ]);
        session()->flash('success', 'Brand updated successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        session()->flash('success', 'Brand deleted successfully.');
        return redirect()->back();
    }
}
