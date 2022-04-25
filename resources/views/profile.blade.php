@extends('layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h3 class="title"><strong>Profile</strong></h3>
<div class="container">



    <div class="content">

        <div class="left-side">

            <br>
            <div class="foto">
                <img src="/images/{{Auth::user()->img_url}}" width="210" height="150" alt="">
            </div>
            <br>

            <!--@if(Auth::user()->is_admin || Auth::user()->id=="9")-->
            <div class="user details">
                <i class="fas fa-user"></i>
                <div class="topic">User id: {{Auth::user()->id}}</div>
                <div class="text-one">User name: {{Auth::user()->name}}</div>
            </div>
            <!--@endif-->

        </div>

        <div class="right-side">
            <div class="textB">Balance: {{Auth::user()->balance}}</div>
            <a href="/profileSettings">
                <button type="button" class="btn btn-secondary">Profile Settings</button>
            </a>

            <form action="{{ route('user.delete') }}" method="POST" class="needs-validation create-collection-container">
                @csrf
                @method('DELETE')
                <div class="input-group mb-3 bootstrap-input">
                    <input type="hidden" class="form-control" name="iddelete" value="{{Auth::user()->id}}" aria-label="iddelete" aria-describedby="basic-addon10" id="iddelete">
                </div>
                <!-- TIENE QUE MANDARTE AL MAIN PQ SI NO INTENTA CARGAR LA PAGINA Y HASTA LUEGO -->
                <button type="submit" class="btn btn-danger">Delete account</button>

            </form>


        </div>
    </div>


    <div class="content">
        <div class="text">--Listar NFTS--</div>
    </div>




</div>
@endsection

<style lang="scss">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .textB {
        padding: 12px;
        font-size: 22px;
        font-weight: bolder;
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
        margin-left: 10px;
        margin-right: 0px;
        position: relative;
    }

    .content .left-side::before {
        content: '';
        position: absolute;
        height: 70%;
        width: 2px;
        margin-right: 50px;
        right: -15px;
        top: 50%;
        transform: translateY(-50%);
        background: #afafb6;
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
        width: 50%;
        margin-left: 75px;
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
</style>