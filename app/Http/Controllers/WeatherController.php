<?php

namespace App\Http\Controllers;

use App\Models\WeatherModel;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index()
    {
        $weather = WeatherModel::all();

        return view('admin.weather', compact('weather'));
    }

    public function saveCity(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'temperature' => 'required|numeric',
        ]);

        WeatherModel::create([
            'city' => $request->get('city'),
            'temperature' => $request->get('temperature'),
        ]);

        return redirect()->back();
    }

    public function deleteCity(WeatherModel $city)
    {
        $city->delete();

        return redirect()->back();
    }

    public function getCity(WeatherModel $city)
    {
        return view('admin.editCity', compact('city'));
    }

    public function updateCity(Request $request, WeatherModel $city)
    {
        $request->validate([
            'city' => 'required|string',
            'temperature' => 'required|numeric',
        ]);

        $city->update([
            'city' => $request->get('city'),
            'temperature' => $request->get('temperature'),
        ]);

        return redirect()->back();
    }

    public function showWeather()
    {
        $weather = WeatherModel::all();

        return view('showWeather', compact('weather'));
    }
}
