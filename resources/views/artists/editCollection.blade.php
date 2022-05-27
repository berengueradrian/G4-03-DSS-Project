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
            <input type="file" name="img_url_update"  class="custom-file-upload" id="img_url_update">
        </div>
        @if ($errors->has('img_url_update'))
        @foreach ($errors->get('img_url_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
        @endif

        <input style="display:none" type="number" class="form-control" name="id" value="{{ $collection->id}}" placeholder="Identifier of the collection" aria-label="id" aria-describedby="basic-addon1" id="id">
        <input style="display:none" type="number" class="form-control" name="artist_id_update" value="{{ $collection->artist_id}}" placeholder="Identifier of the artist" aria-label="artist_id_update" aria-describedby="basic-addon1" id="artist_id_update">
        
    
    <div class="name-input">
        <input onkeyup='saveValue(this);' type="text" class="form-control"
            placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" name="name_update" id="name_update">
    </div>
    @if ($errors->has('name_update'))
        @foreach ($errors->get('name_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <div class="description-input">
        <textarea onkeyup='saveValue(this);' placeholder="Description" class="form-control" 
         name="description_update" id="description_update">{{ $collection->description }}</textarea>
    </div>
    @if ($errors->has('description_update'))
        @foreach ($errors->get('description_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif


    <div class="save-changes-btn">
        <button type="sumbit" class="btn btn-dark btn-lg">&nbsp;Save changes &nbsp;</button>
    </div>
    </form>

    <h1>Added NFTS</h1>

    <div class="add-nft-btn" style="margin-top:25px;">
        <a href="/profile/artists/{{$collection->artist_id}}/collections/{{$collection->id}}/edit/addNft">
        <button type="button" class="btn btn-outline-dark btn">&nbsp;Add NFT &nbsp;</button>
        </a>
        
    </div>

    
    <div class="added-nfts" style="display: flex; flex-wrap:wrap;">
        @foreach ($collection->nfts as $nft)
        <div class="nft" style="width: 300px; margin:25px; position: relative;"> 
        <!-- Form for delete a collection from the artist profile, disabled for the moment-->
            @if ($nft->user_id==NULL)
            <form></form>
            <form action="{{ route('nft.delete-from-artist') }}" method="POST" style="display: flex; justify-content:center;"
                class="needs-validation create-collection-container" onsubmit="return confirm('Do you really want to delete the nft?');">
            @csrf
            @method('DELETE')
            <input type="text" class="form-control" style="display:none;" name="iddelete" value="{{$nft->id}}" placeholder="Identifier of the collection" 
                aria-label="iddelete" aria-describedby="basic-addon10" id="iddelete" >
            @endif
                
                    <div class="nft">
                    <a href="/nfts/buy/{{$nft->id}}">
                        <img src="/images/{{ $nft->img_url }}" width="300px" height="203.5px" alt="" style="border: 1px black solid">
                    </a>
                    </div>
                    @if ($nft->user_id==NULL)
                    <button  type="sumbit" class="remove-image" style="display: flex; align-items:center;">&#215; <text style="font-size: 10px;">&nbsp;Delete Nft</text></button>
                    @endif    
               
            @if ($nft->user_id==NULL)
            </form> 
            @endif
            </div>
        @endforeach
    </div>

    
    <a href="/collections/{{$collection->id}}}" style="margin-bottom:10px;" >
            <button onclick='setDefault()' class="btn btn-light btn-sm">&nbsp;Back &nbsp;</button>
    </a>

    

</div>
<script type="text/javascript">
        document.getElementById("name_update").value = getSavedValue("name_update");    
        document.getElementById("description_update").value = getSavedValue("description_update");  

        function saveValue(e){
            var id = e.id;  // get the sender's id to save it . 
            var val = e.value; // get the value. 
            localStorage.setItem(id, val);
        }

        function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                if(v=="name_update"){
                    return "{{ $collection->name }}"
                }else  
                    return "{{ $collection->description }}"
            }
            return localStorage.getItem(v);
        }
        function setDefault(){
            localStorage.clear();
        }
</script>
<style lang="scss">
    a:hover {
    color:#FFF; 
    text-decoration:none; 
    cursor:pointer;  
    }
    .remove-image {
    display: none;
    position: absolute;
    top: 10px;
    right: -10px;
    border-radius: 10em;
    padding: 2px 6px 3px;
    text-decoration: none;
    font: 700 21px/20px sans-serif;
    background: #555;
    border: 3px solid #fff;
    color: #FFF;
    box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
      text-shadow: 0 1px 2px rgba(0,0,0,0.5);
      -webkit-transition: background 0.5s;
      transition: background 0.5s;
    }
    .remove-image:hover {
     background: #E54E4E;
      padding: 3px 7px 5px;
      top: 9px;
    right: -11px;
    }
    .remove-image:active {
     background: #E54E4E;
      top: 10px;
    right: -11px;
    }

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

    .save-changes-btn{
        margin-top: 25px;
        margin-bottom: 40px;
    }

    .added-nfts{
        display: flex;
    }

    .nft{
        margin:30px;
    }

    

</style>
@endsection