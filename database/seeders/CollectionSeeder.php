<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Delete the table data   
        DB::table('collections')->delete();

        DB::table('collections')->insert([
            'id' => 4,
            'description' => 'Developed by Elon Musk and Michael Jordan',
            'artist_id' => 9999
        ]);

        DB::table('collections')->insert(
            [
                'id' => 3,
                'description' => 'Most exotics NFTs are here!',
                'artist_id' => 1111
            ]
        );

        // Add a new entry to the table 
        DB::table('collections')->insert(
            [
                'id' => 1,
                'description' => 'The first collection ever created!',
                'artist_id' => 8888
            ]
        );
    }
}
