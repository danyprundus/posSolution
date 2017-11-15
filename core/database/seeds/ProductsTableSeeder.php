<?php

use Illuminate\Database\Seeder;

class ProducstTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->create([
            'name' => str_random(10),
        ]);
    }
}
