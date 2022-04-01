@extends('layouts')

@section('content')
    <h3><strong>List of types</strong></h3>

    <form method="GET" action="{{url('/types/sortByName')}}">
    @method('GET')
    @csrf
    <div class="input-group mb-3">
        <select name="sortByName" class="custom-select" id="inputGroupSelect04">
          <option value="-1">Sort by name...</option>
          <option value="0">Descendent</option>
          <option value="1">Ascendent</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

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