<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
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
                'name' => 'Common',
                'description' => 'This is the most basic NFT'
            ]
        );

        DB::table('types')->insert(
            [
                'name' => 'Rare',
                'description' => 'Rare NFT. 1 level higher than common'
            ]
        );

        DB::table('types')->insert(
            [
                'name' => 'Exclusive',
                'description' => 'Exclusive NFT. The middle grade of rarity. 1 level higher than rare.'
            ]
        );

        DB::table('types')->insert(
            [
                'name' => 'Very exclusive',
                'description' => 'Very exclusive NFT. One of the highest levels of rarity. 1 level higher than rare.'
            ]
        );

        DB::table('types')->insert(
            [
                'name' => 'Legendary',
                'description' => 'Legendary NFT. The hightest level of rarity.'
            ]
        );
    }
}
