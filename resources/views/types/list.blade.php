@extends('layouts')

@section('content')
    <h3><strong>List of types</strong></h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
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
    {{ $types->links() }}
@endsection