@extends('layouts')

@section('content')
<h1> Artist information </h1>
<p><strong>Name:</strong> {{ $artist->name }}</p>
<p><strong>Balance:</strong> {{ $artist->balance }}</p>
<p><strong>Volume Sold:</strong> {{ $artist->volume_sold }}</p>
<p><strong>Description:</strong> {{ $artist->description }}</p>
<p><strong>Number of collections:</strong> {{ $artist->collections->count() }}</p>
<div class="img-container" style="display: flex; align-items:flex-start; margin-bottom:20px">
    <p><strong style="margin-right: 20px">Image:</strong></p>
    <img src="../../images/{{ $artist->img_url }}" alt="" width="200px" style="border: 1px black solid">
</div>

@if($artist->collections->count() > 0)
    <p><strong>Collections:</strong></p>
    <div class="listado">
        @foreach($artist->collections as $collection)
            <a href='/api/collections/{{ $collection->id }}'>
                <img src="/images/{{ $collection->img_url}}" width="150" alt="">
            </a>
        @endforeach

    </div>
@else
    <p><strong>This artist has not got Collections</strong></p>
@endif
<p><a href="/api/artists">Go back</a></p>
@endsection

<style lang="css">

    .listado {
        flex-wrap: wrap;
        display: flex;
        margin: 0 auto;
        row-gap: 10px;
        column-gap: 10px;
        padding: 10px 0;
        width: 80%;
    }

</style>