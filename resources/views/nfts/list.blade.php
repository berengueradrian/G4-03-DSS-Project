@extends('layouts')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List of NFTs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Create NFT</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update NFT</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false">Delete NFT</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
          </div>
        </form>
        
        <form method="GET" action="{{url('/nfts/available')}}">
          @method('GET')
          @csrf
          <div class="input-group">
            <select name="availableFilter" class="custom-select" id="inputGroupSelect04">
              <option value="0">Filter by availability...</option>
              <option value="1">Available</option>
              <option value="2">Not available</option>
            </select>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">Filter</button>
            </div>
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
            </div>
        </form>
      </div>  
    </div>
    <table class="table table-hover">
      <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Actual Price</th>
              <th scope="col">Exclusivity</th>
              <th scope="col">Limit Date</th>

          </tr>
      </thead>
      <tbody>
          @foreach ($nfts as $nft)
          <tr>
              <td>{{ $nft->id }}</td>
              <td><a href="/api/nfts/{{$nft->id}}">{{ $nft->name }}</a></td>
              <td>{{ $nft->actual_price }}</td>
              <td>{{ $nft->type->name }}</td>
              <td>{{ $nft->limit_date }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>

  {{ $nfts->appends($_GET)->links() }} <!-- This is done to prevent pagination swap page to 'forget' about the data filtered or ordered -->
  @if ($errors->has('name') || $errors->has('base_price') || $errors->has('collection_id') || $errors->has('type_id') || $errors->has('user_id'))
      <div class="invalid-tooltip mb-3 mt-3">ERROR: The NFT has not been created</div>
  @endif
  @if ($errors->has('id_update') || $errors->has('limit_date') || $errors->has('collection_id_update') || $errors->has('user_id_update') || $errors->has('type_id_update') || $errors->has('base_price_update'))
      <div class="invalid-tooltip mb-3 mt-3">ERROR: The NFT has not been updated</div>
  @endif
  @if ($errors->has('iddelete'))
      <div class="invalid-tooltip mb-3 mt-3">ERROR: The NFT has not been deleted</div>
  @endif
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      @include('nfts.create')
  </div>
  <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
      @include('nfts.update')
  </div>
  <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
      @include('nfts.delete')
  </div>
</div>

@endsection

<style lang="scss">
    .modifiers{
        display: flex;
        flex-flow: row wrap;
    }
    .filters{
        display: flex;
        flex-flow: row nowrap;        
    }
    .sorts{
        display: flex;
        flex-flow: row nowrap;
    }
    form{
        width: 300px !important;
        background-color: transparent !important;
        border: none !important;
        padding: 0px !important;
        margin-top: 20px !important;
        margin-bottom: 0px !important;
        margin-right: 20px;
    }
    form button{
      margin-bottom: 0px !important;
    }
</style>