@extends('layouts')

@section('content')
<h1> User information </h1>
<p><strong>Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Balance:</strong> {{ $user->balance }}</p>
<div class="img-container" style="display: flex; align-items:flex-start; margin-bottom:20px">
    <p><strong style="margin-right: 20px">Image:</strong></p>
    <img src="../../images/{{ $user->img_url }}" alt="" width="200px" style="border: 1px black solid;">
</div>
@if($user->nfts->count() > 0)
    <p><strong>NFTs:</strong></p>
    <div class="centered-nfts">
    <div class="marketplace-nfts">
    @foreach($user->nfts as $nft)
    <a class="linkNft" href="/nfts/buy/{{ $nft->id }}"><div class="marketplace-popular-nfts-rest-item">
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
@else
    <p><strong>This user has not got NFTs purchased</strong></p>
@endif
<p><a href="/api/users">Go back</a></p>
@endsection

<style lang="scss">
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
</style>