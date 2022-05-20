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
        $collections = Collection::paginate(5);
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

        $collection = Collection::create([
            'name' => $data->name,
            'description' => $data->description,
            'artist_id' => $data->artist_id,
        ]);

        if ($data->filled('img_url')) {
            $data->validate(['img_url' => 'max:50']);
            $collection->img_url = $data->img_url;
        } else {
            $collection->img_url = 'default.jpg';
        }

        $collection->save();

        return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|exists:collections,id'
        ]);
        $collection = Collection::find($request->iddelete);
        $collection->delete();
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


        $newCollection = Collection::find($request->id);

        if ($request->name_final != null) {
            $newCollection->name = $request->name_final;
        }

        if ($request->description_update != null) {
            $request->validate([
                'description_update' => 'max:50'
            ]);
            $newCollection->description = $request->description_update;
        }
        if ($request->artist_id_update != null) {
            $newCollection->artist_id = $request->artist_id_update;
        }
        if ($request->img_url_update != null) {
            $request->validate([
                'img_url_update' => 'max:50'
            ]);
            $newCollection->img_url = $request->img_url_update;
        }
        $newCollection->update();
        return back();
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

    public function putOnSaleCollection(int $id, Request $request) {
        $newCollection = Collection::whereId($id)->first();
        $request->validate([
            'limit_date' => 'required|date|after:today'
        ]);
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
}
