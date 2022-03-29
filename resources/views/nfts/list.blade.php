@extends('layouts')

@section('content')
<h1>NFTS</h1>


<form method="GET" action="{{url('/nfts/available')}}" class="form-control">
    @method('GET')
    @csrf
    <select name="availableFilter">
        <option value="0">All</option>
        <option value="1">Available</option>
        <option value="2">Not available</option>
    </select>
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<form method="GET" action="{{url('/nfts/priceFilter')}}" class="form-control">
    @method('GET')
    @csrf
    <input name="price" placeholder="Actual price upper than...">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Base Price</th>
            <th scope="col">Limit Date</th>
            <th scope="col">Available?</th>
            <th scope="col">Actual Price</th>
            <th scope="col">Collection ID</th>
            <th scope="col">Type</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($nfts as $nft)
        <tr>
            <td><a href="/api/nfts/{{$nft->id}}">{{ $nft->name }}</a></td>
            <td>{{ $nft->base_price }}</td>
            <td>{{ $nft->limit_date }}</td>
            <td>{{ $nft->available }}</td>
            <td>{{ $nft->actual_price }}</td>
            <td>{{ $nft->collection_id }}</td>
            <td>{{ $nft->type->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $nfts->links() }}

@endsection