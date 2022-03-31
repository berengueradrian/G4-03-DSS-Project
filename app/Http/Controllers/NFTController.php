<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NFT;


class NFTController extends Controller
{

    public function get(NFT $nft)
    {
        return view('nfts.details')->with('nft', $nft);
    }

    public function getAll()
    {
        $nfts = NFT::paginate(2);
        return view('nfts.list')->with('nfts', $nfts);
    }

    public function create()
    {
        return view('nfts.create');
    }

    public function delete(NFT $nft)
    {
        if (NFT::whereID($nft->id)->count()) {
            $nft->delete();
            return response()->json(['success' => true, 'nft' => $nft]);
        }

        return response()->json(['success' => false]);
    }

    public function update(Request $request, NFT $nft)
    {
        $newNFT = NFT::find($nft->id);
        $newNFT->name = $request->name;
        $newNFT->base_price = $request->base_price;
        $newNFT->limit_date = $request->limit_date;
        $newNFT->update();
    }

    public function available(Request $request)
    {
        $availableFilter = $request->input('availableFilter');
        if ($availableFilter == 1) { //Available NFTS
            $nfts = NFT::whereAvailable(1)->paginate(2);
        } elseif ($availableFilter == 2) { //Non Available NFTS
            $nfts = NFT::whereAvailable(0)->paginate(2);
        } else { // If == 0 -> All
            $nfts = NFT::paginate(2);
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
}
