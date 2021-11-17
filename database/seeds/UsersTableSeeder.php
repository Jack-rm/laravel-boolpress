<?php

use Illuminate\Database\Seeder;
use App\User;

use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Esempio di creazione di un utente statico

        $user = new User();

        $user->name = "Jacopo";
        $user->email = 'maildiprova@gmail.com';
        $user->password = bcrypt("123jacopo"); // bcrypt() funzione di hashing per cifratura password

        $user->save();

        for ($i = 0; $i < 10; $i++){

            $newUser = new User();

            $newUser->name = $faker->userName();
            $newUser->email = $faker->email();
            $newUser->password = bcrypt($faker->password(5, 15));
            
            $newUser->save();
        }
    }
}