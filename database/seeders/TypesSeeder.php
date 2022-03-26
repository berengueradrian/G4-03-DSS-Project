<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete the table data   
        DB::table('types')->delete();

        // Add a new entry to the table 
        DB::table('types')->insert(
            [
                'name' => 'exclusive',
                'description' => 'NFT able to bid'
            ]
        );

        DB::table('types')->insert(
            [
                'name' => 'normal',
                'description' => 'NFT to put on sale'
            ]
        );

        DB::table('types')->insert(
            [
                'name' => 'undernormal',
                'description' => 'NFT under normal'
            ]
        );
    }
}
