<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Collection;
use Illuminate\Http\Exceptions\HttpResponseException;
use Auth;
use \Hash;

class ArtistController extends Controller
{
    public function get(Artist $artist)
    {
        return view('artists.details')->with('artist', $artist);
    }

    public function getAll()
    {
        $artists = Artist::getAll();
        return view('artists.list')->with('artists', $artists)->with('withCollection', false);
    }

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required|max:50',
            'artistPassword' => 'required'
        ]);

        $artist = Artist::createArtist($data->name, $data->artistPassword);

        if ($data->balance != null) {
            $data->validate(['balance' => 'numeric|gte:0|digits_between:1,20']);
        } else {
            $data->balance = 0.0;
        }
        if ($data->img_url != null) {
            $data->validate([
                'img_url' => 'max:50',
            ]);
        } else {
            $data->img_url = 'default.jpg';
        }
        if ($data->description != null) {
            $data->validate([
                'description' => 'max:50',
            ]);
        } else {
            $data->description = '';
        }
        Artist::updateAfterCreate($artist, $data);
        return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|numeric|exists:artists,id'
        ]);
        $artist = Artist::find($request->iddelete);
        if ($artists = Artist::deleteArtist($artist)) {
            return view('artists.list')->with('artists', $artists)->with('withCollection', true);
        }
        return back()->with('withCollection', false);
    }

    public function updateProfileName(Request $request) {
        
        $request->validate([
            'id_update' => 'required'
        ]);
        $newArtist = Artist::find($request->id_update);
        // ARTIST NAME PROFILE SETTINGS
        $request->validate([
            'name_update_profile' => 'required|max:50',
            'passwordName' => 'required',
            'current_password_name' => 'required|same:passwordName',
        ]);
        Artist::updateName($newArtist, $request);
        return back();
    }

    public function updateProfilePassword(Request $request) {
        $request->validate([
            'id_update' => 'required'
        ]);
        $newArtist = Artist::find($request->id_update);
        $request->validate([
            'password_update_profile' => 'required|max:50',
            'password_password' => 'required',
            'current_password_password' => 'required|same:password_password',
        ]);
        Artist::updatePassword($newArtist, $request);
        return back();
    }

    public function updateProfileDescription(Request $request) {
        $request->validate([
            'id_update' => 'required'
        ]);
        $newArtist = Artist::find($request->id_update);
        $request->validate([
            'description_update_profile' => 'required',
            'password_description' => 'required',
            'current_password_description' => 'required|same:password_description',
        ]);
        Artist::updateDescription($newArtist, $request);
        return back();
    }

    public function update(Request $request)
    {
        $updates = ['img_profile' => false, 'name' => false, 'description' => false, 'img' => false, 'volume' => false, 'balance' => false];
        $request->validate([
            'id_update' => 'required'
        ]);
        $newArtist = Artist::find($request->id_update);
        // ARTIST IMG_URL PROFILE SETTINGS
        if ($request->filled('img_url_update')) {
            $request->validate(['img_url_update' => 'max:50']);
            //$newArtist->img_url = $request->img_url_update;
            $updates['img_profile'] = $request->img_url_update;
            //session()->flash('msg', 'Image updated correctly!');
        }
        // ----------------------------------
        if ($request->filled('name_update')) {
            $request->validate([
                'name_update' => 'max:50',
            ]);
            //$newArtist->name = $request->name_update;
            $updates['name'] = $request->name_update;
        }
        if ($request->filled('description_update')) {
            $updates['description'] = $request->description_update;
            //$newArtist->description = $request->description_update;
        }
        if ($request->filled('img_url_update')) {
            $request->validate([
                'img_url_update' => 'max:50',
            ]);
            $updates['img'] = $request->img_url_update;
            //$newArtist->img_url = $request->img_url_update;
        }
        if ($request->filled('volume_sold_update')) {
            $request->validate([
                'volume_sold_update' => 'numeric|gte:0'
            ]);
            $updates['volume'] = $request->volume_sold_update;
            //$newArtist->volume_sold = $request->volume_sold_update;
        }
        if ($request->filled('balance_update')) {
            $request->validate([
                'balance_update' => 'numeric|gte:0'
            ]);
            $updates['balance'] = $request->balance_update;
            //$newArtist->balance = $request->balance_update;
        }
        //$newArtist->update();
        Artist::updateArtist($newArtist, $updates);

        return back();
    }

    public function sortByName(Request $request)
    {
        $artists = Artist::sortingBy('name', $request->sortByName);
        return view('artists.list')->with('artists', $artists);
    }

    public function sortByBalance(Request $request)
    {
        $artists = Artist::sortingBy('balance', $request->sortByBalance);
        return view('artists.list')->with('artists', $artists);
    }

    public function sortByVolume(Request $request)
    {       
        $artists = Artist::sortingBy('volume_sold', $request->sortByVolume);
        return view('artists.list')->with('artists', $artists);
    }

    public function getProfile(Request $data) {
        return view('artists.profile');
    }

    public function addCollection(Artist $artist) {
        if (Auth::guard('custom')->user()->id==$artist->id) {
            return view('artists.addCollection')->with('artist',$artist);
        }else
            return response()->json(['JAJA' => 'Casi bro'], 401);
        
    }

    public function addNft(Artist $artist, Collection $collection) {
        if (Auth::guard('custom')->user()->id==$artist->id && $artist->id==$collection->artist_id) {
            return view('collections.add-nft')->with('collection', $collection);
        }else
            return response()->json(['JAJA' => 'Casi bro'], 401);
        
    }

    public function editCollection(Artist $artist, Collection $collection) {
        if (Auth::guard('custom')->user()->id==$artist->id && $artist->id==$collection->artist_id) { 
            return view('artists.editCollection')->with('collection', $collection);
        }
        return response()->json(['JAJA' => 'Casi bro'], 401);
    }

    public function getProfileSettings(Request $data) {
        return view('artists.profileSettings');
    }

    public function deleteArtist(Request $request) {
        Auth::guard('custom')->logout();
        $artist = Artist::find($request->artistId);
        $artist->delete();
        return redirect('login');
    }
}
