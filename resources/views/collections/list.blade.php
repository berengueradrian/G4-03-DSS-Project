@extends('layouts')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List of collections</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Create collection</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update collection</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false">Delete collection</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form method="GET" action="{{url('/collections/sortByName')}}" class="form-control">
            @method('GET')
            @csrf
            <div class="input-group mb-3">
                <select name="sortByName" class="custom-select">
                    <option value="-1">Sort by name...</option>
                    <option value="0">Descendent</option>
                    <option value="1">Ascendent</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Sort</button>
                </div>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Delete option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collections as $collection)
                <tr>
                    <td>{{ $collection->id }}</td>
                    <td><a href={{ route('collection.getOne', ['collection' => $collection->id]) }}>{{ $collection->name }}</a></td>
                    <td>{{ $collection->description }}</td>
                    <td>
                        <form action=" {{ route('collection.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" class="form-control" name="iddelete" value="{{$collection->id}}" id="iddelete">
                            <button type="submit" class="btn btn-danger btn-sm">Delete collection</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $collections->appends($_GET)->links() }}
        @if ($errors->has('iddelete'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The collection has not been deleted</div>
        @endif
        @if ($errors->has('id') || $errors->has('artist_id_update') || $errors->has('name_update')|| $errors->has('img_url_update') || $errors->has('description_update'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The collection has not been updated</div>
        @endif
        @if ($errors->has('name')||$errors->has('description')||$errors->has('artist_id')||$errors->has('img_url'))
        <div class="invalid-tooltip mb-3 mt-3">ERROR: The collection has not been created</div>
        @endif
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('collections.create')
    </div>
    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
        @include('collections.update')
    </div>
    <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
        @include('collections.delete')
    </div>
</div>

@endsection

<style lang="scss">
    form {
        width: 300px !important;
        background-color: transparent !important;
        border: none !important;
        padding: 0px !important;
        margin-top: 20px !important;
        margin-bottom: 10px !important;
    }

    .table td,
    .table th {
        padding: 0.75rem;
        vertical-align: initial !important;
        border-top: 1px solid #dee2e6;
    }
</style>