@extends('layouts')

@section('title', 'User list')

@section('content')
<h1>Users</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->name }}</th>
            <td><a href="{{ action('UserController@getAll', $user->id) }}">{{ $user->name }}</a></td>
            <td>{{ $user->price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection