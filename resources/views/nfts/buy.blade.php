@extends('layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@if($nft->type_id == 5)
<h3 class="title"><strong>Bid NFT</strong></h3>
@else
<h3 class="title"><strong>Purchase NFT</strong></h3>
@endif

<div class="container" onload="onInit($nft)">
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {!! Session::has('success') ? Session::get("success") : '' !!}
    </div>
    @elseif(Session::has('fail'))
    <div class="alert alert-danger" role="alert">
        {!! Session::has('fail') ? Session::get("fail") : '' !!}
    </div>
    @endif

    <div class="content">

        <div class="left-side">

            <br>
            <div class="foto">
                <img src="/images/{{$nft->img_url}}" width="210" height="150" alt="">
            </div>
            <br>

            <div class="user details">
                <!-- <i class="fas fa-user"></i> -->
                <div class="topic">{{$nft->name}}</div>
                <div class="text-one">#{{$nft->id}}</div>
            </div>

        </div>

        <div class="right-side">

            <div class="textH">
                Actual Price: {{$nft->actual_price}}
                <strong>ETH</strong>
                <img src="/images/eth.svg" height="20px" width="25px" alt="">
            </div>

            <div class="textG">
                Base Price: {{$nft->base_price}}
                <strong>ETH</strong>
                <img src="/images/eth.svg" width="10px" alt="">
            </div>

            @if($nft->type_id == 5 && $nft->available && $nft->limit_date != null)
            <div class="textB">
                Bid finishes in:
            </div>
            <div class="textDays">
                <span id="cd-days">00</span> D
                <span id="cd-hours">00</span> H
                <span id="cd-minutes">00</span> M
                <span id="cd-seconds">00</span> s
            </div>
            @endif

            @auth
            @if($nft->available)
            @if($nft->type_id == 5)
                @php($limit_date = \Carbon\Carbon::parse($nft->limit_date))
                @if(!$limit_date->isPast())
            <!-- Formulario bid -->
            <form action="{{ route('nft.bid', ['nft' => $nft->id]) }}" method="POST" class="needs-validation create-bid-container">
                @csrf
                @method('POST')
                <div class="input-group mb-3 bootstrap-input">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Amount</span>
                    </div>
                    <input type="number" class="form-control" name="bid_amount" placeholder="$ETH" aria-label="Username" aria-describedby="basic-addon3" id="bid_amount">
                </div>
                @if ($errors->has('bid_amount'))
                @foreach ($errors->get('name') as $error)
                <div class="invalid-tooltip mb-3">{{ $error }}</div>
                @endforeach
                @endif
                <div class="input-group mb-3 bootstrap-input">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Wallet</span>
                    </div>
                    <input type="text" class="form-control" name="bid_wallet" placeholder="0x..." aria-label="Username" aria-describedby="basic-addon3" id="bid_wallet">
                </div>
                @if ($errors->has('bid_wallet'))
                @foreach ($errors->get('name') as $error)
                <div class="invalid-tooltip mb-3">{{ $error }}</div>
                @endforeach
                @endif
                <button type="submit" class="btn btn-primary">Place Bid</button>
                {!! Session::has('msg') ? Session::get("msg") : '' !!}
            </form>

                @endif

            @else
                

            @if(Auth::user()->id!=$nft->user_id)
            <!-- This condition is because you cant buy your own NFT -->
            <form action="{{ route('nft.purchase', ['nft' => $nft->id]) }}" method="POST" class="needs-validation create-bid-container">
                @csrf
                @method('POST')
                <div class="input-group mb-3 bootstrap-input">
                    <input type="hidden" class="form-control" name="purchase_amount" value="{{$nft->actual_price}}" placeholder="$ETH" aria-label="Username" aria-describedby="basic-addon3" id="purchase_amount">
                </div>
                @if ($errors->has('purchase_amount'))
                @foreach ($errors->get('purchase_amount') as $error)
                <div class="invalid-tooltip mb-3">{{ $error }}</div>
                @endforeach
                @endif
                <div class="input-group mb-3 bootstrap-input">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Wallet</span>
                    </div>
                    <input type="text" class="form-control" name="purchase_wallet" placeholder="0x..." aria-label="Username" aria-describedby="basic-addon3" id="purchase_wallet">
                </div>
                @if ($errors->has('purchase_wallet'))
                @foreach ($errors->get('purchase_wallet') as $error)
                <div class="invalid-tooltip mb-3">{{ $error }}</div>
                @endforeach
                @endif
                <button type="submit" class="btn btn-primary">Purchase</button>
            </form>
            @elseif($nft->available)
            <div class="textB">
                Your NFT is currently on sale </div>
            @endif

            @endif
            @else
            <div class="text-one">
                This NFT is not on sale.
            </div>
            @endif

            @endauth

            @auth('custom')
            @if($nft->available)
            @if(Auth::guard('custom')->user()->id == $nft->collection->artist_id)
            @php($limit_date2 = \Carbon\Carbon::parse($nft->limit_date))
                @if($limit_date2->isPast())
                <form action="{{ route('nft.close', ['nft' => $nft->id]) }}" method="POST" class="needs-validation create-bid-container">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-primary">Close Bid</button>
                    {!! Session::has('msg') ? Session::get("msg") : '' !!}
                </form>
                @endif
            @endif
            @else
                <div class="text-one">
                    This NFT is not on sale.
                </div>
            @endif
            @endauth

        </div>
    </div>
    
    <div class="nombre">NFT CHARACTERISTICS</div>
    <div class="listado">
        <ul>
            <li>
                <p class="clase2">Collection: {{$nft->collectionName->name}}</p> 
            </li>
            <li>
                <p class="clase2">Type: {{$nft->typeName->name}}</p>
            </li>
            <li>
                <p class="clase2">Type description: {{$nft->typeName->description}}</p>
            </li>
            <li>
                <p class="clase2">Artist: {{$nft->collectionName->artistName->name}}</p>
            </li>
            <li>
                <p class="clase2">Artist description: {{$nft->collectionName->artistName->description}}</p>
            </li>
        </ul>

    </div>
    

</div>
@endsection

<script>
    //let $ldate = new DateTime('now');
    let timer = function(date) {
        let timer = Math.round(new Date(date).getTime() / 1000) - Math.round(new Date().getTime() / 1000);
        let minutes, seconds;
        setInterval(function() {
            if (--timer < 0) {
                timer = 0;
            }
            days = parseInt(timer / 60 / 60 / 24, 10);
            hours = parseInt((timer / 60 / 60) % 24, 10);
            minutes = parseInt((timer / 60) % 60, 10);
            seconds = parseInt(timer % 60, 10);

            days = days < 10 ? "0" + days : days;
            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.getElementById('cd-days').innerHTML = days;
            document.getElementById('cd-hours').innerHTML = hours;
            document.getElementById('cd-minutes').innerHTML = minutes;
            document.getElementById('cd-seconds').innerHTML = seconds;
        }, 1000);
    }


    //using the function
    const today = new Date()
    const tomorrow = new Date('{{$nft->limit_date}}')
    timer(tomorrow);
</script>

<style lang="scss">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    @import url(https://fonts.googleapis.com/css?family=Montserrat:900|Raleway:400,400i,700,700i);
    
    @media(max-width: 500px) {
        .container .content {
            flex-direction: column;
        }
        
    }
    
    .adriclas {
        display: flex;
        margin: 10px 0;
    }

    .clase2 {
        display: flex;
        background-color: whitesmoke!important;
        color: black ! important;
        padding: 10px 15px!important;
        border-radius: 20px;
        width: fit-content;
    }
    /*  */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .textDays {
        color: red;
        font-size: 28px;
    }

    .textG {
        color: #808080;
        padding: 12px;
        font-size: 22px;
    }

    /* List */
    ul.timeline li {
        position: relative;
        height: 3em;
        color: #888;
    }

    .timeline {
        display: flex;
        flex-direction: column;
    }

    ul.timeline li:before {
        content: "";
        /* display: inline-block; */
        height: 3em;
        width: 1px;
        display: flex;
        background: #aaaa;
        margin: 0;
        padding: 0;
        /* position: absolute; */
        left: -11px;
        top: -0.4em;
        z-index: -1;
    }

    /* .badge-primary {
        /* color: #fff; 
        color: black ! important;
        padding: 10px 10px!important;
        background-color: whitesmoke!important;
        display: flex;
    } */

    /*  */

    .bootstrap-input {
        width: 400px;
    }

    .nombre {
        margin: auto;
        display: flex;
        justify-content: center;
        border-bottom: 1px solid black;
        margin-bottom: 20px;
        margin-top: 30px;
        width: 50%;
        padding: 10px;
        text-align: center;
        font-size: 20px;
        font-weight: bolder;
    }

    .textB {
        padding: 12px;
        font-size: 22px;
        font-weight: bolder;
    }

    .textH {
        padding: 12px;
        font-size: 35px;
        font-weight: bolder;
    }

    .listado {

        flex-wrap: wrap;
        display: flex;
        margin: 0 auto;
        row-gap: 10px;
        column-gap: 10px;
        padding: 10px 0;

        width: 80%;
    }

    .center {
        margin: auto;
        width: 90%;
        padding: 10px;
        margin-bottom: 40px;
        margin-top: 40px;
        font-size: 18px;
    }

    .container {
        width: 85%;
        background: #fff;
        border-radius: 6px;
        padding: 20px 60px 30px 40px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .container solid {
        border-style: solid;
    }

    .container .content {
        display: flex;
        margin-bottom: 10px;
        align-items: center;
        justify-content: space-between;
        
    }

    .container .content .left-side {
        width: 50%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
        margin-left: 50px;
        margin-right: 0px;
        position: relative;
    }

    /* .content .left-side::before {
        content: '';
        position: absolute;
        height: 70%;
        width: 2px;
        margin-right: 50px;
        right: -15px;
        top: 50%;
        transform: translateY(-50%);
        background: #afafb6;
    } */

    .content .left-side .details {
        margin: 14px;
        text-align: center;
    }

    .content .left-side .details i {
        font-size: 30px;
        color: #3e2093;
        margin-bottom: 10px;
    }

    .content .left-side .details .topic {
        font-size: 18px;
        font-weight: 500;
    }

    .content .left-side .details .text-one,
    .content .left-side .details .text-two {
        font-size: 14px;
        color: #afafb6;
    }

    .container .content .right-side {
        width: 80%;
        margin-left: 50px;
    }

    .content .right-side .topic-text {
        font-size: 23px;
        font-weight: 600;
        color: #3e2093;
    }

    .content .right-side .topic {
        font-size: 18px;
        font-weight: 500;
    }

    .content .right-side .text-one,
    .content .right-side .text-two {
        font-size: 14px;
        color: #afafb6;
    }
</style>