<?php

use App\Models\Word;
use App\Models\WordAnswer;
use Illuminate\Database\Seeder;

class WordAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $words = Word::all();
        foreach ($words as $word) {
            for ($i = 0; $i < 3; $i++) {
                if ($i == 1) {
                    WordAnswer::create([
                        'word_id' => $word->id,
                        'content' => $faker->word,
                        'correct' => true,
                        'created_at' => $faker->dateTime($max = 'now'),
                        'updated_at' => $faker->dateTime($max = 'now'),
                    ]);
                }

                WordAnswer::create([
                    'word_id' => $word->id,
                    'content' => $faker->word,
                    'correct' => false,
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => $faker->dateTime($max = 'now'),
                ]);
            }
        }
    }
}
