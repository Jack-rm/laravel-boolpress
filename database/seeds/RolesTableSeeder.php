<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

use Faker\Generator as Faker;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $roleList = ['Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber'];

        for ($i = 1 ; $i <= 5; $i++){
            $newRole = new Role();
            $newRole->rank = $i + 1;
            $newRole->name = $roleList[$i - 1];
            $newRole->color = $faker->safeHexColor();
            $newRole->save();
        }

        $role = new Role();
        $role->rank = 1;
        $role->name = 'SuperAdmin';
        $role->color = $faker->safeHexColor();
        $role->save();

    }
}
