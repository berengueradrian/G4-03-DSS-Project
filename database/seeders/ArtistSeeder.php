<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Delete the table data   
        DB::table('artists')->delete();

        // Add a new entry to the table 
        DB::table('artists')->insert(
            [
                //'id' => 8888,
                'name' => 'picazo',
                'balance' => 88,
                'volme_sold' => 0,
                'description' => 'Pedro picazo is the most popular NFT influencer in Hong Kong'
            ],
            [
                // 'id' => 9999,
                'name' => 'vetoven',
                'balance' => 99,
                'volme_sold' => 500,
                'description' => 'Willy Vetoven is a new artist with high quality creations'
            ],
            [
                //'id' => 1111,
                'name' => 'elbicho',
                'balance' => 111,
                'volme_sold' => 10,
                'description' => 'Jesus, also known as elbicho is a spanish influencer with a high amount of colaborations with some companies such as Zara, Adidas and Nike'
            ]
        );
    }
}
