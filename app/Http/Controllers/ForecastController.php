<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index($city)
    {
        $forecasts = [
            "beograd" => [22, 21, 22, 24, 25],
            "sarajevo" => [19, 18, 22, 20, 21],
        ];

        $city = strtolower($city);

        if(!array_key_exists($city, $forecasts))
        {
            die("Ovaj grad ne postoji!");
        }

        dd($forecasts[$city]);

    }
}
