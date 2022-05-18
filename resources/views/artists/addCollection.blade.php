@extends('layouts')

@section('content')
<h1>CREATE YOUR COLLECTION</h1>
<div class="add-collection">
    <div class="portada-artist">
        <div class="portada">
        <div class="foticos">
        <text> Upload your photo so you can change it!</text>
        <!--THIS IS FOR UPLOADING PHOTO TO PUBLIC FOLDER -->
        <form method="post" action="{{ route('images.store') }}" enctype="multipart/form-data">
            @csrf
    
            <input type="file" style="width:400px; margin-bottom:10px" name="img_url" class="custom-file-upload" id="img_url">
            <button type="submit" class="btn btn-success">Upload new photo</button>
        </form>
        </div>
        <br>
        <div class="foticos">
        <text> Select your uploaded photo to show it!</text>
        <!--THIS IS FOR UPDATING EXISTING PHOTO
        con enctype="multipart/form-data" no detecta como campo rellenado que random!!! -->
        <form action="{{ route('user.update') }}" method="POST" class="needs-validation create-user-container">
            @csrf
            @method('PUT')
        
            <input type="hidden" class="form-control" name="id_update" value="{{ Auth::guard('custom')->user()->id }}" placeholder="Identifier of the user" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
            <input type="file" style="width:400px; margin-bottom:10px" name="img_url_update" class="custom-file-upload" id="img_url_update">
            <button type="submit" class="btn btn-secondary">Select uploaded photo</button>
        </form>
        </div>
        </div>
        <div class="col-artist">
            <h2>
                Artist
            </h2>
            <div class="artist-pic">
            <a href="/artists/{{$artist->id}}">
                <img src="../../images/{{ $artist->id }}" alt="NOP" width="100%" style="border: 1px black solid">
            </a>
            </div>
            <div class="artist-name">
                {{$artist->name}}
            </div>
        </div>
    </div>
    
        
   
    <div class="name-input">
        <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
    </div>

    <div class="description-input">
        <textarea placeholder="Description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

    <div class="create-col-btn">
        <button type="button" class="btn btn-outline-dark btn-lg">&nbsp;Create &nbsp;</button>
    </div>

    
</div>
<style lang="scss">


    h1{
        text-align: center;
    }
    .portada-artist{
        margin-top: 40px;
        display: flex;
        width: 70%;
        justify-content: space-between;

    }
    .col-artist{
        margin-left: 10%;
    }
    .add-collection{
        display: flex;
        flex-flow: column;
        margin-left: 120px;
        margin-right: 120px;
        align-items: center;
    }
   

   
    .name-input{
        margin-top: 25px;
        width: 70%;
    }
    .description-input{
        margin-top: 16px;
        width: 70%;
    }

    .create-col-btn{
        margin-top: 25px;
        margin-bottom: 40px;
    }

    
    

</style>
@endsection