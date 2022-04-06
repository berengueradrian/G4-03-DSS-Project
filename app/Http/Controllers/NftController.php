<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;


class NftController extends Controller
{

    public function get(Nft $nft)
    {
        return view('nfts.details')->with('nft', $nft);
    }

    public function getAll()
    {
        $nfts = Nft::paginate(2);
        return view('nfts.list')->with('nfts', $nfts);
    }

    public function create()
    {
        return view('nfts.create');
    }

    public function delete(Nft $nft)
    {
        if (Nft::whereID($nft->id)->count()) {
            $nft->delete();
            return response()->json(['success' => true, 'nft' => $nft]);
        }

        return response()->json(['success' => false]);
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required|numeric',
            'collection_id' => 'exists:collections,id',
            'user_id' => 'exists:users,id',
            'type_id' => 'exists:types,id',
            'limit_date' => 'date|after:today'
        ]);
        

        $newNft = NFT::find($request->id);
        if($request->name != null) {
            $newNft->name = $request->name;
        }
        if($request->base_price != null) {
            $newNft->base_price = $request->base_price;
        }
        if($request->limit_date != null) {
            $newNft->limit_date = $request->limit_date;
        }
        if($request->collection_id != null) {
            $newNft->collection_id = $request->collection_id;
        }
        if($request->user_id != null) {
            $newNft->user_id = $request->user_id;
        }
        if($request->type_id != null) {
            $newNft->type_id = $request->type_id;
        }
        if($request->img_url != null) {
            $newNft->img_url = $request->img_url;
        }
        $newNft->actual_price = $request->base_price;
        $newNft->available = false;
        $newNft->update();
        return back();
    }

    public function available(Request $request)
    {
        $availableFilter = $request->input('availableFilter');
        if ($availableFilter == 1) { //Available NFTS
            $nfts = Nft::whereAvailable(1)->paginate(2);
        } elseif ($availableFilter == 2) { //Non Available NFTS
            $nfts = Nft::whereAvailable(0)->paginate(2);
        } else { // If == 0 -> All
            $nfts = Nft::paginate(2);
        }
        return view('nfts.list')->with('nfts', $nfts);
    }

    public function filterPrice(Request $request)
    {
        if ($request->price != null) {
            $nfts = NFT::where('actual_price', '>', $request->price)->paginate(2);
        } else {
            $nfts = NFT::paginate(2);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

    public function sortByPrice(Request $request)
    {
        if ($request->sortByPrice == 0) {
            $nfts = NFT::orderBy('actual_price', 'ASC')->paginate(2);
        } elseif ($request->sortByPrice == 1) {
            $nfts = NFT::orderBy('actual_price', 'DESC')->paginate(2);
        } else {
            $nfts = NFT::paginate(2);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

    public function sortByExclusivity(Request $request)
    {
        if ($request->sortByExclusivity == 0) {
            $nfts = NFT::orderBy('type_id', 'DESC')->paginate(2);
        } elseif ($request->sortByExclusivity == 1) {
            $nfts = NFT::orderBy('type_id', 'ASC')->paginate(2);
        } else {
            $nfts = NFT::paginate(2);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

}
