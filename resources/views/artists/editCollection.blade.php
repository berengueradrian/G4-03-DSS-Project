@extends('layouts')

@section('content')
<h1>EDIT YOUR COLLECTION</h1>
<div class="add-collection">
    <div class="portada-artist">
        <div class="portada">
        <div class="foticos">
            <text> Upload your collection cover!</text>
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
        
    </div>
    
        
   
    <div class="name-input">
        <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
    </div>

    <div class="description-input">
        <textarea placeholder="Description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

    <div class="create-col-btn">
        <a href="/profile/artists/{{$collection->artist_id}}/collections/{{$collection->id}}/edit/addNft">
        <button type="button" class="btn btn-outline-dark btn-lg">&nbsp;Add NFT &nbsp;</button>
        </a>
        
    </div>

    <div class="added-nfts">
        @foreach ($collection->nfts as $nft)
                <div class="nft" style="width: 450px;">
                <a href="/nfts/buy/{{$nft->id}}">
                    <img src="../../images/{{ $nft->img_url }}" width="450px" alt="" style="border: 1px black solid">
                </a>
                </div>
        @endforeach
    </div>

    <div class="create-col-btn">
        <button type="button" class="btn btn-outline-dark btn-lg">&nbsp;Edit &nbsp;</button>
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

    .added-nfts{
        display: flex;
    }

    
    

</style>
@endsection