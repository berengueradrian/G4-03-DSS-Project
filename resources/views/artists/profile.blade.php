@extends('layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h3 class="title"><strong>Artist Profile</strong></h3>
<div class="container">

    <div class="content">
        <div class="left-side">

            <br>
            <div class="foto">
                <img src="/images/{{Auth::guard('custom')->user()->img_url}}" width="210" height="150" alt="">
            </div>
            <br>

            <div class="user details">
                <i class="fas fa-user"></i>
                <div class="topic">Artist id: {{Auth::guard('custom')->user()->id}}</div>
                <div class="text-one">Artist name: {{Auth::guard('custom')->user()->name}}</div>
            </div>

        </div>

        <div class="right-side">
            <div class="balance" style="display: flex; gap: 5px; flex-flow: row wrap;">
                <div class="textB">{{Auth::guard('custom')->user()->balance}} <strong>ETH</strong></div>
                <img src="/images/eth.svg" width="25px" alt="">
            </div>
            <div class="buttons">
                <a href="/profile/artists/{{Auth::guard('custom')->user()->id}}/addCollection" style="width: 100% ;">
                <button type="button" class="btn btn-outline-primary" style="margin-bottom: 10px;">Add Collection</button>
                </a>
                <div class="bottom-buttons">
                    <a href="/profileSettings/artists">
                        <button type="button" class="btn btn-secondary">Profile Settings</button>
                    </a>

                    <form action="{{ route('artist.deleteProfile') }}" method="POST" id="deleteArtist" class="needs-validation create-collection-container">
                        @csrf
                        @method('DELETE')
                        <div class="input-group bootstrap-input">
                            <input type="hidden" class="form-control" name="iddelete" value="{{Auth::guard('custom')->user()->id}}" aria-label="iddelete" aria-describedby="basic-addon10" id="iddelete">
                        </div>
                        <input type="hidden" value="{{ Auth::guard('custom')->user()->id }}" name="artistId" id="artistId">
                        <button type="button" onclick="borrarCuenta()" class="btn btn-danger">Delete account</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="description">
        <div class="nombre" style="text-align: center;">
            DESCRIPTION
        </div>
        <p class="desc-content">
            {{ Auth::guard('custom')->user()->description }}
        </p>
    </div>

    <div class="nombre"> COLLECTIONS </div>
    <div class="listado">

        @for ($i = 0; $i < Auth::guard('custom')->user()->collections->count(); $i++)
            <a href='/collections/{{ Auth::guard('custom')->user()->collections[$i]->id }}'>
                <img src="/images/{{Auth::guard('custom')->user()->collections[$i]->img_url}}" width="150" alt="">
            </a>
        @endfor

    </div>

</div>
@endsection
<script>
    function borrarCuenta(){
        if(confirm('Estas seguro?')){
            document.forms.deleteArtist.submit();
        }
    }
    
</script>
<style lang="scss">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    
    .desc-content{
        text-align: center;
        font-size: 1rem;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .buttons{
        display: flex;
        flex-flow: column nowrap;
        width: fit-content;
    }

    .addCollection{
        width: 100%;
    }

    .bottom-buttons{
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        gap: 10px;
        width: fit-content;
    }

    .nombre {
        margin: auto;
        border-bottom: 1px solid black;
        margin-bottom: 20px;
        margin-top: 30px;
        width: 50%;
        padding: 10px;
        text-align: center;
        font-size: 20px;
        font-weight: bolder;
    }

    .textB {
        padding: 12px;
        padding-left: 0px;
        font-size: 60px;
        font-weight: lighter;
    }


    .listado {

        flex-wrap: wrap;
        display: flex;
        margin: 0 auto;
        row-gap: 10px;
        column-gap: 10px;
        padding: 10px 0;
        justify-content: center;
        width: 80%;
    }

    .center {
        margin: auto;
        width: 90%;
        padding: 10px;
        margin-bottom: 40px;
        margin-top: 40px;
        font-size: 18px;
    }

    .container {
        width: 85%;
        background: #fff;
        border-radius: 6px;
        padding: 20px 60px 30px 40px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .container solid {
        border-style: solid;
    }

    .container .content {
        display: flex;
        margin-bottom: 10px;
        align-items: center;
        justify-content: space-between;
    }

    .container .content .left-side {
        width: 50%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
        margin-left: 50px;
        margin-right: 0px;
        position: relative;
    }

    .content .left-side .details {
        margin: 14px;
        text-align: center;
    }

    .content .left-side .details i {
        font-size: 30px;
        color: #3e2093;
        margin-bottom: 10px;
    }

    .content .left-side .details .topic {
        font-size: 18px;
        font-weight: 500;
    }

    .content .left-side .details .text-one,
    .content .left-side .details .text-two {
        font-size: 14px;
        color: #afafb6;
    }

    .container .content .right-side {
        width: 80%;
        margin-left: 50px;
    }

    .content .right-side .topic-text {
        font-size: 23px;
        font-weight: 600;
        color: #3e2093;
    }

    .content .right-side .topic {
        font-size: 18px;
        font-weight: 500;
    }

    .content .right-side .text-one,
    .content .right-side .text-two {
        font-size: 14px;
        color: #afafb6;
    }

    @media (max-width: 950px) {
        .container{
            width: 90%;
            padding: 30px 40px 40px 35px ;
        }
        .container .content .right-side{
            width: 75%;
            margin-left: 55px;
        }
    }
    @media (max-width: 820px) {
        .addCollection{
            width: 100%;
        }
        .container{
            margin: 40px 0;
            height: 100%;
        }
        .container .content{
            flex-direction: column;
            justify-content: center;
            margin-left: 0;
            
        }
        .container .content .left-side{
            width: 100%;
            flex-direction: row;
            margin-top: 40px;
            justify-content: center;
            flex-wrap: wrap;
            margin-left: 0px;
        }
        .container .content .left-side::before{
            display: none;
        }
        .container .content .right-side{
            width: 100%;
            margin-left: 0;
            display: flex;
            align-items: center;
            flex-flow: column wrap;
        }
        .buttons{
            align-items: center;
            width: fit-content;
        }
    }
    @media(max-width: 500px) {
        .listado{
            width: fit-content;
        }
    }
</style>