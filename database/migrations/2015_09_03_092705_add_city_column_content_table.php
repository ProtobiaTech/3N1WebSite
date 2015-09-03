<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityColumnContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->integer('province_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('county_id')->unsigned();

            $table->foreign('province_id')->references('id')->on('areas');
            $table->foreign('city_id')->references('id')->on('areas');
            $table->foreign('county_id')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn([
                'province_id',
                'city_id',
                'county_id',
            ]);
        });
    }
}
