<?php

use App\Http\Controllers\AdminForecastsController;
use App\Http\Controllers\AdminWeatherController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::view("/", "welcome");

Route::middleware(["auth", AdminCheckMiddleware::class])->prefix("/admin")->group(function () {

    Route::view("/weather", "admin.weather-index");
    Route::view("/add-city", "admin/addCity");
    Route::post("/save-city", [WeatherController::class, "saveCity"])
        ->name("saveCity");
    Route::get("/delete/{city}", [WeatherController::class, "deleteCity"])
        ->name("deleteCity");
    Route::get("/edit/{city}", [WeatherController::class, "getCity"])
        ->name("getCity");
    Route::post("/update/{city}", [WeatherController::class, "updateCity"])
        ->name("updateCity");
    Route::post("/weather/update", [AdminWeatherController::class, "update"])
        ->name("weather.update");

    Route::view("/forecasts", "admin.forecasts-index");
    Route::post("/forecast/create", [AdminForecastsController::class, "createForecast"])
        ->name("forecast.create");

});

Route::get("/weather", [WeatherController::class, "index"]);

Route::get("/forecast/search", [ForecastController::class, "search"])
    ->name("forecast.search");

Route::get("/forecast/{city:name}", [ForecastController::class, "index"])
    ->name("forecast.permalink");

Route::middleware("auth")->prefix("/user")->group(function () {

    Route::get("/weather", [WeatherController::class, "showWeather"]);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::view("/addCity", "addCity");

    Route::post("saveCity", [CitiesController::class, "saveCity"]);

});

Route::view("/home", "layouts/guest");
