<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'cars' => Car::limit(6)->get(),
        ]);
    }
}
