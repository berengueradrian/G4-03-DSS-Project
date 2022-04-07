<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function get(Artist $artist)
    {
        return view('artists.details')->with('artist', $artist);
    }

    public function getAll()
    {
        $artists = Artist::paginate(2);
        return view('artists.list')->with('artists', $artists);
    }

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required',
            'balance' => 'required|numeric'
        ]);

        Artist::create([
            'name' => $data->name,
            'balance' => $data->balance,
            'img_url' => $data->img_url,
            'description' => $data->description
        ]);
        //return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|numeric|exists:artists,id'
        ]);
        $artist = Artist::find($request->iddelete);
        $artist->delete();
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_update' => 'required'
        ]);
        $newArtist = Artist::find($request->id_update);
        if ($request->filled('name_update')) {
            $newArtist->name = $request->name_update;
        }
        if ($request->filled('description_update')) {
            $newArtist->description = $request->description_update;
        }
        if ($request->filled('img_url_update')) {
            $newArtist->img_url = $request->img_url_update;
        }
        if ($request->filled('volume_sold_update')) {
            $request->validate([
                'volume_sold_update' => 'numeric'
            ]);
            $newArtist->volume_sold = $request->volume_sold_update;
        }
        if ($request->filled('balance_update')) {
            $request->validate([
                'balance_update' => 'numeric'
            ]);
            $newArtist->balance = $request->balance_update;
        }
        $newArtist->update();
        return back();
    }

    public function sortByName(Request $request)
    {
        if ($request->sortByName == 0) {
            $artists = Artist::orderBy('name', 'DESC')->paginate(2);
        } elseif ($request->sortByName == 1) {
            $artists = Artist::orderBy('name', 'ASC')->paginate(2);
        } else {
            $artists = Artist::paginate(5);
        }

        return view('artists.list')->with('artists', $artists);
    }

    public function sortByBalance(Request $request)
    {
        if ($request->sortByBalance == 0) {
            $artists = Artist::orderBy('balance', 'DESC')->paginate(2);
        } elseif ($request->sortByBalance == 1) {
            $artists = Artist::orderBy('balance', 'ASC')->paginate(2);
        } else {
            $artists = Artist::paginate(5);
        }

        return view('artists.list')->with('artists', $artists);
    }

    public function sortByVolume(Request $request)
    {
        if ($request->sortByVolume == 0) {
            $artists = Artist::orderBy('volume_sold', 'DESC')->paginate(2);
        } elseif ($request->sortByVolume == 1) {
            $artists = Artist::orderBy('volume_sold', 'ASC')->paginate(2);
        } else {
            $artists = Artist::paginate(5);
        }

        return view('artists.list')->with('artists', $artists);
    }
}
