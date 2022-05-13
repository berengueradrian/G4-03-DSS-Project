<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use DateTime;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        NFT::create([
            'name' => $data->name,
            'base_price' => $data->base_price,
            'actual_price' => $data->base_price,
            'available' => false,
            'collection_id' => $data->collection_id,
            'type_id' => $data->type_id,
            'user_id' => $data->user_id,
            'img_url' => $data->img_url
        ]);
        return back();
    }

    public function delete(Request $data)
    {
        $data->validate([
            'iddelete' => 'required|numeric|exists:nfts,id'
        ]);
        $nft = NFT::find($data->iddelete);
        $nft->delete();
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_update' => 'required|numeric|exists:nfts,id'
        ]);


        $newNft = NFT::find($request->id_update);
        if ($request->name_update != null) {
            $newNft->name = $request->name_update;
        }
        if ($request->base_price_update != null) {
            $request->validate([
                'base_price_update' => 'numeric|gte:0|digits_between:1,20'
            ]);
            $newNft->base_price = $request->base_price_update;
            $newNft->actual_price = $request->base_price_update;
        }
        if ($request->limit_date != null) {
            $request->validate(['limit_date' => 'date|after:today']);
            $newNft->limit_date = $request->limit_date;
        }
        if ($request->collection_id_update != null) {
            $request->validate(['collection_id_update' => 'exists:collections,id']);
            $newNft->collection_id = $request->collection_id_update;
        }
        if ($request->user_id_update != null) {
            $request->validate(['collection_id_update' => 'exists:users,id']);
            $newNft->user_id = $request->user_id_update;
        }
        if ($request->type_id_update != null) {
            $request->validate(['collection_id_update' => 'exists:types,id']);
            $newNft->type_id = $request->type_id_update;
        }
        if ($request->img_url_update != null) {
            $request->validate(['img_url_update' => 'max:50']);
            $newNft->img_url = $request->img_url_update;
        }
        if ($request->availability_update != -1) {
            $newNft->available = $request->availability_update;
        }
        $newNft->update();
        return back();
    }

    public function available(Request $request)
    {
        $availableFilter = $request->input('availableFilter');
        if ($availableFilter == 1) { //Available NFTS
            $nfts = Nft::whereAvailable(1)->paginate(5);
        } elseif ($availableFilter == 2) { //Non Available NFTS
            $nfts = Nft::whereAvailable(0)->paginate(5);
        } else { // If == 0 -> All
            $nfts = Nft::paginate(5);
        }
        return view('nfts.list')->with('nfts', $nfts);
    }

    public function filterPrice(Request $request)
    {
        if ($request->price != null) {
            $nfts = Nft::where('actual_price', '>', $request->price)->paginate(5);
        } else {
            $nfts = Nft::paginate(5);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

    public function sortByPrice(Request $request)
    {
        if ($request->sortByPrice == 0) {
            $nfts = Nft::orderBy('actual_price', 'ASC')->paginate(5);
        } elseif ($request->sortByPrice == 1) {
            $nfts = Nft::orderBy('actual_price', 'DESC')->paginate(5);
        } else {
            $nfts = Nft::paginate(5);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

    public function sortByExclusivity(Request $request)
    {
        if ($request->sortByExclusivity == 0) {
            $nfts = Nft::orderBy('type_id', 'DESC')->paginate(5);
        } elseif ($request->sortByExclusivity == 1) {
            $nfts = Nft::orderBy('type_id', 'ASC')->paginate(5);
        } else {
            $nfts = Nft::paginate(5);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

    //Bussines extra methods
    public function putOnSaleNFT($id)
    {
        $newNft = NFT::whereId($id)->first();
        if($newNft->available) {
            session()->flash('msg', 'NFT available already.');
        }
        else {
            $newNft->available = true;
            $newNft->save();
            session()->flash('msg', ' The NFT is available to purchase now.');
        }
    }

    public function auction($id, DateTime $limit_date)
    {
        $newNft = NFT::whereId($id)->first(); 
        if($newNft->available && $newNft->limit_date != null) {
            session()->flash('msg', 'NFT available already.');
        }
        else {
            $newNft->available = true;
            $newNft->limit_date = $limit_date;
            $newNft->save();
            session()->flash('msg', ' The NFT is available to bid now.');
        }
    }


    //#####################//#####################//#####################//#####################
    //TODO: WE MUST UPDATE VOLUME_SOLD VARIABLE IN ARTIST IF THE SELLER IS AN ARTIST!!!!!!!! ###
    //#####################//#####################//#####################//#####################


    public function bidNFT(Request $request, $id)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|digits_between:1,20|gte:0',
            'bid_wallet' => 'required|max:30'
        ]);
        $newNft = NFT::whereId($id)->first();
        if($request->bid_amount <= Auth::user()->balance) {
            if ($request->bid_amount > $newNft->actual_price) {
                $u1 = User::whereId(Auth::user()->id)->first();
                $newNft->actual_price = $request->bid_amount;
                $newNft->save();
                $u1->bids()->attach([$newNft->id => ['wallet' => $request->bid_wallet, 'amount' => $request->bid_amount]]);
                session()->flash('msg', 'Bid placed succesfully.');
                return back();
            } else {
                session()->flash('msg', 'The amount must be bigger than the actual price.');
                return back();
            }
        }
        else {
            session()->flash('msg', 'The balance is not enough.');
            return back();
        }
    }

    public function purchaseNFT(Request $request, int $id)
    {
        $request->validate([
            'purchase_wallet' => 'required|max:30'
        ]);

        $nft = NFT::whereId($id)->first();
        $buyer = User::whereId(Auth::user()->id)->first();

        if (($buyer->balance - $request->purchase_amount) >= 0) { //If balance user allow buying at that amount

            /* NFT properties update */
            $nft->user_id = $buyer->id; //Update property user
            $nft->available = false; //when buying it's unavailable until new owner wants
            $nft->save();

            /* BUYER USER properties update */
            /* ARTIST BALANCE properties update */
            $buyer->balance -= $request->purchase_amount;
            $buyer->save();

            //TODO: Aqui habria que ver si el seller es un artista o un user normal, para sumarselo al balance del user o al volumen del artist

        } else {
            session()->flash('fail', 'Insuficient balance!');
            return back();
        }
        session()->flash('success', 'NFT bought correctly!');
        return back();
    }

    public function closeBid($id)
    {
        $nft = NFT::whereId($id)->first();
        $nft->available = false;
        $bids = $nft->bids()->get()->toArray();
        //dd($bids);
        usort($bids, function($a, $b) {
            return ($a['created_at'] > $b['created_at']) ? $a:$b;
        });
        
        $nft->user_id = $bids[0]['pivot']['user_id'];
        $nft->save();

        $user = User::whereId($bids[0]['pivot']['user_id'])->first();
        $user->balance = $user->balance - $bids[0]['pivot']['amount'];
        $user->save();
        //TODO: Artist aumentarle el volume_sold
        //$artist = 
        //$artist->volume_sold += $bid->amount;

        session()->flash('success', 'Bid closed correctly.');
        return back();
    }
}
