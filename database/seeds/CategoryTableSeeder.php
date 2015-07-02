<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // Topic
        foreach (range(1, 6) as $index) {
            Category::create([
                'name'      =>  $faker->monthName(),
                'type_id'   =>  Category::TYPE_TOPIC,
            ]);
        }

        // children Topic
        $topicCategorys = Category::where('type_id', '=', Category::TYPE_TOPIC)->lists('id')->toArray();
        foreach (range(1, 30) as $index) {
            Category::create([
                'name'      =>  $faker->monthName(),
                'type_id'   =>  Category::TYPE_TOPIC,
                'parent_id' =>  $faker->randomElement($topicCategorys),
            ]);
        }
    }

}
