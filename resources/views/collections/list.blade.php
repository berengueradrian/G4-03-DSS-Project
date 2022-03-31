@extends('layouts')

@section('content')
    <h3><strong>List of collections</strong></h3>
    <table class="table table-striped">
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
@endsection