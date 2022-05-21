<?php

namespace App\ServiceLayer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Nft;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Artist;
use App\Models\User;

class NftServices {

    public static function bidNFT(Request $request, $id)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|digits_between:1,20|gte:0',
            'bid_wallet' => 'required|max:30'
        ]);

        DB::beginTransaction();

        $newNft = Nft::whereId($id)->first();
        if ($request->bid_amount <= Auth::user()->balance) {
            if ($request->bid_amount > $newNft->actual_price) {
                $u1 = User::whereId(Auth::user()->id)->first();
                $newNft->actual_price = $request->bid_amount;
                $newNft->save();
                $u1->bids()->attach([$newNft->id => ['wallet' => $request->bid_wallet, 'amount' => $request->bid_amount]]);
                
                session()->flash('success', 'Bid placed succesfully.');
                DB::commit();
                return back();
            } else {
                session()->flash('fail', 'The amount must be bigger than the actual price.');
                DB::rollBack();
                return back();
            }
        }
        else {
            session()->flash('fail', 'The balance is not enough.');
            DB::rollBack();
            return back();
        }
    }

    public static function closeBid($id)
    {
        DB::beginTransaction();
        $nft = NFT::whereId($id)->first();
        if($nft->bids()->count() > 0) {
            $bids = $nft->bids()->get()->toArray();
            
            usort($bids, function($a, $b) {
                return ($a['created_at'] > $b['created_at']) ? $a:$b;
            });

            for($index = 0; $index < count($bids) ; $index++ ) {
                $user = User::whereId($bids[$index]['pivot']['user_id'])->first();
                if($user->balance >= $bids[$index]['pivot']['amount']) {
                    $nft->available = false;
                    $nft->user_id = $bids[$index]['pivot']['user_id'];
                    $nft->save();

                    $user->balance = $user->balance - $bids[$index]['pivot']['amount'];
                    $user->save();
                    
                    $artist = Artist::whereId($nft->collection->artist_id)->first();
                    $artist->volume_sold += $bids[$index]['pivot']['amount'];
                    $artist->update();

                    session()->flash('success', 'Bid closed correctly. NFT sold to the user with the biggest bid and suficient balance');
                    DB::commit();
                    return back();
                }
            }
            $nft->limit_date = Carbon::now()->addMonths(1);
            $nft->update();
            session()->flash('fail', 'The NFT has not bids, so it will be added a month to its limit date.');
        }
        else {
            $nft->limit_date = Carbon::now()->addMonths(1);
            $nft->update();
            session()->flash('fail', 'The NFT has not bids, so it will be added a month to its limit date.');
        }
        DB::rollBack();
        return back();
    }

}