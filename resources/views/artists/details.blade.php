@extends('layouts')

@section('content')
<h1> Artist information </h1>
<p><strong>Name:</strong> {{ $artist->name }}</p>
<p><strong>Balance:</strong> {{ $artist->balance }}</p>
<p><strong>Volume Sold:</strong> {{ $artist->volume_sold }}</p>
<p><strong>Description:</strong> {{ $artist->description }}</p>

<p><a href="/api/artists">Go back</a></p>
@endsection