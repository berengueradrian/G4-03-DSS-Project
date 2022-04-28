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

            @if($nft->type_id == 5)
                <div class="textB">
                Bid finishes in:
                </div>
                <div>
                    <span id="cd-days">00</span> days 
                    <span id="cd-hours">00</span> hours
                    <span id="cd-minutes">00</span> minutes
                    <span id="cd-seconds">00</span> seconds
                </div>
            @endif

            <div class="textB">
                Actual Price: {{$nft->actual_price}} SCAN
            </div>
            

            @auth
            @if($nft->available)
                @if($nft->type_id == 5)
                <!-- Formulario bid -->
                <form action="{{ route('nft.bid', ['nft' => $nft->id]) }}" method="POST" class="needs-validation create-bid-container">
                    @csrf
                    @method('POST')
                    <div class="input-group mb-3 bootstrap-input">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Amount</span>
                        </div>
                        <input type="number" class="form-control" name="bid_amount" placeholder="$SCAN" aria-label="Username" aria-describedby="basic-addon3" id="bid_amount">
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
                @else
                <!-- Formulario purchase -->
                <form action="{{ route('nft.purchase', ['nft' => $nft->id]) }}" method="POST" class="needs-validation create-bid-container">
                    @csrf
                    @method('POST')
                    <div class="input-group mb-3 bootstrap-input">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Amount</span>
                        </div>
                        <input type="number" class="form-control" name="purchase_amount" placeholder="$SCAN" aria-label="Username" aria-describedby="basic-addon3" id="purchase_amount">
                    </div>
                    @if ($errors->has('purchase_amount'))
                        @foreach ($errors->get('name') as $error)
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
                        @foreach ($errors->get('name') as $error)
                            <div class="invalid-tooltip mb-3">{{ $error }}</div>
                        @endforeach
                    @endif
                    <button type="submit" class="btn btn-primary">Purchase</button>

                </form>
                @endif
            @else
                <div class="text-one">
                    This NFT is not available yet.
                </div>
            @endif
            @endauth

        </div>
    </div>

    <div class="nombre">NFT CHARACTERISTICS</div>
    <div class="listado">
        <ul class="timeline">
            @if($nft->type_id == 5)
            <li><span class="badge badge-primary badge-pill font-weight-normal">
                Base Price: {{$nft->base_price}} SCAN
                </span>
            </li>
            @endif
            <li><span class="badge badge-primary badge-pill font-weight-normal">
                Collection: {{$nft->collectionName->name}}
                </span>
            </li>
            <li> <span class="badge badge-primary badge-pill font-weight-normal">
                Type: {{$nft->typeName->name}}
                </span>
            </li>
            <li><span class="badge badge-primary badge-pill font-weight-normal">
                Type description: {{$nft->typeName->description}}
                </span>
            </li>
            <li><span class="badge badge-primary badge-pill font-weight-normal">
                Artist: {{$nft->collectionName->artistName->name}}
                </span>
            </li>
            <li><span class="badge badge-primary badge-pill font-weight-normal">
                Artist description: {{$nft->collectionName->artistName->description}}
                </span>
            </li>
        </ul>
        
        <!-- @for($i = 0; $i < 5 && $i < $nft->bids->count(); $i++)
            <div class="text-one">
                {{$nft->bids[$i]->pivot}}
            </div>
        @endfor -->
    </div>


</div>
@endsection

<script> 

    let timer = function (date) {
    let timer = Math.round(new Date(date).getTime()/1000) - Math.round(new Date().getTime()/1000);
		let minutes, seconds;
		setInterval(function () {
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

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    /* List */
    ul.timeline li
    {
        position: relative;
        height: 3em;
        color: #888;
    }

    ul.timeline li:before
    {
        content: "";
        display: inline-block;
        height: 3em;
        width: 1px;
        background: #aaaa;
        margin: 0;
        padding: 0;
        position: absolute;
        left: -11px;
        top: -0.4em;
        z-index: -1;
    }

    ul.timeline:before
    {
        content: "●";
        display: inline-block;
        margin: 0;
        padding: 0;
        position: relative;
        left: -1em;
        top: 0.1em;
        color: #aaa;
    }

    ul.timeline:after
    {
        content: "●";
        display: inline-block;
        margin: 0;
        padding: 0;
        position: relative;
        left: -1em;
        top: -1em;
        color: #aaa;
    }
    /*  */

    .bootstrap-input{
        width: 400px;
    }

    .nombre {
        margin: auto;
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

    .content .left-side::before {
        content: '';
        position: absolute;
        height: 70%;
        width: 2px;
        margin-right: 50px;
        right: -15px;
        top: 50%;
        transform: translateY(-50%);
        background: #afafb6;
    }

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