@extends('layouts')

@section('content')
<h1> User information </h1>
<p><strong>Name:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Balance:</strong> {{ $user->balance }}</p>
<div class="img-container" style="display: flex; align-items:flex-start; margin-bottom:20px">
    <p><strong style="margin-right: 20px">Image:</strong></p>
    <img src="../../images/{{ $user->img_url }}" alt="" width="200px" style="border: 1px black solid;">
</div>
<p><a href="/api/users">Go back</a></p>
@endsection