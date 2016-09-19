<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            Category::create([
                'name' => $faker->word,
                'introduction' => $faker->text(100),
                'image' => config('common.category.path.default_name_image'),
            ]);
        }
    }
}
