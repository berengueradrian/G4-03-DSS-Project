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
        $collectionsId = DB::table('collections')->pluck('id');
        $typesId = DB::table('types')->pluck('id');

        // Delete the table data   
        DB::table('n_f_t_s')->delete();

        // Add a new entry to the table 
        DB::table('n_f_t_s')->insert(
            [
                'collection_id' => $collectionsId[0],
                'name' => 'apeloco',
                'base_price' => 100,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 120,
                'type_id' => $typesId[0]
            ]
        );
        DB::table('n_f_t_s')->insert(
            [
                'collection_id' => $collectionsId[1],
                'name' => 'apedidas',
                'base_price' => 90,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 300,
                'type_id' => $typesId[1]
            ]
        );
        DB::table('n_f_t_s')->insert(
            [
                'collection_id' => $collectionsId[2],
                'name' => 'bored',
                'base_price' => 676,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 9832,
                'type_id' => $typesId[2]
            ]
        );
    }
}
