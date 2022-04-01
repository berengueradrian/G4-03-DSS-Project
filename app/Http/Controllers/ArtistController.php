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
        $newArtist->name = $request->name;
        if($request->filled('description')) {
            $newArtist->description = $request->description;
        }
        $newArtist->save();
    }
}
