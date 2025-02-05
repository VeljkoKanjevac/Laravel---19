<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++)
        {
            CitiesModel::create([
                'name' => $faker->city,
            ]);
        }
    }
}
