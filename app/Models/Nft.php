<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'base_price',
        'limit_date',
        'available',
        'actual_price',
        'collection_id',
        'user_id',
        'type_id'
    ];

    public $sortable = [
        'name',
        'base_price',
        'limit_date',
        'available',
        'actual_price',
        'collection_id',
        'type_id'
    ];

    protected $appends = [
        'collectionName',
        'typeName',
        'userName'
    ];

    public function getCollectionNameAttribute() {
        $col = Collection::whereId($this->collection_id)->first();
        return $col;
    }

    public function getTypeNameAttribute() {
        $type = Type::whereId($this->type_id)->first();
        return $type;
    }

    public function getUserNameAttribute() {
        $user = User::whereId($this->user_id)->first();
        return $user;
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->belongsToMany(User::class)->withPivot('amount');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

}
