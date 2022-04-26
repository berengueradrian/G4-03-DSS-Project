@extends('layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h3 class="title"><strong>ABOUT US</strong></h3>
<div class="container">

    <div class="content">
        <div class="center">
            <i class="fas fa-users"></i>
            We are DSG-Chain! A group of friends that are willing to expand the NFT and Web3 world by creating an ultra-intuitive marketplace with low fees and many options for their artists and users. Read more about us and know how are the one's in charge of the most popular NFT marketplace!
        </div>
    </div>

    <div class="content">

        <div class="left-side">

            <br>
            <div class="foto">
                <img src="{{ asset('images/about_member1.jpeg') }}" width="210" height="150" alt="">
            </div>
            <br>

            <div class="user details">
                <i class="fas fa-briefcase"></i>
                <div class="topic">Founder & CEO</div>
                <div class="text-one">Leonardo Messias</div>
            </div>

            <div class="attendance details">
                <i class="fas fa-clock"></i>
                <div class="topic">Attendance hours</div>
                <div class="text-one">Monday 9:00 - 13:00 </div>
            </div>

        </div>

        <div class="right-side">
            <div class="topic-text">Leonardo Messias</div>
            <div class="text">This is DSG-Chain founder and CEO. Leonardo Messias has been working on web3 for 32 years. He is one of the most experienced business manager in the blockchain, his hard work has been rewarded with the trophy of NFT-Entrepeneur for 5 consecutive times. Now Leonardo is willing to help trillions of people around the world with a intuitive and easy to use marketplace.</div>
        </div>

    </div>

    <div class="content">

        <div class="left-side">

            <br>
            <div class="foto">
                <img src="{{ asset('images/about_member2.jpeg') }}" width="210" height="150" alt="">
            </div>
            <br>

            <div class="user details">
                <i class="fas fa-paint-brush"></i>
                <div class="topic">Artist Administrator</div>
                <div class="text-one">Juan Lapuerta</div>
            </div>

            <div class="attendance details">
                <i class="fas fa-clock"></i>
                <div class="topic">Attendance hours</div>
                <div class="text-one">Thursday 17:00 - 19:00 </div>
            </div>

        </div>

        <div class="right-side">
            <div class="topic-text">Juan Lapuerta</div>
            <div class="text">This is DSG-Chain Artist Administrator. Juan Lapuerta is the most famous contemporaneous Spanish Artirst. After working with Pikaso and Betoben for some years, now he decided to join the NFT world. His main goal is to make easier for new artist to grow up and help them growing through their whole web3 NFT experience </div>
        </div>

    </div>

    <div class="content">
        <div class="left-side">

            <br>
            <div class="foto">
                <img src="{{ asset('images/about_member3.jpeg') }}" width="210" height="150" alt="">
            </div>
            <br>

            <div class="user details">
                <i class="fas fa-wallet"></i>
                <div class="topic">Financial Advisor</div>
                <div class="text-one">Warren Buffete</div>
            </div>

            <div class="attendance details">
                <i class="fas fa-clock"></i>
                <div class="topic">Attendance hours</div>
                <div class="text-one">Sunday 09:00 - 23:00 </div>
            </div>

        </div>

        <div class="right-side">
            <div class="topic-text">Warren Buffete</div>
            <div class="text">This is DSG-Chain Financial Advisor. Warren Buffete is the best economist nowadays well-known by his high returns on his investments. After working with Guillermo Diaz, Paulo Londra, and many others economists... Warren decided to move on and join DSG-Chain. He is doing his best in order to keep our marketplace economy in the best way possible.</div>
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

    .center {
        margin: auto;
        width: 90%;
        padding: 10px;
        margin-bottom: 40px;
        margin-top: 40px;
        font-size: 18px;
        border-radius: 1px solid black;

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
        border-bottom: 1px solid black;
        align-items: center;
        justify-content: space-between;
    }

    .container .content .left-side {
        width: 25%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
        position: relative;
    }

    .content .left-side::before {
        content: '';
        position: absolute;
        height: 70%;
        width: 2px;
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
        width: 75%;
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