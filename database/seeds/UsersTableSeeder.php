<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        User::create([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'password' => '123456',
            'avatar' => config('common.user.path.default_name_avatar'),
            'roles' => config('roles.user'),
        ]);
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'password' => $faker->name . $faker->year,
                'avatar' => config('common.user.path.default_name_avatar'),
                'roles' => config('roles.user'),
            ]);
        }
    }
}
