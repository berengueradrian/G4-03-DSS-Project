@extends('layouts')

@section('content')
<h1>ADD YOUR NFT</h1>
<div class="add-nft">
    <div class="foticos">

        <text> Upload your photo so you can change it!</text>
        <!-- THIS IS FOR UPLOADING PHOTO TO PUBLIC FOLDER -->
        <form method="post" action="{{ route('images.store') }}" enctype="multipart/form-data">
            @csrf
    
            <input type="file" style="width:400px; margin-bottom:10px" name="img_url" class="custom-file-upload" id="img_url">
            <button type="submit" class="btn btn-success">Upload new photo</button>
        </form>
        </div>
        <br>
        <div class="foticos">
        <text> Select your uploaded photo to show it!</text>
        <!-- THIS IS FOR UPDATING EXISTING PHOTO -->
        <!-- con enctype="multipart/form-data" no detecta como campo rellenado que random!!! -->
        <form action="{{ route('user.update') }}" method="POST" class="needs-validation create-user-container">
            @csrf
            @method('PUT')
        
            <input type="hidden" class="form-control" name="id_update" value="{{ Auth::guard('custom')->user()->id }}" placeholder="Identifier of the user" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
            <input type="file" style="width:400px; margin-bottom:10px" name="img_url_update" class="custom-file-upload" id="img_url_update">
            <button type="submit" class="btn btn-secondary">Select uploaded photo</button>
        </form>
    </div>
    <div class="btn-add-pic">
        <button  type="button" class="btn btn-outline-secondary btn-sm">Add Picture</button>
    </div>
    <div class="name-input">
        <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3 price">
        <input type="text" class="form-control" placeholder="Base price" aria-label="Base price" aria-describedby="basic-addon1">
        <select class="custom-select">
            <option selected>Crypto</option>
            <option value="1">SOL</option>
            <option value="2">SCAN</option>
            <option value="3">TIN</option>
        </select>
    </div>
    <div class="tipo">
        <select class="custom-select">
                <option selected>Tipo</option>
                <option value="magic">Mágico</option>
                <option value="legend">Legendario</option>
                <option value="anuel">ANUEL BRR</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="date">
            <h6>Limit Date: </h6>
            <input class="input-date" type="date" name="limitdate" id="limitdate">
        </div>
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Available</label>
        </div>
    </div>
    <div class="btn-add-nft">
        <button style="width:100%;" type="button" class="btn btn-outline-dark ">Add NFT</button>
    </div>
</div>
<style lang="scss">
    h1{
        text-align: center;
    }
    .add-nft{
        display: flex;
        flex-flow: column;
        margin-left: 120px;
        margin-right: 120px;
        align-items: center;
    }
    .input-group{
        margin-top: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70%;
        
    }

    .form-check{
        margin-left: 40px;
    }
    .date{
        display: flex;
        align-items:baseline;
        
    }

    .input-date{
        margin-left: 10px;        
    }

    .btn-add-pic{
        margin-top: 16px;
    }
    .name-input{
        margin-top: 16px;
        width: 70%;
    }

    .btn-add-nft{
        margin-top: 5px;
        width: 50%;
    }

</style>
@endsection