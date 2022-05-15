@extends('layouts')

@section('content')
<div class="main-home-guest">
    <div class="title">
        <strong><h1>DSG CHAIN MARKETPLACE</h1></strong>
    </div>
    <hr class="separator">
    <div class="content-images">
        @foreach ($nfts as $nft)
            <img src="/images/{{ $nft->img_url }}" class="content-images-img">
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
    <div class="expensive-nft">
        <div class="title">
            The NFT of the moment
        </div>
        <div class="content">
            <div class="content-img">
                <img src="/images/{{ $nft->img_url }}" alt="NFTImg" class="content-img-img">
            </div>
            <div class="content-data">
                <p class="content-data-name"><strong>Name:</strong> <i>{{ $nft->name }}</i></p>
                <p class="content-data-type"><strong>Type:</strong> <i>{{ $nft->type->name }}</i></p>
                <p class="content-data-collection"><strong>Collection:</strong> <i>{{ $nft->collection->name }}</i></p>
                <p style="padding-bottom: 50px" class="content-data-price"><strong>Price:</strong> <i>{{ $nft->actual_price }}$</i></p>
                <button type="button" class="btn btn-primary">Purchase it now!</button>
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
    margin-bottom: 90px;
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
    margin-bottom: 195px;
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
.expensive-nft{
    margin-bottom: 100px;
}
.expensive-nft .title{
    font-size: 4rem;
    margin-bottom: 50px;
}
.expensive-nft .content{
    display: flex;
    flex-flow: row wrap;
}
.content-img{
    width: 60%;
    margin-right: 100px;
}
.content-img-img{
    width: 100%;
}
.content-data{
    display: flex;
    flex-flow: column nowrap;
    font-size: 2rem;
}
</style>