@extends('layouts')

@section('content')
<h1> User information </h1>
<p><strong>name:</strong> {{ $artist->name }}</p>
<p><strong>description:</strong> {{ $artist->description }}</p>
<p><a href="/api/artists">Go back</a></p>
@endsection