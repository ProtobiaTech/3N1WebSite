<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('weight')->default(100)->index();
            $table->smallInteger('parent_id')->default(0)->index();
            $table->smallInteger('type_id')->default(0)->index();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Category::create([
            'name'      =>  'uncategory',
            'parent_id' =>  0,
            'type_id'   =>  Category::TYPE_ARTICLE,
        ]);

        Category::create([
            'name'      =>  'uncategory',
            'parent_id' =>  0,
            'type_id'   =>  Category::TYPE_BLOG,
        ]);

        $topicCategory = Category::create([
            'name'      =>  'uncategory',
            'parent_id' =>  0,
            'type_id'   =>  Category::TYPE_TOPIC,
        ]);
        Category::create([
            'name'      =>  'uncategory',
            'parent_id' =>  $topicCategory->id,
            'type_id'   =>  Category::TYPE_TOPIC,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
