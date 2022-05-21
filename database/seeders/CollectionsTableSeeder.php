<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artistsId = DB::table('artists')->pluck('id');

        // Delete the table data   
        DB::table('collections')->delete();

        DB::table('collections')->insert(
            [
                'description' => 'Developed by Elon Musk and Michael Jordan',
                'artist_id' => $artistsId[0],
                'name' => 'MuskCollection',
                'img_url' => 'zxc.jpeg'
            ]
        );

        DB::table('collections')->insert(
            [
                'description' => 'Most exotics NFTs are here!',
                'artist_id' => $artistsId[1],
                'name' => 'ExoticCollection',
                'img_url' => 'col1.jpg'
            ]
        );

        // Add a new entry to the table 
        DB::table('collections')->insert(
            [
                'description' => 'The first collection ever created!',
                'artist_id' => $artistsId[2],
                'name' => 'FirstCollection',
                'img_url' => 'col2.jpg'
            ]
        );

        DB::table('collections')->insert(
            [
                'description' => 'The second collection ever created!',
                'artist_id' => $artistsId[2],
                'name' => 'SecondCollection',
                'img_url' => 'col3.jpg'
            ]
        );

        DB::table('collections')->insert(
            [
                'description' => 'The third collection ever created!',
                'artist_id' => $artistsId[3],
                'name' => 'ThirdCollection',
                'img_url' => 'col4.jpg'
            ]
        );

        DB::table('collections')->insert(
            [
                'description' => 'The Fourth collection ever created!',
                'artist_id' => $artistsId[1],
                'name' => 'FourthCollection',
                'img_url' => 'col5.jpg'
            ]
        );

        DB::table('collections')->insert(
            [
                'description' => 'The Fifth collection ever created!',
                'artist_id' => $artistsId[3],
                'name' => 'FifthCollection',
                'img_url' => 'col6.jpg'
            ]
        );

        DB::table('collections')->insert(
            [
                'description' => 'Trying some methods',
                'artist_id' => $artistsId[0],
                'name' => 'CollectionTry',
                'img_url' => 'col7.jpg'
            ]
        );
    }
}
