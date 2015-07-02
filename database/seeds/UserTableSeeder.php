<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->delete();

        $faker = Faker\Factory::create();
        foreach (range(1, 50) as $index) {
            \App\User::create([
                'email'     =>  $faker->email(),
                'name'      =>  $faker->userName(),
                'password'  =>  $faker->password(),
            ]);
        }
    }

}
