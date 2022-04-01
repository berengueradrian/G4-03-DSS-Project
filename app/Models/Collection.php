<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    public function nfts() {
        return $this->hasMany(Nft::class);
    }

    public function uploadCollection(array $nfts) : bool {
        return false;
    }

    public function putOnSaleCollection(array $nfts) : bool {
        return false;
    }
}
