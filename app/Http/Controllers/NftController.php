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

    public function update(Request $request, Nft $nft)
    {
        $newNFT = Nft::find($nft->id);
        if($request->filled('name')) {
            $newNFT->name = $request->name;
        }
        if($request->filled('available')) {
            $newNFT->available = $request->available;
        }
        if($request->filled('base_price')) {
            $newNFT->base_price = $request->base_price;
        }
        if($request->filled('limit_date')) {
            $newNFT->limit_date = $request->limit_date;
        }
        if($request->filled('img_url')) {
            $newNFT->img_url = $request->img_url;
        }
        if($request->filled('collection_id')) {
            $newNFT->collection_id = $request->collection_id;
        }
        if($request->filled('user_id')) {
            $newNFT->user_id = $request->user_id;
        }
        if($request->filled('type_id')) {
            $newNFT->type_id = $request->type_id;
        }
        $newNFT->save();
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
            $nfts = Nft::where('actual_price', '>', $request->price)->paginate(2);
        } else {
            $nfts = Nft::paginate(2);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

    public function sortByPrice(Request $request)
    {
        if ($request->sortByPrice == 0) {
            $nfts = Nft::orderBy('actual_price', 'ASC')->paginate(2);
        } elseif ($request->sortByPrice == 1) {
            $nfts = Nft::orderBy('actual_price', 'DESC')->paginate(2);
        } else {
            $nfts = Nft::paginate(2);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

    public function sortByExclusivity(Request $request)
    {
        if ($request->sortByExclusivity == 0) {
            $nfts = Nft::orderBy('type_id', 'DESC')->paginate(2);
        } elseif ($request->sortByExclusivity == 1) {
            $nfts = Nft::orderBy('type_id', 'ASC')->paginate(2);
        } else {
            $nfts = Nft::paginate(2);
        }

        return view('nfts.list')->with('nfts', $nfts);
    }

}
