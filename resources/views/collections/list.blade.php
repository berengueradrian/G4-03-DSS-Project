@extends('layouts')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List of collections</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Create collection</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collections as $collection)
                <tr>
                    <td><a href={{ route('collection.getOne', ['collection' => $collection->id]) }}>{{ $collection->name }}</a></td>
                    <td>{{ $collection->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $collections->links() }}
    </div>
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('collections.create')
    </div>
</div>

@endsection