<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NftsTableSeeder extends Seeder
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
        DB::table('nfts')->delete();

        // Add a new entry to the table 
        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[0],
                'name' => 'apeloco',
                'base_price' => 100,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 100,
                'type_id' => $typesId[0]
            ]
        );
        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[1],
                'name' => 'apedidas',
                'base_price' => 90,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 90,
                'type_id' => $typesId[1]
            ]
        );
        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[2],
                'name' => 'bored',
                'base_price' => 676,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 676,
                'type_id' => $typesId[2]
            ]
        );
        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[2],
                'name' => 'bored2',
                'base_price' => 676,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 676,
                'type_id' => $typesId[2]
            ]
        );
        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[2],
                'name' => 'bored3',
                'base_price' => 676,
                'limit_date' => NULL,
                'available' => true,
                'actual_price' => 676,
                'type_id' => $typesId[4]
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[6],
                'name' => 'adri',
                'base_price' => 50,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 50,
                'type_id' => $typesId[4]
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[6],
                'name' => 'adri2',
                'base_price' => 60,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 60,
                'type_id' => $typesId[3]
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[6],
                'name' => 'adri3',
                'base_price' => 70,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 70,
                'type_id' => $typesId[2]
            ]
        );
    }
}
