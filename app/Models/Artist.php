<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
