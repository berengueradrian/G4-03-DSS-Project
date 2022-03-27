@extends('layouts')

@section('title', 'User details')

@section('content')

<p> {{ $user->name }}</p>

<h1>{{ $user->name }}</h1>
<p><strong>email:</strong> {{ $user->email }}</p>
<p>{{ $user->email }}</p>
<p><a href="/api/users">Go back</a></p>
@endsection