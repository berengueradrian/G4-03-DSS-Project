<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'artist_id'
    ];

    protected $appends = [
        'artistName'
    ];

    public static function createCollection($name, $description, $artist_id) {
        return Collection::create([
            'name' => $name,
            'description' => $description,
            'artist_id' => $artist_id
        ]);
    }

    public static function updateAfterCreate($collection, $data) {
        $collection->img_url = $data->img_url;
        $collection->save();
    }

    public static function deleteCollection($collection) {
        $collection->delete();
    }

    public static function updateCollection($newCollection, $request) {

        $newCollection->name = $request->name_final;
        if($request->description_update) {
            $newCollection->description = $request->description_update;
        }
        if ($request->description_update != null) {
            $newCollection->artist_id = $request->artist_id_update;
        }
        if ($request->img_url_update != null) {
            $newCollection->img_url = $request->img_url_update;
        }
        $newCollection->update();
    }

    public function getArtistNameAttribute() {
        $artist = Artist::whereId($this->artist_id)->first();
        return $artist;
    }

    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    public function nfts() {
        return $this->hasMany(Nft::class);
    }

}
