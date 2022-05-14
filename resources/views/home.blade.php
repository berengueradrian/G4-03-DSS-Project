@extends('layouts')

@section('content')
<div class="main-home-guest">
    <div class="title">
        <h1>DSG CHAIN MARKETPLACE</h1>
    </div>
    <hr class="separator">
    <div class="content-images">
        @foreach ($nfts as $nft)
            <img src="/images/landing1.png" class="content-images-img">
        @endforeach
    </div>
    <button type="button" class="btn btn-secondary btn-lg explore">Explore!</button>
    <hr class="separatorNewsletter">
    <div class="news-container">
        <div class="news-container-title">
            <p class="news-container-title-head">Newsletter</p>
            <p class="news-container-title-content">
                Join the best NFT Community ever created around the world by<br>providing your email
            </p>
        </div>
        <div class="news-container-data">
            <div class="input-group subscribe">
                <span class="input-group-text email-icon" id="basic-addon1">@</span>
                <input type="text" class="form-control email" placeholder="E-mail" aria-label="Email" aria-describedby="basic-addon1">
            </div>
            <button type="button" class="btn btn-light btn-subscribe">Subscribe</button>
        </div>
    </div>
    <hr class="separatorNewsletter" style="margin-bottom: 100px;">
    <div class="last-call">
        <p class="last-call-title">

        </p>
        <div class="last-call-content">
            <img src="" alt="">
            <div class="last-call-content-data">
                <img src="" alt="">
                <p></p>

            </div>
        </div>
    </div>
</div>
@endsection

<style lang="scss">
.main-home-guest{
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
    align-items: center;
    padding-top: 50px;
}
.title{
    text-align: center;
    font-weight: lighter;
    padding-bottom: 20px;
}
h1{
    font-size: 5rem !important;
}
.separator{
    width: 500px;
    margin-bottom: 30px;
}
.content-images{
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: center;
    width: 55%;
    padding-bottom: 100px;
}
.explore{
    margin-bottom: 80px;
    padding: 0.75rem 2rem !important;
    font-size: 1.5rem !important;
}
.content-images-img{
    width: 200px;       
}
.separatorNewsletter{
    width: 100%;
}
.news-container{
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: center;
    width: 90%;
    padding: 40px 0;
}
.news-container-title{
    display: flex;
    flex-flow: column nowrap;   
    margin-right: 50px;     
}
.news-container-title-head{
    font-weight: 300;
    font-size: 4rem;
}
p{
    margin-bottom: 10px !important;
}
.news-container-title-content{
    font-weight: 100;
    font-size: 1.5rem;
}
.news-container-data{
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
}
.subscribe{
    margin-right: 1.5rem;
}
.email-icon{
    font-size: 1.5rem !important;
}
.email{
    padding: 20px 30px !important;
    font-size: 1.5rem !important;
}

.btn-subscribe{
    font-size: 20px !important;
    padding: 10px 20px !important;
}
</style>