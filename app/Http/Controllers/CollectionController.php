<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Http\Controllers\NftController;
use App\Models\Nft;
use DateTime;
use Session;

class CollectionController extends Controller
{

    public function get(Collection $collection)
    {
        return view('collections.details')->with('collection', $collection);
    }

    public function show(Collection $collection)
    {
        return view('show.collection')->with('collection', $collection);
    }


    public function getAll()
    {
        $collections = Collection::getAll();
        return view('collections.list')->with('collections', $collections);
    }

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:50',
            'artist_id' => 'required|exists:artists,id|numeric',
            'img_url' => 'max:50'
        ]);

        $collection = Collection::createCollection($data->name, $data->description, $data->artist_id);

        if ($data->filled('img_url')) {
            $data->validate(['img_url' => 'max:50']);
        } else {
            $data->img_url = 'default.jpg';
        }
        Collection::updateAfterCreate($collection, $data);

        return back()->with('message', 'Collection created successfully!');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|exists:collections,id'
        ]);
        $collection = Collection::find($request->iddelete);
        Collection::deleteCollection($collection);
        return back();
    }

    public function update(Request $request)
    {
        if ($request->name_update == '') {
            $request->name_final = $request->name;
        } else {
            $request->validate([
                'name_update' => 'max:50'
            ]);
            $request->name_final = $request->name_update;
        }
        if ($request->artist_id_update != '') {
            $request->validate([
                'id' => 'required|numeric|exists:collections,id',
                'artist_id_update' => 'exists:artists,id'
            ]);
        } else {
            $request->validate([
                'id' => 'required|numeric|exists:collections,id'
            ]);
        }
        if ($request->description_update != null) {
            $request->validate([
                'description_update' => 'max:50'
            ]);
        }
        if ($request->img_url_update != null) {
            $request->validate([
                'img_url_update' => 'max:50'
            ]);
        }

        $newCollection = Collection::find($request->id);
        Collection::updateCollection($newCollection, $request);

        return back()->with('message','Collection updated successfully!');
    }

    public function sortByName(Request $request)
    {
        if ($request->sortByName == 1) {
            $collections = Collection::orderBy('name', 'DESC')->paginate(5);
        } elseif ($request->sortByName == 0) {
            $collections = Collection::orderBy('name', 'ASC')->paginate(5);
        } else {
            $collections = Collection::paginate(5);
        }

        return view('collections.list')->with('collections', $collections);
    }

    public function putOnSaleCollection( Request $request, int $id) {
        
        $request->validate([
            'limit_date' => 'required|date|after:today'
        ]);
        $newCollection = Collection::whereId($id)->first();
        if($request->limit_date < now()) {
            session()->flash('fail', 'The date is required.');
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
            return back();
            //return redirect()->route('collection.getOne');
        }
    }

    public function addCollection(Request $request, $artist)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:50',
            'img_url' => 'max:50'
        ]);

        $collection = Collection::createCollection($request->name, $request->description, $request->artist_id);

        if ($request->filled('img_url')) {
            $request->validate(['img_url' => 'max:50']);
        } else {
            $request->img_url = 'default.jpg';
        }

        Collection::updateAfterCreate($collection, $request);

        return back()->with('message', 'Collection created successfully!');
    }

    public function edit(Request $request)
    {
        if ($request->name_update == '') {
            $request->name_final = $request->name;
        } else {
            $request->validate([
                'name_update' => 'max:50'
            ]);
            $request->name_final = $request->name_update;
        }
        if ($request->artist_id_update != '') {
            $request->validate([
                'id' => 'required|numeric|exists:collections,id',
                'artist_id_update' => 'exists:artists,id'
            ]);
        } else {
            $request->validate([
                'id' => 'required|numeric|exists:collections,id'
            ]);
        }
        if ($request->description_update != null) {
            $request->validate([
                'description_update' => 'max:50'
            ]);
        }
        if ($request->img_url_update != null) {
            $request->validate([
                'img_url_update' => 'max:50'
            ]);
        }

        $newCollection = Collection::find($request->id);
        Collection::updateCollection($newCollection, $request);

        return back()->with('message', 'Collection edited successfully!');
    }
    // public function putOnSaleCollection(int $id, Request $request) {
    //     $newCollection = Collection::whereId($id)->first();
    //     $request->validate([
    //         'limit_date' => 'required|date|after:today'
    //     ]);
    //     if($request->limit_date < now()) {
    //         session()->flash('fail', 'The date is required.');
    //         return back();
    //         //return redirect()->route('collection.getOne');
    //     }
    //     else {
    //         foreach($newCollection->nfts as $nft) {
    //             if($nft->type_id == 5) {
    //                 $nft->available = true;
    //                 $nft->limit_date = $request->limit_date;
    //                 $nft->save();
    //             }
    //             else {
    //                 $nft->available = true;
    //                 $nft->save();
    //             }
    //         }
    //         $newCollection->on_sale = true;
    //         $newCollection->save();
    //         session()->flash('success', 'The collection was put on sale correctly.');
    //         return back();
    //         //return redirect()->route('collection.getOne');
    //     }
    // }
}
