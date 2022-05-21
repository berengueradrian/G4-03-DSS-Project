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
                'type_id' => $typesId[0],
                'img_url' => 'nft_example1.png'
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
                'type_id' => $typesId[1],
                'img_url' => 'nft_example2.png'
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
                'type_id' => $typesId[2],
                'img_url' => 'tesla.png'
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
                'type_id' => $typesId[2],
                'img_url' => 'nft1.png'
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
                'type_id' => $typesId[4],
                'img_url' => 'nft2.jpg'
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
                'type_id' => $typesId[4],
                'img_url' => 'nft3.jpg'
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
                'type_id' => $typesId[3],
                'img_url' => 'nft4.jpg'
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
                'type_id' => $typesId[2],
                'img_url' => 'nft5.jpg'
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[3],
                'name' => 'holaa',
                'base_price' => 23,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 23,
                'type_id' => $typesId[4],
                'img_url' => 'nft6.jpg'
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[3],
                'name' => 'eyyyy',
                'base_price' => 300,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 300,
                'type_id' => $typesId[3],
                'img_url' => 'nft7.jpg'
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[0],
                'name' => 'quetal',
                'base_price' => 30,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 30,
                'type_id' => $typesId[4],
                'img_url' => 'nft8.jpg'
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[1],
                'name' => 'ape',
                'base_price' => 3,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 3,
                'type_id' => $typesId[2],
                'img_url' => 'nft9.jpeg'
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[4],
                'name' => 'sooo',
                'base_price' => 35,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 35,
                'type_id' => $typesId[4],
                'img_url' => 'nft10.jpg'
            ]
        );

        DB::table('nfts')->insert(
            [
                'collection_id' => $collectionsId[4],
                'name' => 'punky',
                'base_price' => 31,
                'limit_date' => NULL,
                'available' => false,
                'actual_price' => 31,
                'type_id' => $typesId[2],
                'img_url' => 'nft11.jpg'
            ]
        );
    }
}
