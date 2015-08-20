<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->default('Awesome WebSite');
            $table->string('site_keywords')->default('3n1website, awesome, website');
            $table->string('site_description')->default('awesome website');
            $table->string('site_ipc')->nullable();
            $table->string('site_analytics')->nullable();
            $table->string('contact_email')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        $System = new \App\System;
        $System->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('systems');
    }
}
