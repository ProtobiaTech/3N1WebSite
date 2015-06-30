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
        $topicCategorys = ['Talk', 'Party', 'Movie', 'Music', 'Goods', 'Sport', 'Game',];
        foreach ($topicCategorys as $index => $category) {
            Category::create([
                'name'      =>  $category,
                'type_id'   =>  Category::TYPE_TOPIC,
            ]);
        }

        // children Topic
        $topicCategorys = Category::where('type_id', '=', Category::TYPE_TOPIC)->lists('id')->toArray();
        foreach (range(1, 20) as $index) {
            $parentId = $faker->randomElement($topicCategorys);
            $name = Category::find($parentId)->name;
            Category::create([
                'name'      =>  $name . $index,
                'type_id'   =>  Category::TYPE_TOPIC,
                'parent_id' =>  $parentId,
            ]);
        }



        // Article
        $articleCategorys = ['Hot News', 'BeiJing', 'China', 'America', 'England'];
        foreach ($articleCategorys as $index => $category) {
            Category::create([
                'name'      =>  $category,
                'type_id'   =>  Category::TYPE_ARTICLE,
            ]);
        }



        // Blog
        $blogCategorys = ['Uncategory', 'Log', 'Heavy'];
        foreach ($blogCategorys as $index => $category) {
            Category::create([
                'name'      =>  $category,
                'type_id'   =>  Category::TYPE_BLOG,
            ]);
        }
    }

}
