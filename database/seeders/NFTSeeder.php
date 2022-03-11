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
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 120,
                'type_id' => 1
            ]
        );
        DB::table('n_f_t_s')->insert(
            [
                'id' => 94133,
                'collection_id' => 4,
                'name' => 'apedidas',
                'base_price' => 90,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 300,
                'type_id' => 2
            ]
        );
        DB::table('n_f_t_s')->insert(
            [
                'id' => 13123,
                'collection_id' => 3,
                'name' => 'bored',
                'base_price' => 676,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 9832,
                'type_id' => 3
            ]
        );
    }
}
