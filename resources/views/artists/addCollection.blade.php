<!DOCTYPE html>
<html>
@extends('layouts')

@section('content')
<h1>CREATE YOUR COLLECTION</h1>
<div class="add-collection">
    <div class="portada-artist">
        <div class="portada">
        <div class="foticos">
            <text> Upload your collection cover!</text>
            <!--THIS IS FOR UPLOADING PHOTO TO PUBLIC FOLDER -->
            <form method="post" action="{{ route('imagesCollection.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="file" onchange="selectedFile(this)" style="width:400px; margin-bottom:10px" name="img_url" class="custom-file-upload" id="img_url">
                <button type="submit" class="btn btn-success">Upload new photo</button>
            </form>

        <input type="text" id="img_url" >
        </div>
        <br>
        
    </div>
    </div>
    
        
    <input type="text" name="img_url" id="img_url" >
   <form action="{{ route('collection.add', ['artist' => $artist->id]) }}" 
        method="POST" class="needs-validation create-collection-container">
        @csrf
        @method('POST')
        <input type="text" name="img_url" id="img_url" >
      
        <div class="name-input">
            <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                aria-label="Name" aria-describedby="basic-addon1">
        </div>

        <div class="description-input">
            <textarea placeholder="Description" class="form-control" name="description" id="description"
                id="exampleFormControlTextarea1" rows="3">
            </textarea>
        </div>

        <div class="create-col-btn">
            <button type="sumbit" class="btn btn-outline-dark btn-lg">&nbsp;Create &nbsp;</button>
        </div>
    </form>

    
</div>
<script>
    function selectedFile(fileInput){
        /* var filename = fileInput.value.replace(/^.*[\\\/]/, '');
        var img='../public/images/collections/' + filename; */
        alert("CAMBIO");
        document.getElementById("img_url").value="HOLA";
        alert("CAMBIO");
    }
</script>
<style lang="scss">




    h1{
        text-align: center;
    }
    .portada-artist{
        margin-top: 40px;
        display: flex;
        width: 70%;
        justify-content: center;

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

    .create-collection-container{
        display: flex;
        flex-flow: column;
        align-items: center;
    }

    
    

</style>
@endsection
</html>