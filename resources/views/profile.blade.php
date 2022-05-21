@extends('layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h3 class="title"><strong>Profile</strong></h3>
<div class="container">
    @if($errors->has('addBalance'))
    <div class="invalid-tooltip mb-3 mt-3 error-msg">{{ $errors->first('addBalance') }}</div>
    @endif
    <div class="content">
        <!-- MODAL -->
        <div class="modal fade" id="balanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form action="{{ route('user.updateBalance') }}" method="POST" class="needs-validation create-collection-container">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add balance to your account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--<form action="{{ route('user.update') }}" method="POST" class="needs-validation create-collection-container">-->
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3 bootstrap-input">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon10">ETH</span>
                                </div>
                                <input type="text" class="form-control" name="addBalance" placeholder="Balance you want to add..." aria-label="iddelete" aria-describedby="basic-addon10" id="addBalance">
                                <input type="hidden" value={{ Auth::user()->id }} name="userId" id="userId">
                            </div>
                            @if ($errors->has('addBalance'))
                            @foreach ($errors->get('addBalance') as $error)
                            <div class="invalid-tooltip mb-3">{{ $error }}</div>
                            @endforeach
                            @endif
                            <!--</form>-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add balance</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- ----------------------------------------------- -->
        <div class="left-side">

            <br>
            <div class="foto">
                <img src="/images/{{Auth::user()->img_url}}" width="210" height="150" alt="">
            </div>
            <br>

            <div class="user details">
                <i class="fas fa-user"></i>
                <div class="topic">User id: {{Auth::user()->id}}</div>
                <div class="text-one">User name: {{Auth::user()->name}}</div>
            </div>
            <!--@if(Auth::user()->is_admin || Auth::user()->id=="9")-->
            <!--@endif-->

        </div>

        <div class="right-side">
            <div class="balance" style="display: flex; gap: 5px; flex-flow: row wrap; align-items:center">
                <div class="textB">{{Auth::user()->balance}} <strong>ETH</strong></div>
                <img src="/images/eth.svg" width="25px" alt="">
                <button type="button" class="btn btn-outline-primary add-balance-icon" data-toggle="modal" data-target="#balanceModal">
                    +
                </button>
            </div>
            <a href="/profileSettings">
                <button type="button" class="btn btn-secondary">Profile Settings</button>
            </a>

            <form action="{{ route('user.delete') }}" method="POST" class="needs-validation create-collection-container">
                @csrf
                @method('DELETE')
                <div class="input-group mb-3 bootstrap-input">
                    <input type="hidden" class="form-control" name="iddelete" value="{{Auth::user()->id}}" aria-label="iddelete" aria-describedby="basic-addon10" id="iddelete">
                </div>
                <button type="submit" onclick="return confirm('Confirm your operation delete')" class="btn btn-danger">Delete account</button>
            </form>


        </div>
    </div>

    <div class="nombre"> NFTS OWNED </div>
    <div class="listado">

        @for ($i = 0; $i < Auth::user()->nfts->count(); $i++)
            <a href="/nfts/buy/{{Auth::user()->nfts[$i]->id}}">
                <img src="/images/{{Auth::user()->nfts[$i]->img_url}}" width="150" alt="">
                @endfor
            </a>

    </div>

</div>
@endsection

<style lang="scss">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    .error-msg {
        display: block !important;
        position: relative !important;
        width: fit-content;
        top: 0 !important;
    }

    .add-balance-icon {
        /*position: fixed;
        top: 120px;
        right: 50px;*/
        height: 50px;
        width: 50px;
        border-radius: 999px !important;

        margin-left: 20px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
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
        width: fit-content !important; 
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
        .container {
            width: 90%;
            padding: 30px 40px 40px 35px;
        }

        .container .content .right-side {
            width: 75%;
            margin-left: 55px;
        }
    }

    @media (max-width: 820px) {
        .container {
            margin: 40px 0;
            height: 100%;
        }

        .container .content {
            flex-direction: column-reverse;
        }

        .container .content .left-side {
            width: 100%;
            flex-direction: row;
            margin-top: 40px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .container .content .left-side::before {
            display: none;
        }

        .container .content .right-side {
            width: 100%;
            margin-left: 0;
        }
    }
</style>