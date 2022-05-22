<!DOCTYPE html>
<html>
@extends('layouts')

@section('content')
<h1>CREATE YOUR COLLECTION</h1>
<div class="add-collection">
    <div class="portada-artist">
        <div class="foticos" >
            <text> Upload your collection cover!</text>
            <!--THIS IS FOR UPLOADING PHOTO TO PUBLIC FOLDER -->
            <form method="post" action="{{ route('images.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="file" style=" margin-bottom:10px" name="img_url" class="custom-file-upload" id="img_url">
                <button type="submit" class="btn btn-success">Upload new photo</button>
            </form>
        </div>
        <br>
        
    </div>

    
    
    
        
   <form action="{{ route('collection.add', ['artist' => $artist->id]) }}" 
        method="POST" class="needs-validation create-collection-container" action="/profile/artists">
        @csrf
        @method('POST')
        
        <div class="choose-file">
        <text> Select your collection cover!</text>
            <input type="file"  name="img_url" class="custom-file-upload" id="img_url">
        </div>
        @if ($errors->has('img_url'))
        @foreach ($errors->get('img_url') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
        @endif
      
        <div class="name-input">
            <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                aria-label="Name" aria-describedby="basic-addon1">
        </div>
        @if ($errors->has("name"))
        @foreach ($errors->get('name') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
        @endif

        <div class="description-input">
            <textarea type="text" placeholder="Description (50 max.)" class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
        @if ($errors->has('description'))
        @foreach ($errors->get('description') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
        @endif

        <div class="create-col-btn">
            <button type="sumbit" class="btn btn-outline-dark btn-lg">&nbsp;Create &nbsp;</button>
             
        </div>

    </form>

    <a href="/profile/artists" >
            <button  class="btn btn-light btn-sm">&nbsp;Back &nbsp;</button>
    </a> 

    
</div>

<style lang="scss">




    h1{
        text-align: center;
    }
    .portada-artist{
        margin-top: 40px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        align-items: center;
        flex-flow: column;
    }



    
    .col-artist{
        margin-left: 10%;
    }
    .add-collection{
        display: flex;
        flex-flow: column;
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

    .create-collection-container{
        display: flex;
        flex-flow: column;
        align-items: center;
        width: 100%;
    }

    
    

</style>
@endsection
</html>