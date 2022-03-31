<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller {
    
    public function get(Collection $collection){
        return view('collections.details')->with('collection', $collection);
    }

    public function getAll(){
        $collections = Collection::paginate(2);
        return view('collections.list')->with('collections', $collections);
    }

    public function create(){
        return view('collections.create');
    }

    public function store(Request $data){
        $data->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'artist_id' => 'required|exists:artists'
        ]);

        Collection::create([
            'name' => $data->name,
            'description' => $data->email,
            'artist_id' => $data->artist_id  // ->artist() funcionaria?
        ]);
    }

    public function delete(Collection $collection){
        if(Collection::whereId($collection->id)->count()){
            $collection->delete();
            return response()->json(['success' => true, 'collection' => $collection]);
        }
        return response()->json(['success' => false]);
    }

    public function update(){
        //TODO:
    }
}