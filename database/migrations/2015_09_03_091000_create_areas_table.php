<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Area;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('type_id')->unsigned();
            $table->integer('zip')->unsigned();
            $table->string('name', 30);


            $table->softDeletes();
            $table->timestamps();
        });

        // default area data
        $area = file_get_contents(__DIR__ . '/area.json');
        $area = json_decode($area);

        Area::unguard();
        // Province
        foreach ($area->province as $provinceKey => $province) {
            $Area = Area::create([
                'type_id'   =>      Area::TYPE_PROVINCE,
                'name'      =>      $province->name,
                'zip'       =>      $province->zip,
            ]);

            if (!empty($province->city)) {
                // City
                foreach ($province->city as $city) {
                    $Area = Area::create([
                        'parent_id' =>      $Area->id,
                        'type_id'   =>      Area::TYPE_CITY,
                        'name'      =>      $city->name,
                        'zip'       =>      $city->zip,
                    ]);

                    // County
                    if (!empty($city->county)) {
                        if (is_array($city->county)) {
                            foreach ($city->county as $county) {
                                Area::create([
                                    'parent_id' =>      $Area->id,
                                    'type_id'   =>      Area::TYPE_COUNTY,
                                    'name'      =>      $county->name,
                                    'zip'       =>      $county->zip,
                                ]);
                            }
                        } else {
                            Area::create([
                                'parent_id' =>      $Area->id,
                                'type_id'   =>      Area::TYPE_COUNTY,
                                'name'      =>      $city->county->name,
                                'zip'       =>      $city->county->zip,
                            ]);
                        }
                    }
                }
            }
        }
        Area::reguard();



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('areas');
    }
}
