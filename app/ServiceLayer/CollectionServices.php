<?php

namespace App\ServiceLayer;
use Illuminate\Support\Facades\DB;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionServices {
    public static function putOnSaleCollection(int $id, Request $request) {
        DB::beginTransaction();

        $newCollection = Collection::whereId($id)->first();
        $request->validate([
            'limit_date' => 'required|date|after:today'
        ]);
        if($request->limit_date < now()) {
            session()->flash('fail', 'The date is required.');
            DB::rollBack();
            return back();
            //return redirect()->route('collection.getOne');
        }
        else {
            foreach($newCollection->nfts as $nft) {
                if($nft->type_id == 5) {
                    $nft->available = true;
                    $nft->limit_date = $request->limit_date;
                    $nft->save();
                }
                else {
                    $nft->available = true;
                    $nft->save();
                }
            }
            $newCollection->on_sale = true;
            $newCollection->save();
            session()->flash('success', 'The collection was put on sale correctly.');
            DB::commit();
            return back();
            //return redirect()->route('collection.getOne');
        }
    }
}