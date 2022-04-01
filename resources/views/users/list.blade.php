@extends('layouts')

@section('content')
<h1>Users</h1>

<form method="GET" action="{{url('/users/sortByBalance')}}" class="form-control">
    @method('GET')
    @csrf
    <select name="sortByBalance">
        <option value="-1"> -- Sort by balance -- </option>
        <option value="0">Lowest first</option>
        <option value="1">Highest first</option>
    </select>
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<form method="GET" action="{{url('/users/sortByName')}}" class="form-control">
    @method('GET')
    @csrf
    <select name="sortByName">
        <option value="-1"> -- Sort by name -- </option>
        <option value="0">A first</option>
        <option value="1">Z first</option>
    </select>
    <button type="submit" class="btn btn-primary">Search</button>
</form>


<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td><a href="/api/users/{{$user->id}}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->balance }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->appends($_GET)->links() }} <!-- This is done to prevent pagination swap page to 'forget' about the data filtered or ordered -->

@endsection