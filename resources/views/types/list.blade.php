@extends('layouts')

@section('content')
<<<<<<< HEAD

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List of types</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Create type</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update type</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false">Delete type</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="sorts">
            <form method="GET" action="{{url('/types/sortByName')}}">
                @method('GET')
                @csrf
                <div class="input-group mb-3">
                    <select name="sortByExclusivity" class="custom-select">
                        <option value="-1">Sort by name...</option>
                        <option value="0">Descendent</option>
                        <option value="1">Ascendent</option>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td><a href={{ route('type.getOne', ['type' => $type->id]) }}>{{ $type->name }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $types->appends($_GET)->links() }}
        @if ($errors->has('iddelete'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The type has not been deleted</div>
        @endif
        @if ($errors->has('id_update'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The type has not been updated</div>
        @endif
        @if ($errors->has('name')||$errors->has('description'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The type has not been created</div>
        @endif
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('types.create')
    </div>
    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
        @include('types.update')
=======
<h3><strong>List of types</strong></h3>

<form method="GET" action="{{url('/types/sortByExclusivity')}}">
    @method('GET')
    @csrf
    <div class="input-group mb-3">
        <select name="sortByExclusivity" class="custom-select" id="inputGroupSelect04">
            <option value="-1">Sort by exclusivity...</option>
            <option value="0">Less Exclusive</option>
            <option value="1">Most Exclusive</option>
        </select>
        <button type="submit" class="btn btn-primary">Sort</button>
>>>>>>> develop
    </div>
    <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
        @include('types.delete')
    </div>
</div>

@endsection

<<<<<<< HEAD
<style>
    form{
        width: 300px !important;
        background-color: transparent !important;
        border: none !important;
        padding: 0px !important;
        margin-top: 20px !important;
        margin-bottom: 10px !important;
    }
    .sorts{
        display: flex;
        flex-flow: row wrap;
    }
</style>
=======
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
        <tr>
            <td><a href={{ route('type.getOne', ['type' => $type->id]) }}>{{ $type->name }}</a></td>
            <td>{{ $type->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $types->appends($_GET)->links() }} <!-- This is done to prevent pagination swap page to 'forget' about the data filtered or ordered -->
@endsection
>>>>>>> develop
