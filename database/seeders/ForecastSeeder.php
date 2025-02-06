<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = CitiesModel::all();

        foreach ($cities as $city) {

            $previousTemperature = null;

            for ($i = 0; $i < 5; $i++)
            {
                $weatherType = ForecastsModel::WEATHERS[rand(0,3)];
                $probability = null;

                if($weatherType == 'rainy' || $weatherType == 'snowy')
                {
                    $probability = rand(1, 100);
                }

                $temperature = null;

                if($previousTemperature !== null)
                {
                    $minTemperature = $previousTemperature - 5;
                    $maxTemperature = $previousTemperature + 5;
                    $temperature = rand($minTemperature, $maxTemperature);
                }
                else
                {
                    switch ($weatherType)
                    {
                        case 'sunny':
                            $temperature = rand(-30, 40);
                            break;
                        case 'cloudy':
                            $temperature = rand(-30, 15);
                            break;
                        case 'rainy':
                            $temperature = rand(-10, 40);
                            break;
                        case 'snowy':
                            $temperature = rand(-30, 1);
                            break;
                    }
                }

                ForecastsModel::create([
                    'city_id' => $city->id,
                    'temperature' => $temperature,
                    'forecast_date' => Carbon::now()->addDays(rand(1, 30)),
                    'weather_type' => $weatherType,
                    'probability' => $probability,
                ]);

                $previousTemperature = $temperature;
            }
        }
    }
}
