<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use App\Models\Artist;
use App\Models\Collection;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Else_;

class NftController extends Controller
{

    public function get(Nft $nft)
    {
        return view('nfts.details')->with('nft', $nft);
    }

    public function getAll()
    {
        $nfts = Nft::paginate(5);
        return view('nfts.list')->with('nfts', $nfts);
    }

    public function getHome()
    {
        $nfts = Nft::all()->take(3);
        $nft = NftController::getExpensive();
        $popularNfts = NftController::getPopulars();
        return view('home')
            ->with('nfts', $nfts)
            ->with('bestNft', $nft)
            ->with('popularNfts', $popularNfts);
    }

    public function getMarketplace()
    {
        $nfts = Nft::all();
        return view('marketplace')->with('nfts', $nfts);
    }

    public function getExpensive()
    {
        return Nft::getExpensive();
    }

    public function getPopulars()
    {

        return Nft::getPopulars();
    }

    public function aux()
    {
    }

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required|max:50',
            'base_price' => 'required|numeric|gte:0|digits_between:1,20',
            'collection_id' => 'required|exists:collections,id',
            'type_id' => 'required|exists:types,id',
            'base_price' => 'numeric|digits_between:1,20|gte:0'
        ]);

        if ($data->filled('user_id')) {
            $data->validate(['user_id' => 'exists:users,id']);
        }


        Nft::createNft($data->name, $data->base_price, $data->base_price, false, $data->collection_id,
                        $data->type_id, $data->user_id, $data->img_url);

        return back();
    }

    public function delete(Request $data)
    {
        $data->validate([
            'iddelete' => 'required|numeric|exists:nfts,id'
        ]);

        Nft::deleteNft($data->iddelete);
        return back()->with('message','Nft deleted successfully');
    }

    public function update(Request $request)
    {
        $updates = ['name' => false, 'base_price' => false, 'limit_date' => false, 
                    'collection_id' => false, 'user_id'=>false, 'type_id'=>false, 
                    'img_url'=>false, 'available' => false];
        $request->validate([
            'id_update' => 'required|numeric|exists:nfts,id'
        ]);

        $newNft = Nft::find($request->id_update);       
        if ($request->name_update != null) {
            $updates["name"] = $request->name_update;
        }
        if ($request->base_price_update != null) {
            $request->validate([
                'base_price_update' => 'numeric|gte:0|digits_between:1,20'
            ]);
            $updates["base_price"] = $request->base_price_update;
        }
        if ($request->limit_date != null) {
            $request->validate(['limit_date' => 'date|after:today']);
            $updates["limit_date"] = $request->limit_date;
        }
        if ($request->collection_id_update != null) {
            $request->validate(['collection_id_update' => 'exists:collections,id']);
            $updates["collection_id"] = $request->collection_id_update;
        }
        if ($request->user_id_update != null) {
            $request->validate(['user_id_update' => 'exists:users,id']);
            $updates["user_id"] = $request->user_id_update;
        }
        if ($request->type_id_update != null) {
            $request->validate(['type_id_update' => 'exists:types,id']);
            $updates["type_id"] = $request->type_id_update;
        }
        if ($request->img_url_update != null) {
            $request->validate(['img_url_update' => 'max:50']);
            $updates["img_url"] = $request->img_url_update;
        }
        if ($request->availability_update != -1) {
            $updates["available"] = $request->availability_update;
        }
        Nft::updateNft($updates, $newNft);
        return back();
    }

    public function available(Request $request)
    {
        $availableFilter = $request->input('availableFilter');
        $reqInputType = $request->input('type');
        $nfts = Nft::available($availableFilter, $reqInputType);

        if ($reqInputType == 'market') {
            return view('marketplace')->with('nfts', $nfts);
        }
        else {
            return view('nfts.list')->with('nfts', $nfts);
        }
    }

    public function filterPrice(Request $request)
    {
        $reqInputType = $request->input('type');
        $nfts = Nft::filterPrice($reqInputType, $request->price);

        if ($reqInputType == 'market') {

            return view('marketplace')->with('nfts', $nfts);   
        } else {

            return view('nfts.list')->with('nfts', $nfts);  
        }
    }

    public function sortByPrice(Request $request)
    {
        $reqInputType = $request->input('type');
        $nfts = Nft::sortByPrice($reqInputType, $request->sortByPrice);

        if ($reqInputType == 'market') {
            
            return view('marketplace')->with('nfts', $nfts);
        }
        else {
            
            return view('nfts.list')->with('nfts', $nfts);
        }
    }

    public function sortByExclusivity(Request $request)
    {
        $reqInputType = $request->input('type');
        $nfts = Nft::sortByExclusivity($reqInputType, $request->sortByExclusivity);

        if ($reqInputType == 'market') {
            
            return view('marketplace')->with('nfts', $nfts);   
        }
        else {
            
            return view('nfts.list')->with('nfts', $nfts);
        }
    }

    //Bussines extra methods
    public function putOnSaleNFT($id)
    {
        $alreadyOnSale = Nft::putOnSaleNFT($id);
        if ($alreadyOnSale) {
            session()->flash('msg', 'NFT available already.');
        } else {
            session()->flash('msg', ' The NFT is available to purchase now.');
        }
    }

    public function auction($id, DateTime $limit_date)
    {
        $alreadyOnAuction = Nft::putOnSaleNFT($id);
        if ($alreadyOnAuction) {
            session()->flash('msg', 'NFT available already.');
        }
        else {
            session()->flash('success', ' The NFT is available to bid now.');
        }
    }

    /*
    public function purchaseNFT(Request $request, int $id)
    {
        $request->validate([
            'purchase_wallet' => 'required|max:30'
        ]);

        $nft = Nft::whereId($id)->first();
        $buyer = User::whereId(Auth::user()->id)->first();
        $seller = Artist::whereId($nft->collectionName->artistName->id)->first();

        if (($buyer->balance - $request->purchase_amount) >= 0) { //If balance user allow buying at that amount

            // NFT properties update 
            $nft->user_id = $buyer->id; //Update property user
            $nft->available = false; //when buying it's unavailable until new owner wants
            $nft->save();

            // BUYER USER properties update 
            $buyer->balance -= $request->purchase_amount;
            $buyer->save();

            // ARTIST BALANCE properties update 
            $seller->volume_sold += $request->purchase_amount;
            $seller->save();
        } else {
            session()->flash('fail', 'Insuficient balance!');
            return back();
        }
        session()->flash('success', 'NFT bought correctly!');
        return back();
    }*/
    

 public function closeBid($id)
 {
     $nft = NFT::whereId($id)->first();
     if($nft->bids()->count() > 0) {
         $bids = $nft->bids()->get()->toArray();
            
            $artist = Artist::whereId($nft->collection->artist_id)->first();
            $artist->volume_sold += $bids[0]['pivot']['amount'];
            $artist->update();

            session()->flash('success', 'Bid closed correctly.');
        }
        else {
            $nft->limit_date = Carbon::now()->addMonths(1);
            $nft->update();
            session()->flash('fail', 'The NFT has not bids, so it will be added a month to its limit date.');
        }
        return back();
    }

    public function addNft(Request $data, $collection)
    {
        $data->validate([
            'name' => 'required|max:50',
            'base_price' => 'required|numeric|gte:0|digits_between:1,20',
            'type_id' => 'required|exists:types,id'
        ]);

        if ($data->filled('img_url')) {
            $data->validate(['img_url' => 'max:50']);
        } else {
            $data->img_url = 'default.jpg';
        }

        Nft::createNft($data->name, $data->base_price, $data->base_price, false, $collection,
                        $data->type_id, NULL, $data->img_url);


        return back()->with('message', 'Nft added successfully!');
    }
    //         usort($bids, function($a, $b) {
    //             return ($a['created_at'] > $b['created_at']) ? $a:$b;
    //         });

    //         for($index = 0; $index < count($bids) ; $index++ ) {
    //             $user = User::whereId($bids[$index]['pivot']['user_id'])->first();
    //             if($user->balance >= $bids[$index]['pivot']['amount']) {
    //                 $nft->available = false;
    //                 $nft->user_id = $bids[$index]['pivot']['user_id'];
    //                 $nft->save();

    //                 $user->balance = $user->balance - $bids[$index]['pivot']['amount'];
    //                 $user->save();
                    
    //                 $artist = Artist::whereId($nft->collection->artist_id)->first();
    //                 $artist->volume_sold += $bids[$index]['pivot']['amount'];
    //                 $artist->update();

    //                 session()->flash('success', 'Bid closed correctly. NFT sold to the user with the biggest bid and suficient balance');
    //                 return back();
    //             }
    //         }
    //         $nft->limit_date = Carbon::now()->addMonths(1);
    //         $nft->update();
    //         session()->flash('fail', 'The NFT has not bids, so it will be added a month to its limit date.');
    //     }
    //     else {
    //         $nft->limit_date = Carbon::now()->addMonths(1);
    //         $nft->update();
    //         session()->flash('fail', 'The NFT has not bids, so it will be added a month to its limit date.');
    //     }
    //     return back();
    // }

    // public function bidNFT(Request $request, $id)
    // {
    //     $request->validate([
    //         'bid_amount' => 'required|numeric|digits_between:1,20|gte:0',
    //         'bid_wallet' => 'required|max:30'
    //     ]);
    //     $newNft = Nft::whereId($id)->first();
    //     if ($request->bid_amount <= Auth::user()->balance) {
    //         if ($request->bid_amount > $newNft->actual_price) {
    //             $u1 = User::whereId(Auth::user()->id)->first();
    //             $newNft->actual_price = $request->bid_amount;
    //             $newNft->save();
    //             $u1->bids()->attach([$newNft->id => ['wallet' => $request->bid_wallet, 'amount' => $request->bid_amount]]);
    //             session()->flash('success', 'Bid placed succesfully.');
    //             return back();
    //         } else {
    //             session()->flash('fail', 'The amount must be bigger than the actual price.');
    //             return back();
    //         }
    //     }
    //     else {
    //         session()->flash('fail', 'The balance is not enough.');
    //         return back();
    //     }
    // }
}
