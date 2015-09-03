<?php

use Illuminate\Database\Seeder;

use App\User, App\Category, App\Article, App\Topic, App\Blog, App\Content;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::lists('id')->toArray();
        $categoryData['article'] = Category::where('type_id', '=', Category::TYPE_ARTICLE)->lists('id')->toArray();
        $categoryData['blog'] = Category::where('type_id', '=', Category::TYPE_BLOG)->lists('id')->toArray();
        $categoryData['topic'] = Category::where('type_id', '=', Category::TYPE_TOPIC)->lists('id')->toArray();

        $faker = Faker\Factory::create();
        foreach ($categoryData as $k => $categorys) {
            switch ($k) {
                case 'article':
                    $typeId = Content::TYPE_ARTICLE;
                    break;
                case 'blog':
                    $typeId = Content::TYPE_BLOG;
                    break;
                case 'topic':
                    $typeId = Content::TYPE_TOPIC;
                    break;
            }

            foreach (range(1, 38) as $index => $v) {
                Content::create([
                    'title'     =>  $index . ' ' . $k . ' ' . $faker->sentence(),
                    'body'      =>  implode('<br>', $faker->paragraphs(16)),
                    'user_id'   =>  $faker->randomElement($users),
                    'type_id'   =>  $typeId,
                    'province_id'       => 1,
                    'city_id'           => 2,
                    'county_id'         => 3,
                    'category_id'           =>  $faker->randomElement($categorys),
                    'last_comment_user_id'  =>  $faker->randomElement($users),
                ]);
            }
        }
    }
}
