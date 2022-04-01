<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller {
    
    public function get(Collection $collection){
        return response()->json(['collection' => $collection]);
    }

    public function getAll(){
        $collections = Collection::all();
        return response()->json(['collection' => $collections]);
    }

    public function create(Request $data){
        $collection = Collection::create([
            'name' => $data->name,
            'description' => $data->email,
            'artist_id' => $data->artist_id  // ->artist() funcionaria?
        ]);

        return response()->json(['success' => true, 'collection' => $collection]);
    }

    public function delete(Collection $collection){
        if(Collection::whereId($collection->id)->count()){
            $collection->delete();
            return response()->json(['success' => true, 'collection' => $collection]);
        }
        return response()->json(['success' => false]);
    }

    public function update(Request $request, Collection $collection){
        $newCollection = Collection::find($collection->id);
        $newCollection->name = $request->name;
        if($request->filled('description')) {
            $newCollection->description = $request->description;
        }
        $newCollection->save();
    }
}