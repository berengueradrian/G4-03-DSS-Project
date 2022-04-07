@extends('layouts')

@section('content')
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
    </div>
</form>

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