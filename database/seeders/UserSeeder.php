<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete the table data   
        DB::table('users')->delete();

        // Add a new entry to the table 
        DB::table('users')->insert(
            [
                'name' => 'marioalc19',
                'balance' => 19,
                'email' => 'marioloco@gmail.com',
                'password' => '1234'
            ]);
            DB::table('users')->insert(
            [
                'name' => 'amancio1',
                'balance' => 7,
                'email' => 'amamancio@gmail.com',
                'password' => '1234'
            ]);
            DB::table('users')->insert(
            [
                'name' => 'mesipeq',
                'balance' => 16,
                'email' => 'adrinano@gmail.com',
                'password' => '1234'
            ]
        );
    }
}
