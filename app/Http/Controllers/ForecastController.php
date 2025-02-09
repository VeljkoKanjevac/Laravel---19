<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {

        return view('forecasts', compact('city'));

    }

    public function search(Request $request)
    {
        $cityName = $request->get("city");

        Artisan::call("weather:get-real", ['city' => $cityName]);

        $cities = CitiesModel::with("todayForecast")
            ->where('name', 'like', "%$cityName%")
            ->get();

        if (count($cities) == 0) {
            return redirect()->back()->with("error", "Nismo pronasli gradove koji odgovaraju pretrazi.");
        }

        $userFavourites = [];

        if (Auth::check()) {
            $userFavourites = Auth::user()->cityFavourites;
            $userFavourites = $userFavourites->pluck('city_id')->toArray();
        }

        return view('search-results', compact('cities', 'userFavourites'));
    }
}
