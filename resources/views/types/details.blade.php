@extends('layouts')

@section('content')
<h3 style="padding-bottom: 20px"><strong>Type information</strong></h3>
<p><strong>Name:</strong> {{ $type->name }}</p>
<p><strong>Description:</strong> {{ $type->description }}</p>
<p><a href={{ route('type.getAll') }}>Go back</a></p>
@endsection