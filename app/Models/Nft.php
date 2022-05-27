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
        'type_id',
        'img_url'
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
    
    

    public static function getExpensive()
    {
        $nft = Nft::selectRaw('*')->whereRaw('actual_price = (select max(actual_price) from nfts)')->get();
        return $nft->first();
    }

    public static function getPopulars()
    {
        return Nft::orderBy('actual_price', 'DESC')->skip(1)->take(4)->get();
    }
    
    public static function createNft($name, $base_price, $actual_price, $available, $collection_id,
    $type_id, $user_id, $img_url)
    {
        Nft::create([
            'name' => $name,
            'base_price' => $base_price,
            'actual_price' => $actual_price,
            'available' => $available,
            'collection_id' => $collection_id,
            'type_id' => $type_id,
            'user_id' => $user_id,
            'img_url' => $img_url
        ]);
    }

    public static function deleteNft($id)
    {

        $nft = Nft::find($id);
        $nft->delete();
    }



    public static function updateNft($updates, $newNft)
    {
        if ($updates['name']) {
            $newNft->name = $updates['name'];
        }
        if ($updates['base_price']) {
            $newNft->base_price = $updates['base_price'];
            $newNft->actual_price= $updates['base_price'];
        } 
        if($updates['limit_date']){
            $newNft->limit_date = $updates['limit_date'];            
        }        
        if($updates['collection_id']){
            $newNft->collection_id = $updates['collection_id'];
        }        
        if($updates['user_id']){
            $newNft->user_id = $updates['user_id'];
        }        
        if($updates['type_id']){
            $newNft->type_id = $updates['type_id'];
        }        
        if($updates['img_url']){
            $newNft->img_url = $updates['img_url'];
        }
        if($updates['available']){
            $newNft->available = $updates['available'];
        }        
            
        $newNft->update();


    }


    public static function available($availableFilter, $reqInputType)
    {
        if ($reqInputType == 'market') {
            if ($availableFilter == 1) { //Available NFTS
                $nfts = Nft::whereAvailable(1)->get();
            } elseif ($availableFilter == 2) { //Non Available NFTS
                $nfts = Nft::whereAvailable(0)->get();
            } else { // If == 0 -> All
                $nfts = Nft::all();
            }
            return $nfts;
        }
        else {
            if ($availableFilter == 1) { //Available NFTS
                $nfts = Nft::whereAvailable(1)->paginate(5);
            } elseif ($availableFilter == 2) { //Non Available NFTS
                $nfts = Nft::whereAvailable(0)->paginate(5);
            } else { // If == 0 -> All
                $nfts = Nft::paginate(5);
            }
            return $nfts;
        }
    }

    public static function filterPrice($reqInputType , $reqPrice)
    {
        if ($reqInputType == 'market') {
            if ($reqPrice != null) {
                $nfts = Nft::where('actual_price', '>', $reqPrice)->get();
            } else {
                $nfts = Nft::all();
            }
            return $nfts;   
        } else {
            if ($reqPrice != null) {
                $nfts = Nft::where('actual_price', '>', $reqPrice)->paginate(5);
            } else {
                $nfts = Nft::paginate(5);
            }
            return $nfts;  
        }
    }

    public static function sortByPrice($reqInputType, $reqSortByPrice)
    {
        if ($reqInputType == 'market') {
            if ($reqSortByPrice == 0) {
                $nfts = Nft::orderBy('actual_price', 'ASC')->get();
            } elseif ($reqSortByPrice == 1) {
                $nfts = Nft::orderBy('actual_price', 'DESC')->get();
            } else {
                $nfts = Nft::all();
            }
            return  $nfts;
        }
        else {
            if ($reqSortByPrice == 0) {
                $nfts = Nft::orderBy('actual_price', 'ASC')->paginate(5);
            } elseif ($reqSortByPrice == 1) {
                $nfts = Nft::orderBy('actual_price', 'DESC')->paginate(5);
            } else {
                $nfts = Nft::paginate(5);
            }
            return  $nfts;
        }
    }

    public static function sortByExclusivity($reqInputType, $reqSortByExclusivity)
    {
        if ($reqInputType == 'market') {
            if ($reqSortByExclusivity == 0) {
                $nfts = Nft::orderBy('type_id', 'DESC')->get();
            } elseif ($reqSortByExclusivity == 1) {
                $nfts = Nft::orderBy('type_id', 'ASC')->get();
            } else {
                $nfts = Nft::all();
            }
            return $nfts;   
        }
        else {
            if ($reqSortByExclusivity == 0) {
                $nfts = Nft::orderBy('type_id', 'DESC')->paginate(5);
            } elseif ($reqSortByExclusivity == 1) {
                $nfts = Nft::orderBy('type_id', 'ASC')->paginate(5);
            } else {
                $nfts = Nft::paginate(5);
            }
            return $nfts;
        }
    }

    public static function putOnSaleNFT($id)
    {
        $newNft = Nft::whereId($id)->first();
        if ($newNft->available) {
            return true;
        } else {
            $newNft->available = true;
            $newNft->save();
            return false;
        }
    }

    public function auction($id, DateTime $limit_date)
    {
        $newNft = NFT::whereId($id)->first(); 
        if($newNft->available && $newNft->limit_date != null) {
            return true;
        }
        else {
            $newNft->available = true;
            $newNft->limit_date = $limit_date;
            $newNft->save();
            return false;
        }
    }

    

}
