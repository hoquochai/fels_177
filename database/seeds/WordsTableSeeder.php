<?php

use App\Models\Category;
use App\Models\Word;
use Illuminate\Database\Seeder;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categories = Category::all();
        foreach ($categories as $category) {
            for ($i = 0; $i < 12; $i++) {
                Word::create([
                    'content' => $faker->word,
                    'category_id' => $category->id,
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => $faker->dateTime($max = 'now'),
                ]);
            }
        }
    }
}
