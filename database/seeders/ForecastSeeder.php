<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        foreach ($cities as $city)
        {
            for ($i = 0; $i < 5; $i++)
            {
                ForecastsModel::create([
                    'city_id' => $city->id,
                    'temperature' => rand(15,30),
                    'forecast_date' => Carbon::now()->addDays(rand(1,30)),
                ]);
            }
        }
    }
}
