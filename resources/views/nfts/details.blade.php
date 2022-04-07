@extends('layouts')

@section('content')
<h1> NFT information </h1>
<p><strong>Name:</strong> {{ $nft->name }}</p>
<p><strong>Base Price:</strong> {{ $nft->base_price }}</p>
<p><strong>Limit date:</strong> {{ $nft->limit_date }}</p>
<p><strong>Available?:</strong> {{ $nft->available }}</p>
<p><strong>Actual Price:</strong> {{ $nft->actual_price }}</p>
<p><strong>Collection ID:</strong> {{ $nft->collection->name }}</p>
@if($nft->user_id != null)
<p><strong>User ID:</strong> {{ $nft->user->name }}</p>
@else
<p><strong>User ID:</strong></p>
@endif
<p><strong>Type ID:</strong> {{ $nft->type->name }}</p>
<div class="img-container" style="display: flex; align-items:flex-start; margin-bottom:20px">
    <p><strong style="margin-right: 20px">Image:</strong></p>
    <img src="../../images/{{ $nft->img_url }}" alt="" width="200px" style="border: 1px black solid">
</div>

<p><a href="/api/nfts">Go back</a></p>
@endsection