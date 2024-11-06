<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return view('backend.car.index');
    }

    public function create()
    {
        $brands = Brand::select('id', 'name')->get();
        return view('backend.car.create', compact('brands'));
    }
}
