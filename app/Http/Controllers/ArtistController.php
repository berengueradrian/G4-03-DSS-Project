<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Http\Exceptions\HttpResponseException;
use Auth;

class ArtistController extends Controller
{
    public function get(Artist $artist)
    {
        return view('artists.details')->with('artist', $artist);
    }

    public function getAll()
    {
        $artists = Artist::paginate(5);
        return view('artists.list')->with('artists', $artists)->with('withCollection', false);
    }

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required|max:50',
        ]);

        $artist = Artist::create([
            'name' => $data->name
        ]);

        if ($data->balance != null) {
            $data->validate(['balance' => 'numeric|gte:0|digits_between:1,20']);
            $artist->balance = $data->balance;
        } else {
            $artist->balance = 0.0;
        }
        if ($data->img_url != null) {
            $data->validate([
                'img_url' => 'max:50',
            ]);
            $artist->img_url = $data->img_url;
        } else {
            $artist->img_url = 'default.jpg';
        }
        if ($data->description != null) {
            $data->validate([
                'description' => 'max:50',
            ]);
            $artist->description = $data->description;
        } else {
            $artist->description = '';
        }
        $artist->save();
        return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|numeric|exists:artists,id'
        ]);
        $artist = Artist::find($request->iddelete);
        if ($artist->collections->count() > 0) {
            $artists = Artist::paginate(5);
            return view('artists.list')->with('artists', $artists)->with('withCollection', true);
        } else {
            $artist->delete();
        }
        return back()->with('withCollection', false);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_update' => 'required'
        ]);
        $newArtist = Artist::find($request->id_update);
        if ($request->filled('name_update')) {
            $request->validate([
                'name_update' => 'max:50',
            ]);
            $newArtist->name = $request->name_update;
        }
        if ($request->filled('description_update')) {
            $newArtist->description = $request->description_update;
        }
        if ($request->filled('img_url_update')) {
            $request->validate([
                'img_url_update' => 'max:50',
            ]);
            $newArtist->img_url = $request->img_url_update;
        }
        if ($request->filled('volume_sold_update')) {
            $request->validate([
                'volume_sold_update' => 'numeric|gte:0'
            ]);
            $newArtist->volume_sold = $request->volume_sold_update;
        }
        if ($request->filled('balance_update')) {
            $request->validate([
                'balance_update' => 'numeric|gte:0'
            ]);
            $newArtist->balance = $request->balance_update;
        }
        $newArtist->update();
        return back();
    }

    public function sortByName(Request $request)
    {
        if ($request->sortByName == 0) {
            $artists = Artist::orderBy('name', 'DESC')->paginate(5);
        } elseif ($request->sortByName == 1) {
            $artists = Artist::orderBy('name', 'ASC')->paginate(5);
        } else {
            $artists = Artist::paginate(5);
        }

        return view('artists.list')->with('artists', $artists);
    }

    public function sortByBalance(Request $request)
    {
        if ($request->sortByBalance == 0) {
            $artists = Artist::orderBy('balance', 'DESC')->paginate(5);
        } elseif ($request->sortByBalance == 1) {
            $artists = Artist::orderBy('balance', 'ASC')->paginate(5);
        } else {
            $artists = Artist::paginate(5);
        }

        return view('artists.list')->with('artists', $artists);
    }

    public function sortByVolume(Request $request)
    {
        if ($request->sortByVolume == 0) {
            $artists = Artist::orderBy('volume_sold', 'DESC')->paginate(5);
        } elseif ($request->sortByVolume == 1) {
            $artists = Artist::orderBy('volume_sold', 'ASC')->paginate(5);
        } else {
            $artists = Artist::paginate(5);
        }

        return view('artists.list')->with('artists', $artists);
    }

    public function getProfile(Request $data) {
        return view('artists.profile');
    }
}
