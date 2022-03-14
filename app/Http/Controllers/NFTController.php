<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NFT;


class NFTController extends Controller
{

    public function get(NFT $nft)
    {
        return response()->json(['nft' => $nft]);
    }

    public function getAll()
    {
        $nfts = NFT::all();
        return response()->json(['nfts' => $nfts]);
    }

    public function create(Request $data)
    {
        $nft = NFT::create([
            'name' => $data->name,
            'base_price' => $data->base_price,
            'limit_date' => $data->limit_date,
            'available' => $data->available,
            'actual_price' => $data->actual_price,
            'collection_id' => $data->collection_id,
            'user_id' => $data->user_id, //not sure
            'type_id' => $data->type_id
        ]);
        return response()->json(['success' => true, 'nft' => $nft]);
    }

    public function delete(NFT $nft)
    {
        if (NFT::whereID($nft->id)->count()) {
            $nft->delete();
            return response()->json(['success' => true, 'nft' => $nft]);
        }

        return response()->json(['success' => false]);
    }

    public function update(){
        //TODO:
    }

}
