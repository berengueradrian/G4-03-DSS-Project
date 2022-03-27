<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'volume_sold',
        'description',
    ];

    public function collections() {
        return $this->hasMany(Collection::class);
    }
}
