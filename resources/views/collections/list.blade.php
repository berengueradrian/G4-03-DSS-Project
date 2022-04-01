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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collections as $collection)
                <tr>
                    <td>{{ $collection->id }}</td>
                    <td><a href={{ route('collection.getOne', ['collection' => $collection->id]) }}>{{ $collection->name }}</a></td>
                    <td>{{ $collection->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $collections->links() }}
        @if ($errors->has('iddelete'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The collection has not been deleted</div>
        @endif
        @if ($errors->has('id') || $errors->has('artist_id_update'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The collection has not been updated</div>
        @endif
        @if ($errors->has('name')||$errors->has('description')||$errors->has('artist_id'))
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