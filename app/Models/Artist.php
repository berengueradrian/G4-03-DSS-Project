<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class Artist extends Authenticatable
{

    use HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'img_url',
        'description',
        'volume_sold',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function collections() {
        return $this->hasMany(Collection::class);
    }

    public static function getAll() {
        return Artist::paginate(5);
    }

    public static function createArtist($name, $password) {
        return Artist::create([
            'name' => $name,
            'password' => Hash::make($password)
        ]);
    }

    public static function updateAfterCreate($artist, $data) {
        $artist->balance = $data->balance;
        $artist->img_url = $data->img_url;
        $artist->description = $data->description;
        $artist->save();
    }

    public static function hasCollections($artist) {
        return $artist->collections->count() > 0;
    }

    public static function deleteArtist($artist) {
        if (Artist::hasCollections($artist)) {
            return Artist::getAll();
        } else {
            $artist->delete();
            return false;
        }
    }

    public static function updateName($newArtist, $request) {
        if (\Hash::check($request->current_password_name, $newArtist->password)) {
            $newArtist->name = $request->name_update_profile;
            session()->flash('msg', 'Name updated correctly!');
            $newArtist->update();
        } else {
            session()->flash('errorMsg', 'Invalid password!');
        }
    }

    public static function updatePassword($newArtist, $request) {
        if (\Hash::check($request->current_password_password, $newArtist->password)) {
            $newArtist->password = \Hash::make($request['password_update_profile']);
            $newArtist->update();
            session()->flash('msg', 'Password updated correctly!');
        } else {
            session()->flash('errorMsg', 'Invalid current password!');
        }
    }

    public static function updateDescription($newArtist, $request) {
        if (\Hash::check($request->current_password_description, $newArtist->password)) {
            $newArtist->description = $request['description_update_profile'];    
            $newArtist->update();
            session()->flash('msg', 'Description updated correctly!');
        } else {
            session()->flash('errorMsg', 'Invalid password!');
        }
    }

    public static function updateArtist($newArtist, $updates) {
        if($updates['img_profile']) {
            $newArtist->img_url = $updates['img_profile'];
            session()->flash('msg', 'Image updated correctly!');
        }
        if($updates['name']) {
            $newArtist->name = $updates['name'];
        }
        if($updates['description']) {
            $newArtist->description = $updates['description'];
        }
        if($updates['img']) {
            $newArtist->img_url = $updates['img'];
        }
        if($updates['volume']) {
            $newArtist->volume_sold = $updates['volume'];
        }
        if($updates['balance']) {
            $newArtist->balance = $updates['balance'];
        }
        $newArtist->update();
    }

    public static function sortingBy($field, $order) {
        if ($order == 0) {
            return Artist::orderBy($field, 'DESC')->paginate(5);
        }
        elseif ($order == 1) {
            return Artist::orderBy($field, 'ASC')->paginate(5);
        }
        else{
            return Artist::getAll();
        }
        
    }
}
