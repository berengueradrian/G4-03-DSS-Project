@extends('layouts')

@section('content')
<h1> NFT information </h1>
<p><strong>Name:</strong> {{ $nft->name }}</p>
<p><strong>Base Price:</strong> {{ $nft->base_price }}</p>
<p><strong>Limit date:</strong> {{ $nft->limit_date }}</p>
<p><strong>Available?:</strong> {{ $nft->available }}</p>
<p><strong>Actual Price:</strong> {{ $nft->actual_price }}</p>
<p><strong>Collection ID:</strong> {{ $nft->collection_id }}</p>
<p><strong>Type ID:</strong> {{ $nft->type_id }}</p>

<p><a href="/api/nfts">Go back</a></p>
@endsection