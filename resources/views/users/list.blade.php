@extends('layouts')

@section('content')
<h1>Users</h1>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List of users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Create user</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update user</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false">Delete user</a>
    </li>
</ul>

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

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="/api/users/{{$user->id}}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->balance }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->appends($_GET)->links() }} <!-- This is done to prevent pagination swap page to 'forget' about the data filtered or ordered -->

        @if ($errors->has('iddelete'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The user has not been deleted</div>
        @endif
        @if ($errors->has('id') || $errors->has('user_id_update'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The user has not been updated</div>
        @endif
        @if ($errors->has('name')||$errors->has('description')||$errors->has('user_id'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The user has not been created</div>
        @endif
    </div>

    //TODO: NO ES UPDATE EN TODO CAMBIAR CUANDO ESTE HECHO
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('users.update')
    </div>
    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
        @include('users.update')
    </div>
    <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
        @include('users.update')
    </div>
</div>


@endsection