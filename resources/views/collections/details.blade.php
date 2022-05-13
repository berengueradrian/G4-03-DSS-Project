@extends('layouts')

@section('content')
<div class="collection">
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
                <img src="../../images/{{ $collection->artist->img_url }}" alt="" width="100%" style="border: 1px black solid">
            </div>
            <div class="artist-name">
                {{$collection->artist->name}}
            </div>
        </div>
    </div>
    <div class="col-nfts">
        <h3>NFTS</h3>
        <div class="nfts">
            @foreach ($collection->nfts as $nft)
                <div class="nft">
                    <img src="../../images/{{ $nft->img_url }}" width="100%" alt="" style="border: 1px black solid">
                </div>
            @endforeach
        </div>

    </div>
</div>

<style lang="scss">
    .collection{
        margin-left: 120px;
        margin-right: 120px;
    }
    .col-info{
        display: flex;
        align-items: center;
        margin-bottom: 100px;
        
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
        width: 32%;
    }
    .col-artist{
        margin-left: 100px;
        width: 12%;
        display: flex;
        flex-flow: column;
        align-items: center;
    }

    .nfts{
        margin-top: 30px;
        margin-left: 200px;
        margin-right: 200px;
        display: flex;
        flex-wrap: wrap;
        width: 15%;
    }
</style>

@endsection