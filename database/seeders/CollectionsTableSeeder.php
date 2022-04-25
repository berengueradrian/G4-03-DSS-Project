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
                'name' => 'MuskCollection'
            ]
        );

        DB::table('collections')->insert(
            [
                'description' => 'Most exotics NFTs are here!',
                'artist_id' => $artistsId[1],
                'name' => 'ExoticCollection'
            ]
        );

        // Add a new entry to the table 
        DB::table('collections')->insert(
            [
                'description' => 'The first collection ever created!',
                'artist_id' => $artistsId[2],
                'name' => 'FirstCollection'
            ]
        );
    }
}
