<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\BookingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        if (!$car) {
            abort(404);
        }
        
        $isInBookingList = BookingList::where('user_id', auth()->id())
            ->where('car_id', $car->id)
            ->exists();

        return view('frontend.car-list.show', compact('car', 'isInBookingList'));
    }
}
