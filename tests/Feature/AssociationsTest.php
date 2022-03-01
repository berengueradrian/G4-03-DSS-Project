<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\Collection;
use App\Models\NFT;
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
        $collection->artist()->associate($artist);
        $collection->save();

        $this->assertEquals($artist->collections[0]->description,'MARITOOOOOO');
        $this->assertEquals($collection->artist->name,'moroman');
        
        
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
        $collection->artist()->associate($artist);
        $collection->save();
        
        $nft = new NFT();
        $nft->name = 'toto';
        $nft->base_price = 1.2;
        $nft->exclusive = false;
        $nft->limit_date = new DateTime('now');
        $nft->available = true;
        $nft->actual_price = 1.2;

        $nft->collection()->associate($collection);
        $nft->save();

        $this->assertEquals($nft->collection->description, 'MARITOOOOOO');
        $this->assertEquals($collection->nfts[0]->name,'toto');

        $nft->delete();
        $collection->delete();
        $artist->delete();
        
        

    }


}
