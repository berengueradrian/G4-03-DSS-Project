@extends('layouts')

@section('content')
<h1>EDIT YOUR COLLECTION</h1>
<div class="edit-collection">
    <div class="portada-artist">
        <div class="portada" style="display:contents;">
        <div class="foticos">
            <text> Upload your collection cover if you want to change it!</text>
            <!--THIS IS FOR UPLOADING PHOTO TO PUBLIC FOLDER -->
            <form method="post" action="{{ route('images.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="file" style=" margin-bottom:10px" name="img_url" class="custom-file-upload" id="img_url">
                <button type="submit" class="btn btn-success">Upload new photo</button>
            </form>
        </div>
        <br>
        </div>
        
    </div>
  
    <form action="{{ route('collection.edit') }}" 
        method="POST" class="needs-validation update-collection-container" style="display:contents">
        @csrf
        @method('PUT')

        <div class="choose-file" style="display:flex; flex-flow:column">
        <text> Select your collection cover!</text>
            <input type="file" name="img_url_update" onkeyup='saveValue(this)' class="custom-file-upload" id="img_url_update">
        </div>

        <input style="display:none" type="number" class="form-control" name="id" value="{{ $collection->id}}" placeholder="Identifier of the collection" aria-label="id" aria-describedby="basic-addon1" id="id">
    
    <div class="name-input">
        <input type="text" class="form-control" onkeyup='saveValue(this)' value="{{ $collection->name }}" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" name="name_update" id="name_update">
    </div>

    <div class="description-input">
        <textarea placeholder="Description" class="form-control" onkeyup='saveValue(this)' value="{{ $collection->description }}" 
        id="exampleFormControlTextarea1" name="description_update" id="description_update">{{ $collection->description }}</textarea>
    </div>

    <div class="create-col-btn">
        <a href="/profile/artists/{{$collection->artist_id}}/collections/{{$collection->id}}/edit/addNft">
        <button type="button" class="btn btn-outline-dark btn-lg">&nbsp;Add NFT &nbsp;</button>
        </a>
        
    </div>

    <div class="added-nfts" style="display: flex; flex-wrap:wrap;">
        @foreach ($collection->nfts as $nft)
                <div class="nft" style="width: 300px; margin:25px;">
                <a href="/nfts/buy/{{$nft->id}}">
                    <img src="/images/{{ $nft->img_url }}" width="300px" height="203.5px" alt="" style="border: 1px black solid">
                </a>
                </div>
        @endforeach
    </div>

    <div class="create-col-btn">
        <button type="sumbit" class="btn btn-outline-dark btn-lg">&nbsp;Save changes &nbsp;</button>
    </div>
    </form>
    <a href="/collections/{{$collection->id}}}" >
            <button  class="btn btn-light btn-sm">&nbsp;Back &nbsp;</button>
    </a>

    

</div>
<script>

    saveValue(document.getElementById("name_update"));
    saveValue(document.getElementById("description_update"));
    saveValue(document.getElementById("img_url_update"));

    document.getElementById("name_update").value = getSavedValue("name_update");
    document.getElementById("description_update").innerHTML = getSavedValue("description_update");
    document.getElementById("img_url_update").value = getSavedValue("img_url_update");

    function saveValue(e){
        var id = e.id;
        var val = e.value;
        localStorage.setItem(id, val);
    }

    function getSavedValue(v){
        if(!localStorage.getItem(v)){
            return "";
        }
        return localStorage.getItem(v);

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
    .edit-collection{
        display: flex;
        flex-flow: column;
        align-items: center;
        justify-content: center;
    }
   
    .update-collection-controller{
        display: contents;
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

    .added-nfts{
        display: flex;
    }

    
    

</style>
@endsection