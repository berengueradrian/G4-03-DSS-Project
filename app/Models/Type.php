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

    public static function getAll() {
        return Type::paginate(5);
    }

    public static function createType($name, $description, $exclusivity) {
        Type::create([
            'name' => $name,
            'description' => $description,
            'exclusivity' => $exclusivity
        ]);
    }

    public static function updateType($updates, $newType) {
        if ($updates['name_update']) {
            $newType->name = $updates['name_update'];
        }
        if ($updates['description_update']) {
            $newType->description = $updates['description_update'];
        }
        if ($updates['exclusivity_update']) {
            $newType->exclusivity = $updates['exclusivity_update'];
        }
        $newType->update();
    }

    public static function sortingBy($field, $order) {
        if ($order == 0) {
            return Type::orderBy($field, 'ASC')->paginate(5);
        } elseif ($order == 1) {
            return Type::orderBy($field, 'DESC')->paginate(5);
        } else {
            return Type::getAll();
        }
    }
}
