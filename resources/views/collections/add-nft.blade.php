@extends('layouts')

@section('content')
<div style="height: 50px;">
@if (session()->has('message'))
 <div id="success"  class="alert alert-success"role="alert">
    {{session()->get('message')}}
</div> 
<script>
    setTimeout(() => {document.getElementById("success").style.display = "none";}, 4000);

</script>
@endif
</div>
<h1>ADD YOUR NFT</h1>
<div class="add-nft">
    <div class="foticos" style="display: contents ;">
        <br><br>
        <text> Upload your photo so you can change it!</text>
        <br>
        <!-- THIS IS FOR UPLOADING PHOTO TO PUBLIC FOLDER -->
        <form method="post" action="{{ route('images.store') }}" enctype="multipart/form-data">
            @csrf
    
            <input type="file" style=" margin-bottom:10px" name="img_url" class="custom-file-upload" id="img_url">
            <button type="submit" class="btn btn-success">Upload new photo</button>
        </form>
        </div>
        <br>
        

    <form action="{{ route('nft.add', ['collection' => $collection->id]) }}" 
        method="POST" 
        class="needs-validation create-collection-container" style="display:contents;">
    @csrf
    @method('POST')
        <div class="choose-file">
        <text> Select your NFT image!</text>
            <input type="file"  name="img_url" class="custom-file-upload" id="img_url">
        </div>
        @if ($errors->has('img_url'))
        @foreach ($errors->get('img_url') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
        @endif
        
        <div class="name-input">
            <input type="text" class="form-control" placeholder="Name" name="name" id = "name" aria-label="Name" aria-describedby="basic-addon1">
        </div>
        @if ($errors->has('name'))
        @foreach ($errors->get('name') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
        @endif
        <div class="input-group mb-3 price">
            <input type="text" class="form-control" placeholder="Base price"  name="base_price" id="base_price" aria-label="Base price" aria-describedby="basic-addon1">
            <select class="custom-select">
                <option selected>ETH</option>
            </select>
        </div>
        @if ($errors->has('base_price'))
        @foreach ($errors->get('base_price') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
        @endif
        <div class="tipo">
            <select class="custom-select" id="tipo" onchange="setType(this)"> 
                    <option selected value="1" id="tipo"> Common</option>
                    <option value="2" id="tipo">Rare</option>
                    <option value="3" id="tipo">Exclusive</option>
                    <option value="4" id="tipo">Very Exclusive</option>
                    <option value="5" id="tipo">Legendary</option>
            </select>
            @if ($errors->has('type_id'))
            @foreach ($errors->get('type_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
            @endforeach
            @endif
            <input style="display:none" type="number" class="form-control"  value="1" name="type_id" id="type_id" aria-label="type_id" aria-describedby="basic-addon1">
            <script>
                function setType(tipo){
                    document.getElementById("type_id").value=tipo.value;
                }
            </script>
        </div>

        
        <div class="btn-add-nft">
            <button style="width:100%; margin-top:30px;" type="sumbit" class="btn btn-outline-dark ">Add NFT</button>
        </div>
    </form>
    <a href="/profile/artists/{{$collection->artist_id}}/collections/{{$collection->id}}}/edit" >
            <button  class="btn btn-light btn-sm">&nbsp;Back &nbsp;</button>
    </a> 
</div>
<style lang="scss">
    .app-main{
        margin-top: 90px!important;
    }
    
    .invalid-tooltip{
        display: block!important;
        position:relative!important;
        width: fit-content!important;
        top:1px;
        align-self: flex-start;
        margin-left: 16%;
    }
    
    
    h1{
        text-align: center;
    }
    .add-nft{
        display: flex;
        flex-flow: column;
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