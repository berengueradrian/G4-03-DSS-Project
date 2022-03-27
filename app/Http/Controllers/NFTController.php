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

    public function update()
    {
        //TODO:
    }
}
