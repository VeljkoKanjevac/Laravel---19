<?php

namespace App\Http\Controllers;

use App\Models\ForecastsModel;
use Illuminate\Http\Request;

class AdminForecastsController extends Controller
{
    public function createForecast(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'temperature' => 'required|numeric',
            'weather_type' => 'required|in:sunny,rainy,snowy',
            'probability' => 'required|numeric|min:1|max:100',
            'forecast_date' => 'required|date',
        ]);

        $weather_type = $request->get('weather_type');
        if($weather_type === 'rainy' || $weather_type === 'snowy')
        {
            $probability = $request->get('probability');
        }
        else
        {
            $probability = null;
        }

        ForecastsModel::create([
            'city_id' => $request->get('city_id'),
            'temperature' => $request->get('temperature'),
            'weather_type' => $weather_type,
            'probability' => $probability,
            'forecast_date' => $request->get('forecast_date'),
        ]);

        return redirect()->back();
    }
}
