@extends('layouts')

@section('content')
  <div class="marketplace-section">
    <div class="marketplace-title">
      Marketplace
    </div>
    <div class="modifiers">
      <div class="filters">
        <form method="GET" action="{{url('/nfts/priceFilter')}}">
          @method('GET')
          @csrf
          <div class="input-group">
            <input type="text" name="price" class="form-control" placeholder="Filter by price upper than..." aria-label="filterPrice" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">Filter</button>
            </div>
            <input type="hidden" value="market" name="type">
          </div>
        </form>
      </div>


      <div class="sorts">
        <form method="GET" action="{{url('/nfts/sortByPrice')}}">
          @method('GET')
          @csrf
          <div class="input-group">
            <select name="sortByPrice" class="custom-select" id="inputGroupSelect04">
              <option value="-1">Sort by actual price...</option>
              <option value="0">Cheapest first</option>
              <option value="1">Highest first</option>
            </select>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">Sort</button>
            </div>
            <input type="hidden" value="market" name="type">
          </div>
        </form>
        <form method="GET" action="{{url('/nfts/sortByExclusivity')}}">
          @method('GET')
          @csrf
          <!--<select name="sortByExclusivity">
                <option value="-1"> -- Sort by exclusivity -- </option>
                <option value="0">Less exclusive first</option>
                <option value="1">Most exclusive first</option>
            </select>
            <button type="submit" class="btn btn-primary">Search</button>-->
          <div class="input-group">
            <select name="sortByExclusivity" class="custom-select" id="inputGroupSelect04">
              <option value="-1">Sort by exclusivity...</option>
              <option value="0">Most exclusive first</option>
              <option value="1">Less exclusive first</option>
            </select>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">Sort</button>
            </div>
            <input type="hidden" value="market" name="type">
          </div>
        </form>
      </div>
    </div>
    <div class="centered-nfts">
      <div class="marketplace-nfts">
        @foreach($nfts as $nft)
        <a class="linkNft" href="/nfts/buy/{{ $nft->id }}"><div class="marketplace-popular-nfts-rest-item @if($nft->type_id=='5') leg @endif">
          <img src="/images/{{ $nft->img_url }}" alt="" class="marketplace-popular-nfts-rest-img">
          <div class="marketplace-popular-nfts-rest-data">
            <div class="rest-main-data">
              <p>{{$nft->name}}</p>
              <p>{{$nft->actual_price}}$</p>
            </div>
            <i><p class="rest-type">{{$nft->type->name}}</p></i>
          </div>
        </div></a>
        @endforeach
      </div>
    </div>
  </div>
@endsection

<style lang="scss">
.leg:hover{
  /* background-color: #4709D5 !important; */
  background-color: #e0aa33 !important;
  transition: 0.5s ease all !important;
  color: white;
  font-weight: bold;
}
.marketplace-title{
  font-size: 3.5rem;
  text-align: center;
  margin-bottom: 100px;
}

.modifiers {
  display: flex;
  flex-flow: row wrap;
  gap: 20px;
  margin-bottom: 50px;
  justify-content: center;
}

.filters {
  display: flex;
  flex-flow: row nowrap;
  gap: 20px;
}

.sorts {
  display: flex;
  flex-flow: row nowrap;
  gap: 20px;
}

.centered-nfts{
  width: 100%;
  display: flex;
  justify-content: center;
}

.marketplace-nfts{
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
  gap: 20px;
}

.marketplace-popular-nfts-rest-item{
  width: 350px;
  cursor: pointer;
  padding: 20px;
  border-radius: 20px;
  transition: .2s ease all;
}

.marketplace-popular-nfts-rest-item:hover{
  background-color: whitesmoke;
  transition: .2s ease all; 
}

.marketplace-popular-nfts-rest-item .marketplace-popular-nfts-rest-img{
  width: 100%;
  margin-bottom: 20px;
  border-radius: 20px;
}
.marketplace-popular-nfts-rest-data{
  padding-right: 20px;
  padding-left: 10px;
  font-size: 1.2rem;
  justify-content: space-between;
  display: flex;
  flex-flow: row wrap;
}
.rest-main-data{
  display: flex;
  flex-flow: column nowrap;
  margin-right: 50px;
}

.rest-main-data p{
  margin-bottom: 0px !important;  
}

.linkNft:hover{
  text-decoration: none !important;
  color: black !important;
}

.linkNft{
  color: black !important;
}

</style>