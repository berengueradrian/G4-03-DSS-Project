@extends('layouts')

@section('content')
<h3 style="padding-bottom: 20px"><strong>Collection information</strong></h3>
<p><strong>Name:</strong> {{ $collection->name }}</p>
<p><strong>Description:</strong> {{ $collection->description }}</p>
<p><strong>Artist:</strong> {{ $collection->artist_id }}</p>
<p><a href={{ route('collection.getAll') }}>Go back</a></p>
@endsection