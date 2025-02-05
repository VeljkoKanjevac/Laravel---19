<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = $this->command->getOutput()->ask('Koju email adresu zelite da registrujete?');
        if($email === null)
        {
            $this->command->getOutput()->error('Niste uneli mail adresu!');
        }

        $password = $this->command->getOutput()->ask('Unesite lozinku:?');
        if($password === null)
        {
            $this->command->getOutput()->error('Niste uneli lozinku!');
        }

        $name = $this->command->getOutput()->ask('Koje korisnicko ime zelite?');
        if($name === null)
        {
            $this->command->getOutput()->error('Niste uneli korisnicko ime!');
        }

        $user = User::where(['email' => $email])->first();
        if($user instanceof User)
        {
            $this->command->getOutput()->error('Korisnik sa ovom email adresom vec postoji!');
            return;
        }

        User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
        ]);

        $this->command->getOutput()->info("Korisnik je uspesno registrovan");
    }
}
