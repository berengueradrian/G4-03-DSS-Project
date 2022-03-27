@extends('layouts')

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
            <td><a href="/api/users/{{$user->id}}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}

@endsection