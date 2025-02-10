<?php

namespace App\Console\Commands;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to sinhronize real time weather using open weather api';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $city = $this->argument('city');

        $dbCity = CitiesModel::where(['name' => $city])->first();
        if($dbCity === null)
        {
            $dbCity = CitiesModel::create([
                'name' => $city,
            ]);
        }

        $response = Http::get(env("WEATHER_API_URL")."v1/forecast.json", [
            'key' => env('WEATHER_API_KEY'),
            'q' =>  $city,
            'aqi' => 'no',
            'days' => 1,
        ]);

        $jsonResponse = $response->json();
        if(isset($jsonResponse['error']))
        {
            $this->output->error($jsonResponse['error']['message']);
        }

        if($dbCity->todayForecast !== null)
        {
            $this->output->comment("Command finished");
            return;
        }

        $forecastDay = $jsonResponse['forecast']['forecastday'][0];
        $forecast_date = $forecastDay['date'];
        $temperature = $forecastDay['day']['avgtemp_c'];
        $weather_type = $forecastDay['day']['condition']['text'];
        $probability = $forecastDay['day']['daily_chance_of_rain'];


        $forecast = [
            'city_id' => $dbCity->id,
            'temperature' => $temperature,
            'weather_type' => strtolower($weather_type),
            'forecast_date' => $forecast_date,
            'probability' => $probability,
        ];

        ForecastsModel::create($forecast);
        $this->output->comment("Added new forecast!");
    }
}
