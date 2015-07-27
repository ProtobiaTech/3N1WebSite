<?php

use Illuminate\Database\Seeder;
use App\User, App\Category, App\Content;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::lists('id')->toArray();
        $categorys = Category::where('type_id', '=', Category::TYPE_BLOG)->lists('id')->toArray();

        $faker = Faker\Factory::create();
        foreach (range(1, 28) as $index) {
            Content::create([
                'title'     =>  'blog ' . $faker->sentence(),
                'body'      =>  implode('<br>', $faker->paragraphs(16)),
                'user_id'   =>  $faker->randomElement($users),
                'type_id'   =>  Content::TYPE_BLOG,
                'category_id'           =>  $faker->randomElement($categorys),
                'last_comment_user_id'  =>  $faker->randomElement($users),
            ]);
        }
    }
}
