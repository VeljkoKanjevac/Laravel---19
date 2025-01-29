<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(["auth", \App\Http\Middleware\AdminCheckMiddleware::class])->prefix("/admin")->group(function () {

    Route::view("/add-city", "admin/addCity");
    Route::post("/save-city", [WeatherController::class, "saveCity"])
        ->name("saveCity");
    Route::get("/weather", [WeatherController::class, "index"]);
    Route::get("/delete/{city}", [WeatherController::class, "deleteCity"])
        ->name("deleteCity");
    Route::get("/edit/{city}", [WeatherController::class, "getCity"])
        ->name("getCity");
    Route::post("/update/{city}", [WeatherController::class, "updateCity"])
        ->name("updateCity");

});

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

require __DIR__.'/auth.php';

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::view("/addCity", "addCity");

    Route::post("saveCity", [\App\Http\Controllers\CitiesController::class, "saveCity"]);

});

Route::view("/home", "layouts/guest");
