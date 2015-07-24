<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User, App\Category, App\Content;

class TopicTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::lists('id')->toArray();
        $nodes = Category::where('type_id', '=', Category::TYPE_TOPIC)->lists('id')->toArray();

        $faker = Faker\Factory::create();

        foreach (range(1, 18) as $index) {
            Content::create([
                'title'     =>  'topic ' . $faker->sentence(),
                'body'      =>  implode('<br>', $faker->paragraphs(8)),
                'user_id'   =>  $faker->randomElement($users),
                'type_id'   =>  Content::TYPE_TOPIC,
                'category_id'           =>  $faker->randomElement($nodes),
                'last_comment_user_id'  =>  $faker->randomElement($users),
            ]);
        }
    }

}
