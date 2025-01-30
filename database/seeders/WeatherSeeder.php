<?php

namespace Database\Seeders;

use App\Models\WeatherModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weather = [
            'Beograd' => 22,
            'Novi Sad' => 25,
            'Subotica' => 24,
            'Sjenica' => 15,
            'Sarajevo' => 20,
            'Valjevo' => 22,
        ];

        foreach ($weather as $city => $temperature) {

            $userWeather = WeatherModel::where(['city' => $city])->first();
            if ($userWeather !== null)
            {
                $this->command->getOutput()->info("Grad sa ovim imenom vec postoji");
                continue;
            }
            WeatherModel::create([
                'city' => $city,
                'temperature' => $temperature,
            ]);
        }
    }
}
