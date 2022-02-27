<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NFTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Delete the table data   
        DB::table('n_f_t_s')->delete();

        // Add a new entry to the table 
        DB::table('n_f_t_s')->insert(
            [
                'id' => 07123,
                'collection_id' => 4,
                'name' => 'apeloco',
                'base_price' => 100,
                'exclusive' => false,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 120
            ]);
        DB::table('n_f_t_s')->insert(
            [
                'id' => 94133,
                'collection_id' => 4,
                'name' => 'apedidas',
                'base_price' => 90,
                'exclusive' => false,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 300
            ]);
        DB::table('n_f_t_s')->insert(
            [
                'id' => 13123,
                'collection_id' => 3,
                'name' => 'bored',
                'base_price' => 676,
                'exclusive' => true,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 9832
            ]
        );
    }
}
