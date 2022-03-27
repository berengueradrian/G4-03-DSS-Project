@extends('layouts')

@section('content')
<h1> User information </h1>
<p><strong>name:</strong> {{ $user->name }}</p>
<p><strong>email:</strong> {{ $user->email }}</p>
<p><a href="/api/users">Go back</a></p>
@endsection