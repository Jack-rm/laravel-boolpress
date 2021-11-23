<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = User::all();

        $role_ids = Role::pluck('id')->toArray(); //prendo gli id dei ruoli e li esprimo come array per poter ciclare

        foreach ($users as $user){

            $user->roles()->sync([Arr::random($role_ids)]);
        };
    }
}
