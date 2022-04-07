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


    //TODO: Si de input metes una string muy larga peta todo

    public function store(Request $data){
        $data->validate([
            'name' => 'required',
            'description' => 'required',
            'artist_id' => 'required|exists:artists,id|numeric'
        ]);

        Collection::create([
            'name' => $data->name,
            'description' => $data->description,
            'artist_id' => $data->artist_id  // ->artist() funcionaria?
        ]);
        return back();
    }

    public function delete(Request $request){
        $request->validate([
            'iddelete' => 'required|exists:collections,id'
        ]);
        $collection = Collection::find($request->iddelete);
        $collection->delete();
        return back();
    }

    public function update(Request $request){
        if($request->name_update == ''){
            $request->name_final = $request->name;
        }
        else{
            $request->name_final = $request->name_update;
        }
        if($request->artist_id_update != ''){
            $request->validate([
                'id' => 'required|numeric|exists:collections,id',
                'artist_id_update' => 'exists:artists,id'
            ]);
        }
        else{
            $request->validate([
                'id' => 'required|numeric|exists:collections,id'
            ]);
        }
        

        $newCollection = Collection::find($request->id);
        if($request->name_final != null) {
            $newCollection->name = $request->name_final;
        }
        if($request->description != null) {
            $newCollection->description = $request->description;
        }
        if($request->artist_id_update != null) {
            $newCollection->artist_id = $request->artist_id_update;
        }
        $newCollection->update();
        return back();
    }

    public function sortByName(Request $request) {
        if ($request->sortByName == 1) {
            $collections = Collection::orderBy('name', 'DESC')->paginate(2);
        } elseif ($request->sortByName == 0) {
            $collections = Collection::orderBy('name', 'ASC')->paginate(2);
        } else {
            $collections = Collection::paginate(2);
        }

        return view('collections.list')->with('collections', $collections);
    }
}