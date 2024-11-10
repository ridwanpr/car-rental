<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarListController extends Controller
{
    public function index()
    {
        $cars = Car::with('brand', 'images')
            ->where('status', Car::STATUS_ACTIVE)
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.car-list.index', compact('cars'));
    }

    public function show($slug)
    {
        $car = Car::with('brand', 'images')
            ->where('slug', $slug)
            ->first();

        return view('frontend.car-list.show', compact('car'));
    }
}
