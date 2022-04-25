<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'exclusivity'
    ];

    protected $appends = [
        'count'
    ];

    public function nfts()
    {
        return $this->hasMany(Nft::class);
    }

    public function getCountAttribute()
    { //get+NombreAtributoAppends+Attribute 
        return $this->nfts()->count();
    }
}
