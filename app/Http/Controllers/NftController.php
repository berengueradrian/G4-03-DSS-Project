<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use DateTime;
use Tests\Feature\NFTTest;

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

    public function store(Request $data){
        $data->validate([
            'name' => 'required',
            'base_price' => 'required|numeric|gte:0',
            'collection_id' => 'required|exists:collections,id',
            'type_id' => 'required|exists:types,id',
            'base_price' => 'numeric|digits_between:1,20|gte:0'
        ]);

        if($data->filled('user_id')){
            $data->validate([ 'user_id' => 'exists:users,id' ]);
        }

        NFT::create([
            'name' => $data->name,
            'base_price' => $data->base_price,
            'actual_price' => $data->base_price,
            'available' => false,
            'collection_id' => $data->collection_id,
            'type_id' => $data->type_id,
            'user_id' => $data->user_id,
            'img_url'=> $data->img_url
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

    public function update(Request $request){
        $request->validate([
            'id_update' => 'required|numeric|exists:nfts,id'
        ]);
        

        $newNft = NFT::find($request->id_update);
        if($request->name_update != null) {
            $newNft->name = $request->name_update;
        }
        if($request->base_price_update != null) {
            $request->validate([
                'base_price_update' => 'numeric|gte:0'
            ]);
            $newNft->base_price = $request->base_price_update;
            $newNft->actual_price = $request->base_price_update;
        }
        if($request->limit_date != null) {
            $request->validate([ 'limit_date' => 'date|after:today' ]);
            $newNft->limit_date = $request->limit_date;
        }
        if($request->collection_id_update != null) {
            $request->validate([ 'collection_id_update' => 'exists:collections,id' ]);
            $newNft->collection_id = $request->collection_id_update;
        }
        if($request->user_id_update != null) {
            $request->validate([ 'collection_id_update' => 'exists:users,id' ]);
            $newNft->user_id = $request->user_id_update;
        }
        if($request->type_id_update != null) {
            $request->validate([ 'collection_id_update' => 'exists:types,id' ]);
            $newNft->type_id = $request->type_id_update;
        }
        if($request->img_url_update != null) {
            $newNft->img_url = $request->img_url_update;
        }
        if($request->availability_update != -1) {
            $newNft->available = $request->availability_update;
        }
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
