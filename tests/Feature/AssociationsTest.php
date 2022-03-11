<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\Collection;
use App\Models\NFT;
use App\Models\User;
use App\Models\Type;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssociationTest extends TestCase
{
    /**
     * Checks the association between Artist-Collection (1.1-0.N)
     *
     * @return void
     */
    public function testAssociationArtistCollection()
    {
        $artist = new Artist();
        $artist->name = 'moroman';
        $artist->balance = 33;
        $artist->volume_sold = 4;
        $artist->description = 'Hola soy moro';
        $artist->save();

        $collection = new Collection();
        $collection->description = 'MARITOOOOOO';
        $collection->name = 'col3';
        $collection->artist()->associate($artist);
        $collection->save();

        $this->assertEquals('MARITOOOOOO', $artist->collections[0]->description);
        $this->assertEquals('moroman', $collection->artist->name);
        
        $collection->delete(); 
        $artist->delete();
    }

    /**
     * Checks the association between Collection-NFT (1.1-0.N)
     *
     * @return void
     */
    public function testAssociationCollectionNFT(){

        $artist = new Artist();
        $artist->name = 'moroman';
        $artist->balance = 33;
        $artist->volume_sold = 4;
        $artist->description = 'Hola soy moro';
        $artist->save();
        
        $collection = new Collection();
        $collection->description = 'MARITOOOOOO';
        $collection->name = 'col3';
        $collection->artist()->associate($artist);
        $collection->save();
        
        $type = new Type();
        $type->name = 'exclusive';
        $type->description = 'desc';
        $type->save();

        $nft = new NFT();
        $nft->name = 'tete';
        $nft->base_price = 1.2;
        $nft->limit_date = new DateTime('now');
        $nft->available = true;
        $nft->actual_price = 1.2;
        $nft->collection()->associate($collection);
        $nft->type()->associate($type);
        $nft->save();

        $this->assertEquals('MARITOOOOOO', $nft->collection->description);
        $this->assertEquals('tete', $collection->nfts[0]->name);

        $nft->delete();
        $collection->delete();
        $artist->delete();
    }

    /**
     * Checks the association between User-NFT (0.1-0.N)
     *
     * @return void
     */
    public function testAssociationUserNFT(){
        $artist = new Artist();
        $artist->name = 'moroman';
        $artist->balance = 33;
        $artist->volume_sold = 4;
        $artist->description = 'Hola soy moro';
        $artist->save();
        
        $collection = new Collection();
        $collection->description = 'MARITOOOOOO';
        $collection->name = 'col3';
        $collection->artist()->associate($artist);
        $collection->save();
        
        $user = new User();
        $user->name = 'mario';
        $user->email = 'email5';
        $user->password = 'hola';
        $user->balance = 4.5;
        $user->save();

        $type = new Type();
        $type->name = 'exclusive';
        $type->description = 'desc';
        $type->save();

        $nft = new NFT();
        $nft->name = 'tete';
        $nft->base_price = 1.2;
        $nft->limit_date = new DateTime('now');
        $nft->available = true;
        $nft->actual_price = 1.2;
        $nft->collection()->associate($collection);
        $nft->type()->associate($type);
        //$nft->user()->associate($user); not needed because of the save on user bellow
        $nft->save(); //if we delete it it is saved automatically when saving it into user
        
        $user->nfts()->save($nft);

        $this->assertEquals('tete', $user->nfts[0]->name);
        $this->assertEquals('mario', $nft->user->name);

        $nft->delete();
        $user->delete();
        $collection->delete();
        $artist->delete();
    }

    /**
     * Checks the association between User-NFT (0.1-0.N)
     *
     * @return void
     */
    public function testAssociationTypeNFT(){
        $artist = new Artist();
        $artist->name = 'moroman';
        $artist->balance = 33;
        $artist->volume_sold = 4;
        $artist->description = 'Hola soy moro';
        $artist->save();
        
        $collection = new Collection();
        $collection->description = 'MARITOOOOOO';
        $collection->name = 'col3';
        $collection->artist()->associate($artist);
        $collection->save();
        
        $user = new User();
        $user->name = 'mario';
        $user->email = 'email4';
        $user->password = 'hola';
        $user->balance = 4.5;
        $user->save();

        $type = new Type();
        $type->name = 'exclusive';
        $type->description = 'desc';
        $type->save();

        $nft = new NFT();
        $nft->name = 'tete';
        $nft->base_price = 1.2;
        $nft->limit_date = new DateTime('now');
        $nft->available = true;
        $nft->actual_price = 1.2;
        $nft->collection()->associate($collection);
        $nft->type()->associate($type);

        $nft->save();
        $user->nfts()->save($nft);

        $this->assertEquals('exclusive', $nft->type->name);
        $this->assertEquals('tete', $type->nfts[0]->name);

        $nft->delete();
        $user->delete();
        $collection->delete();
        $artist->delete();
    }

}
