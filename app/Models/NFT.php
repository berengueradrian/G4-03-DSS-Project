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

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function putOnSaleNFT(int $id) : bool {
        return false;
    }

    public function bidNFT(int $id) : bool {
        return false;
    }

    public function purchaseNFT(int $id) : bool {
        return false;
    }

    public function auction(int $id) : bool {
        return false;
    }
}
