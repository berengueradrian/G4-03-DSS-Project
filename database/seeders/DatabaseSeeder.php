<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->command->info('User table seeded!');
        $this->call(ArtistsTableSeeder::class);
        $this->command->info('Artist table seeded!');
        $this->call(CollectionsTableSeeder::class);
        $this->command->info('Collection table seeded!');
        $this->call(TypesTableSeeder::class);
        $this->command->info('Type table seeded!');
        $this->call(NftsTableSeeder::class);
        $this->command->info('Nft table seeded!');
        $this->call(BidsTableSeeder::class);
        $this->command->info('Bid table seeded!');
    }
}
