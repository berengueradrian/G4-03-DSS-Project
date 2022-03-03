<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NFT extends Model
{
    use HasFactory;

    public function collection() {
        return $this->belongsTo(Collection::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function putOnSaleNFT(string $id) : bool {
        return false;
    }

    public function bidNFT(string $id) : bool {
        return false;
    }

    public function purchaseNFT(string $id) : bool {
        return false;
    }

    public function auction(string $id) : bool {
        return false;
    }
}
