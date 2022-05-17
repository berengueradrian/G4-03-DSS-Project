@extends('layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h3 class="title"><strong>Profile Settings</strong></h3>
<div class="container">

    @if(Session::has('msg'))
    <div class="alert alert-success" role="alert">
        {!! Session::has('msg') ? Session::get("msg") : '' !!}
    </div>
    @elseif(Session::has('errorMsg'))
    <div class="alert alert-danger" role="alert">
        {!! Session::has('errorMsg') ? Session::get("errorMsg") : '' !!}
    </div>
    @endif

    <div class="content">

        <div class="right-side">
            <div class="foto">
                <img src="/images/{{Auth::user()->img_url}}" width="270" height="190" alt="">
            </div>
        </div>

        <div class="right-side" style="margin-bottom: 20px;">
            <div class="topic">User id: {{Auth::user()->id}}</div>
            <div class="text-one">User name: {{Auth::user()->name}}</div>
            <div class="text-one">User email: {{Auth::user()->email}}</div>

            <br>
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

                    <input type="hidden" class="form-control" name="id_update" value="{{ Auth::user()->id }}" placeholder="Identifier of the user" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
                    <input type="file" style="width:400px; margin-bottom:10px" name="img_url_update" class="custom-file-upload" id="img_url_update">
                    <button type="submit" class="btn btn-secondary">Select uploaded photo</button>
                </form>
            </div>
        </div>

    </div>

    <div class="content">
        <div class="right-side">
            <div class="change name">
                <h4> Change name </h4>

                <!-- TODO: no muestra los errores!!! -->
                <form action="{{ route('user.update') }}" method="POST" class="needs-validation create-user-container">
                    @csrf
                    @method('PUT')

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="hidden" class="form-control" name="id_update" value="{{ Auth::user()->id }}" placeholder="Identifier of the user" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
                    </div>

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="text" class="form-control" name="name_update_profile" value="{{ old('name_update_profile') }}" placeholder="New user name" aria-label="Name" aria-describedby="basic-addon1" id="name_update_profile">
                    </div>
                    @if ($errors->has('name_update_profile'))
                    @foreach ($errors->get('name_update_profile') as $error)
                    <div class="invalid-tooltip mb-3">{{ $error }}</div>
                    @endforeach
                    @endif

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="password" class="form-control" name="password" placeholder="Current Password" value="{{ old('password') }}" aria-label="password" aria-describedby="basic-addon3" id="password">
                    </div>
                    @if ($errors->has('password'))
                    @foreach ($errors->get('password') as $error)
                    <div class="invalid-tooltip mb-3">{{ $error }}</div>
                    @endforeach
                    @endif

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="password" class="form-control" name="current_password" placeholder="Confirm password" value="{{ old('current_password') }}" aria-label="current_password" aria-describedby="basic-addon3" id="current_password">
                    </div>
                    @if ($errors->has('current_password'))
                    @foreach ($errors->get('current_password') as $error)
                    <div class="invalid-tooltip mb-3">{{ $error }}</div>
                    @endforeach
                    @endif
                    <button type="submit" class="btn btn-primary">Update name</button>
                </form>

            </div>
        </div>
        <div class="right-side">

            <h4> Change password </h4>
            <div class="change pass">

                <form action="{{ route('user.update') }}" method="POST" class="needs-validation create-user-container">
                    @csrf
                    @method('PUT')

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="hidden" class="form-control" name="id_update" value="{{ Auth::user()->id }}" placeholder="Identifier of the user" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
                    </div>

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="password" class="form-control" name="password_update_profile" placeholder="New Password" aria-label="Name" aria-describedby="basic-addon1" id="password_update_profile">
                    </div>
                    @if ($errors->has('password_update_profile'))
                    @foreach ($errors->get('password_update_profile') as $error)
                    <div class="invalid-tooltip mb-3">{{ $error }}</div>
                    @endforeach
                    @endif

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="password" class="form-control" name="password" placeholder="Current Password" aria-label="Name" aria-describedby="basic-addon1" id="password">
                    </div>
                    @if ($errors->has('password'))
                    @foreach ($errors->get('password') as $error)
                    <div class="invalid-tooltip mb-3">{{ $error }}</div>
                    @endforeach
                    @endif

                    <div class="input-group mb-3 bootstrap-input">
                        <input type="password" class="form-control" name="current_password" placeholder="Confirm Password" aria-label="Name" aria-describedby="basic-addon1" id="current_password">
                    </div>
                    @if ($errors->has('current_password'))
                    @foreach ($errors->get('current_password') as $error)
                    <div class="invalid-tooltip mb-3">{{ $error }}</div>
                    @endforeach
                    @endif


                    <button type="submit" class="btn btn-primary">Update password</button>

                    @if ($errors->has('password_update_profile') || $errors->has('password') || $errors->has('current_password'))
                    <div class="invalid-tooltip mb-3 mt-3">ERROR: No updatea</div>
                    @endif

                </form>
            </div>
        </div>
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

    input[type=file] {
        color: transparent !important;
        margin-top: 10px;

    }

    input[type=file]::before {
        display: none;
        content: "";
        color: black;
        margin-right: 0px;
    }

    .foticos {
        border-top: 10px;
        text-align: left;
        font-size: 14px;
    }

    button {
        font-size: 14px !important;
    }

    .center {
        margin: auto;
        width: 100%;
        padding: 10px;
        text-align: center;
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
        margin-top: 30px;
        margin-bottom: 50px;
        align-items: center;
        justify-content: center;
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
        font-size: 18px;
        color: #afafb6;
    }

    .container .content .right-side {
        width: 50%;
        height: 100%;
        margin-left: 75px;
        display: flex;
        max-width: 350px;
        /*margin-right: 170px;*/
        margin-top: 15px;
        flex-direction: column;
        position: relative;
    }

    .content .right-side .topic-text {
        font-size: 23px;
        font-weight: 600;
        color: #3e2093;
    }

    .content .right-side .topic {
        font-size: 18px;
        margin-top: 5px;
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