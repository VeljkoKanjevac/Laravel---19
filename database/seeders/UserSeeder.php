<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = $this->command->getOutput()->ask("Koliko korisnika zelite da napravite?", 500);

        $password = $this->command->getOutput()->ask("Koju sifru zelite?", "123456");

        $faker = Factory::create();

        $this->command->getOutput()->progressStart($amount);

        for ($i = 0; $i < $amount; $i++) {
            User::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'password' => Hash::make($password),
            ]);

            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
