<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
use App\Models\Nft;

class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersId = DB::table('users')->pluck('id');
        $nftsId = DB::table('nfts')->pluck('id');

        \DB::table('nft_user')->delete();

        $u1 = User::find($usersId[0]);
        $n1 = Nft::find($nftsId[1]);
        $u1->bids()->attach([$n1->id => ['wallet' => '0xb1234', 'amount' => '0.1']]);
        //$n1->bids()->attach($u1->id);

        $u2 = User::find($usersId[1]);
        $n2 = Nft::find($nftsId[1]);
        $u2->bids()->attach([$n2->id => ['wallet' => '0xb12456', 'amount' => '0.1']]);
        //$n2->bids()->attach($u2->id);
    }
}
