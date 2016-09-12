<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}
Class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'e.learning.admin@gmail.com',
            'password' => bcrypt('123456'),
            'avatar' => config('common.user.path.default_name_avatar'),
            'roles' => config('roles.admin'),
        ]);
    }
}
