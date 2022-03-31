@extends('layouts')

@section('content')
<h1>Artists</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($artists as $artist)
        <tr>
            <td><a href="/api/artists/{{$artist->id}}">{{ $artist->name }}</a></td>
            <td>{{ $artist->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $artists->links() }}

@endsection