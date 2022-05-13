@extends('layouts')

@section('content')
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

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="sorts">
            <form method="GET" action="{{url('/users/sortByBalance')}}" class="form-control">
                @method('GET')
                @csrf
                <div class="input-group mb-3">
                    <select name="sortByBalance" class="custom-select" id="inputGroupSelect04">
                        <option value="-1">Sort by balance...</option>
                        <option value="0">Lowest first</option>
                        <option value="1">Highest first</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Sort</button>
                    </div>
                </div>
            </form>
            <form method="GET" action="{{url('/users/sortByName')}}" class="form-control">
                @method('GET')
                @csrf
                <div class="input-group mb-3">
                    <select name="sortByName" class="custom-select" id="inputGroupSelect04">
                        <option value="-1">Sort by name...</option>
                        <option value="0">A first</option>
                        <option value="1">Z first</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Sort</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Delete option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="/api/users/{{$user->id}}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action=" {{ route('user.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" class="form-control" name="iddelete" value="{{$user->id}}" id="iddelete">
                            @if($user->id != \Auth::user()->id)

                            <!-- We supose there will be only one admin. And only admins can see this -->
                            <button type="submit" onclick="return confirm('Confirm your operation delete')" class="btn btn-danger btn-sm">Delete user</button>

                            @else
                            -- Can not delete admin profile --
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->appends($_GET)->links() }} <!-- This is done to prevent pagination swap page to 'forget' about the data filtered or ordered -->

        @if ($errors->has('iddelete'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The user has not been deleted</div>
        @endif
        @if ($errors->has('id_update') || $errors->has('name_update') || $errors->has('email_update') || $errors->has('img_url_update') || $errors->has('password_update') ||$errors->has('balance_update'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The user has not been updated</div>
        @endif
        @if ($errors->has('name')||$errors->has('email')||$errors->has('balance')||$errors->has('password')||$errors->has('img_url')||$errors->has('balance'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The user has not been created</div>
        @endif
    </div>

    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('users.create')
    </div>
    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
        @include('users.update')
    </div>
    <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
        @include('users.delete')
    </div>
</div>

@endsection

<style>
    .sorts {
        display: flex;
        flex-flow: row nowrap;
    }

    .table td,
    .table th {
        padding: 0.75rem;
        vertical-align: initial !important;
        border-top: 1px solid #dee2e6;
    }

    form {
        width: 300px !important;
        background-color: transparent !important;
        border: none !important;
        padding: 0px !important;
        margin-top: 20px !important;
        margin-bottom: 10px !important;
        margin-right: 20px;
    }

    form button {
        margin-bottom: 0px !important;
    }
</style>