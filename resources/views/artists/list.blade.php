@extends('layouts')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List of artists</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Create artist</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update artist</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false">Delete artist</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="sorts">
            <form method="GET" action="{{url('/artists/sortByName')}}">
                @method('GET')
                @csrf
                <div class="input-group mb-3">
                    <select name="sortByName" class="custom-select" id="inputGroupSelect04">
                        <option value="-1">Sort by name...</option>
                        <option value="0">Descendent</option>
                        <option value="1">Ascendent</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Sort</button>
                    </div>
                </div>
            </form>
            
            <form method="GET" action="{{url('/artists/sortByBalance')}}">
                @method('GET')
                @csrf
                <div class="input-group mb-3">
                    <select name="sortByBalance" class="custom-select" id="inputGroupSelect04">
                        <option value="-1">Sort by balance...</option>
                        <option value="0">Descendent</option>
                        <option value="1">Ascendent</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Sort</button>
                    </div>
                </div>
            </form>
            
            <form method="GET" action="{{url('/artists/sortByVolume')}}">
                @method('GET')
                @csrf
                <div class="input-group mb-3">
                    <select name="sortByVolume" class="custom-select" id="inputGroupSelect04">
                        <option value="-1">Sort by volume sold...</option>
                        <option value="0">Descendent</option>
                        <option value="1">Ascendent</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Sort</button>
                    </div>
                </div>
            </form>
        </div>  
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Volume Sold</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artists as $artist)
                <tr>
                    <td>{{ $artist->id }}</td>
                    <td><a href="/api/artists/{{$artist->id}}">{{ $artist->name }}</a></td>
                    <td>{{ $artist->balance }}</td>
                    <td>{{ $artist->volume_sold }}</td>
                    <td>{{ $artist->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $artists->appends($_GET)->links() }}
        @if ($errors->has('iddelete'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The artist has not been deleted</div>
        @endif
        @if ($errors->has('id_update') || $errors->has('balance_update') || $errors->has('volume_sold_update')|| $errors->has('name_update') || $errors->has('img_url_update'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The artist has not been updated</div>
        @endif
        @if ($errors->has('name')||$errors->has('description')||$errors->has('balance')||$errors->has('img_url'))
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The artist has not been created</div>
        @endif
        @if ($withCollection)
            <div class="invalid-tooltip mb-3 mt-3">ERROR: The artist has not been deleted</div>
        @endif
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('artists.create')
    </div>
    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
        @include('artists.update')
    </div>
    <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
        @include('artists.delete')
    </div>
</div>



@endsection

<style>
    .sorts{
        display: flex;
        flex-flow: row nowrap;
    }
    form{
        width: 300px !important;
        background-color: transparent !important;
        border: none !important;
        padding: 0px !important;
        margin-top: 20px !important;
        margin-bottom: 0px !important;
        margin-right: 20px;
    }
    form button{
      margin-bottom: 0px !important;
    }
</style>