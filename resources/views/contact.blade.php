@extends('layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h3 class="title"><strong>CONTACT US</strong></h3>
<div class="container">
    <div class="content">
        <div class="left-side">
            <div class="address details">
                <i class="fas fa-map-marker-alt"></i>
                <div class="topic">Address</div>
                <div class="text-one">C/Poeta Miguel Hernández 24</div>
                <div class="text-two">Elche 03235</div>
            </div>
            <div class="phone details">
                <i class="fas fa-phone-alt"></i>
                <div class="topic">Phone</div>
                <div class="text-one">+34 675 432 678</div>
                <div class="text-two">+34 900 834 765</div>
            </div>
            <div class="email details">
                <i class="fas fa-envelope"></i>
                <div class="topic">Email</div>
                <div class="text-one">dsgchain@gmail.com</div>
                <div class="text-two">help@dsgchain.net</div>
            </div>
        </div>
        <div class="right-side">
            <div class="topic-text">DSG Chain is pleased to help you</div>
            <div class="topic">The timetables for attendance at telephone are the following:</div>
            <div class="text-two">Monday to Friday -> 8am-2pm & 3pm-8pm</div>
            <div class="text-two">Weekends -> 8am-2pm</div>
            <div class="text-two">Hollidays -> No service</div>
        </div>
    </div>
</div>
@endsection

<style lang="scss">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins" , sans-serif;
    }

    .container{
        width: 85%;
        background: #fff;
        border-radius: 6px;
        padding: 20px 60px 30px 40px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .container .content{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .container .content .left-side{
        width: 25%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
        position: relative;
    }
    .content .left-side::before{
        content: '';
        position: absolute;
        height: 70%;
        width: 2px;
        right: -15px;
        top: 50%;
        transform: translateY(-50%);
        background: #afafb6;
    }
    .content .left-side .details{
        margin: 14px;
        text-align: center;
    }
    .content .left-side .details i{
        font-size: 30px;
        color: #3e2093;
        margin-bottom: 10px;
    }
    .content .left-side .details .topic{
        font-size: 18px;
        font-weight: 500;
    }
    .content .left-side .details .text-one,
    .content .left-side .details .text-two{
        font-size: 14px;
        color: #afafb6;
    }
    .container .content .right-side{
        width: 75%;
        margin-left: 75px;
    }
    .content .right-side .topic-text{
        font-size: 23px;
        font-weight: 600;
        color: #3e2093;
    }
    .content .right-side .topic{
        font-size: 18px;
        font-weight: 500;
    }
    .content .right-side .text-one,
    .content .right-side .text-two{
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
        .container{
            margin: 40px 0;
            height: 100%;
        }
        .container .content{
            flex-direction: column-reverse;
        }
        .container .content .left-side{
            width: 100%;
            flex-direction: row;
            margin-top: 40px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .container .content .left-side::before{
            display: none;
        }
        .container .content .right-side{
            width: 100%;
            margin-left: 0;
        }
    }
</style>