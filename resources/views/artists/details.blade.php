@extends('layouts')

@section('content')
<h1> Artist information </h1>
<p><strong>Name:</strong> {{ $artist->name }}</p>
<p><strong>Balance:</strong> {{ $artist->balance }}</p>
<p><strong>Volume Sold:</strong> {{ $artist->volume_sold }}</p>
<p><strong>Description:</strong> {{ $artist->description }}</p>
<p><strong>Number of collections:</strong> {{ $artist->collections->count() }}</p>
<div class="img-container" style="display: flex; align-items:flex-start; margin-bottom:20px">
    <p><strong style="margin-right: 20px">Image:</strong></p>
    <img src="../../images/{{ $artist->img_url }}" alt="" width="200px" style="border: 1px black solid">
</div>

<p><a href="/api/artists">Go back</a></p>
@endsection