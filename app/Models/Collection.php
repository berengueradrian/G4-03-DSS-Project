<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public function artists() {
        return $this->belongsTo(Artist::class);
    }

    public function nfts() {
        return $this->hasMany(NFT::class);
    }

    public function uploadCollection(array $nfts) : bool {
        return false;
    }

    public function putOnSaleCollection(array $nfts) : bool {
        return false;
    }
}
