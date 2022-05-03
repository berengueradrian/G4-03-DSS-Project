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
