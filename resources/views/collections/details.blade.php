@extends('layouts')

@section('content')
<h3 style="padding-bottom: 20px"><strong>Collection information</strong></h3>
<p><strong>Name:</strong> {{ $collection->name }}</p>
<p><strong>Description:</strong> {{ $collection->description }}</p>
<p><strong>Number of NFTs:</strong> {{ $collection->nfts->count() }}</p>
<p><strong>Artist:</strong> {{ $collection->artist->name }}</p>
<div class="img-container" style="display: flex; align-items:flex-start; margin-bottom:20px">
    <p><strong style="margin-right: 20px">Image:</strong></p>
    <img src="../../images/{{ $collection->img_url }}" alt="" width="200px" style="border: 1px black solid">
</div>
<a href={{ route('collection.getAll') }}>Go back</a></p>

@endsection