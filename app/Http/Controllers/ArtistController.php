<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function get(Artist $artist)
    {
        return response()->json(['artist' => $artist]);
    }

    public function getAll()
    {
        $artists = Artist::all();
        return response()->json(['artists' => $artists]);
    }

    public function create(Request $data)
    {
        $artist = Artist::create([
            'name' => $data->name,
            'balance' => $data->balance,
            'volume_sold' => $data->volume_sold,
            'description' => $data->description
        ]);
        return response()->json(['success' => true, 'artist' => $artist]);
    }

    public function delete(Artist $artist)
    {
        if (Artist::whereID($artist->id)->count()) {
            $artist->delete();
            return response()->json(['success' => true, 'artist' => $artist]);
        }

        return response()->json(['success' => false]);
    }

    public function update(Request $request, Artist $artist)
    {
        $newArtist = Artist::find($artist->id);
        if($request->filled('name')) {
            $newArtist->name = $request->name;
        }
        if($request->filled('description')) {
            $newArtist->description = $request->description;
        }
        if($request->filled('img_url')) {
            $newArtist->img_url = $request->img_url;
        }
        $newArtist->save();
    }

    public function sortByName(Request $request) {
        if ($request->sortByName == 0) {
            $artists = Artist::orderBy('name', 'DESC')->paginate(2);
        } elseif ($request->sortByName == 1) {
            $artists = Artist::orderBy('name', 'ASC')->paginate(2);
        } else {
            $artists = Artist::paginate(2);
        }

        return view('artists.list')->with('artists', $artists);
    }
}
