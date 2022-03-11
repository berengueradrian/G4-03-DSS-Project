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
        $this->call(UserSeeder::class);
        $this->command->info('User table seeded!');
        $this->call(ArtistSeeder::class);
        $this->command->info('Artist table seeded!');
        $this->call(CollectionSeeder::class);
        $this->command->info('Collection table seeded!');
        $this->call(TypesSeeder::class);
        $this->command->info('Type table seeded!');
        $this->call(NFTSeeder::class);
        $this->command->info('NFT table seeded!');
    }
}
