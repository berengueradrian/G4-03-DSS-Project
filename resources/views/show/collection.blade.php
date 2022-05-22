@extends('layouts')

@section('content')
<div class="collection">
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {!! Session::has('success') ? Session::get("success") : '' !!}
    </div>
    @elseif(Session::has('fail'))
    <div class="alert alert-danger" role="alert">
        {!! Session::has('fail') ? Session::get("fail") : '' !!}
    </div>
    @endif
    <div class="col-info">
        <div class="col-pic">
            <img src="../../images/{{ $collection->img_url }}" alt="" width="100%" style="border: 1px black solid">
        </div>
        <div class="col-text">
            <h1>{{ $collection->name }}</h1>
            <h2>
                Description
            </h2>

            <h5>
                {{$collection->description}}
            </h5>
        </div>
        <div class="col-artist">
            <h2>
                Artist
            </h2>
            <div class="artist-pic">
            <a href="/artists/{{$collection->artist->id}}">
                <img src="../../images/{{ $collection->artist->img_url }}" alt="" width="100%" style="border: 1px black solid">
            </a>
            </div>
            <div class="artist-name">
                {{$collection->artist->name}}
            </div>
        </div>
        
    </div>

    @if(Auth::guard('custom')->user()->id == $collection->artist_id )
    <div class="edit-collection" style="margin-bottom: 20px;">
        <a href="/profile/artists/{{$collection->artist_id}}/collections/{{$collection->id}}/edit">
        <button class="btn btn-primary" style="align-self: center;">Edit Collection</button>
        </a>
    </div>
    @if(!$collection->on_sale)
    <div class="centered" style="align-items: center; width: 100%;">
    <div class="putSale" style="align-items: center; text-align: left; align-content: center; width:100%;">
    <div class="col-text2">
        <h5>Put on sale your collection introducing the limit date for the bidable nfts</h5>
    </div>
        <form action="{{ route('collection.sale', ['collection' => $collection->id]) }}" method="POST" class="needs-validation create-sale-container">
            @csrf
            @method('POST')
            <div class="input-group mb-3 bootstrap-input" style="width: 37%; align-items: center;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Limit Date</span>
                    </div>
                    <input type="date" style="width: 20px;" class="form-control" name="limit_date" placeholder="" aria-label="Username" aria-describedby="basic-addon3" id="limit_date">
            </div>
            @if ($errors->has('limit_date')) 
                @foreach ($errors->get('limit_date') as $error)
                <div class="invalid-tooltip mb-3" >{{ $error }}</div>
                @endforeach
            @endif
            <button type="submit" class="btn btn-primary" style="align-self: center;">Put on sale collection</button>
            {!! Session::has('msg') ? Session::get("msg") : '' !!}    
        </form>
    </div>
    </div>
    @endif
    @endif
    <div class="col-nfts">
        <h3>NFTS</h3>
        <div class="nfts">
            @foreach ($collection->nfts as $nft)
                <div class="nft" style="width: 200px; margin-right:50px;margin-bottom:30px;">
                <a href="/nfts/buy/{{$nft->id}}">
                    <img src="../../images/{{ $nft->img_url }}" width="100%" height="135.65px" alt="" style="border: 1px black solid">
                </a>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

<style lang="scss">
    
    .invalid-tooltip {
        display: block!important;
        position: relative!important;
        width: fit-content!important;
    }

    .putSale {
        align-items: center;
    }
    .input-group-text {
        display: flex;
        align-items: center;
        justify-content: center;
        /* margin: auto; */
        width: fit-content;
    }
    .form-control {
        width: 30%!important;
        display:flex;
    }
    .input[type="date"] {
        display:flex;
        width: 20px;
    }
    .centered {
        display: flex;
        align-items: center;
        width: 100%;
        /* text-align: center; */
    }
    .col-text2{
        align-self: flex-start;
        height: 100%;
        margin-bottom: 20px;
    }

    .collection{
        margin-left: 7%;
        margin-right: 7%;
        align-self: center;
    }
    .col-info{
        display: flex;
        align-items: center;
        margin-bottom: 100px;
        flex-wrap: wrap;
        
    }
    h3{
        font-size: 35px;
        text-align: center;
    }
    h2{
        opacity: .5;
    }
    h1{
        font-size:60px;

    }
    .col-text{
        align-self: flex-start;
        margin-left: 60px;
        height: 100%;
    }
    .col-pic{
        width: 400px;
    }
    .col-artist{
        margin-left: 100px;
        width: 150px;
        display: flex;
        flex-flow: column;
        align-items: center;
    }

    .nfts{
        justify-content: center;
        margin-top: 30px;
        display: flex;
        flex-wrap: wrap;
    }

    @media (max-width:1300px){
        .col-info{
        display: flex;
        align-items: center;
        margin-bottom: 100px;
        flex-flow: column;
        justify-content: center;
        }

        .col-text{
            margin-top: 10px;
            align-self:center;
            height: 100%;
            margin-left: 0;
        }
        .col-pic{
            width: 100%;
        }
        .col-artist{
            width: 150px;
            display: flex;
            flex-flow: column;
            align-items: center;
            margin-top: 20px;
            margin-left: 0;
        }
    }
</style>