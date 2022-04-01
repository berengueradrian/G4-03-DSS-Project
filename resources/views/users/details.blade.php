@extends('layouts')

@section('content')
<h1> User information </h1>
<p><strong>Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Balance:</strong> {{ $user->balance }}</p>
<p><a href="/api/users">Go back</a></p>
@endsection