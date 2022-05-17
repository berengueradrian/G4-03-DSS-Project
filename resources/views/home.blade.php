@extends('layouts')

@section('content')
<div class="main-home-guest">
    <div class="title">
        <strong><h1>DSG CHAIN MARKETPLACE</h1></strong>
    </div>
    <hr class="separator">
    <div class="content-images">
        @foreach ($nfts as $nft)
            <a href="/nfts/buy/{{ $nft->id }}"><img src="/images/{{ $nft->img_url }}" class="content-images-img"></a>
        @endforeach
    </div>
    <a href="/marketplace"><button type="button" class="btn btn-primary btn-lg explore" >Explore!</button></a>
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
    <div class="marketplace-popular-nfts">
        <p class="marketplace-popular-nfts-title">
          Popular NFTs
        </p>
        <div class="marketplace-popular-nfts-content">
          <div class="marketplace-popular-nfts-best">
            <img src="/images/{{ $bestNft->img_url }}" alt="" class="marketplace-popular-nfts-best-img">
            <div class="marketplace-popular-nfts-best-data">
              <div class="best-main-data">
                <p>{{$bestNft->name}}</p>
                <p>{{$bestNft->actual_price}}$</p>
              </div>
              <i><p class="best-type">{{$bestNft->type->name}}</p></i>
            </div>
          </div>
          <div class="marketplace-popular-nfts-rest">
            @foreach($popularNfts as $popularNft)
            <div class="marketplace-popular-nfts-rest-item">
              <img src="/images/{{ $popularNft->img_url }}" alt="" class="marketplace-popular-nfts-rest-img">
              <div class="marketplace-popular-nfts-rest-data">
                <div class="rest-main-data">
                  <p>{{$popularNft->name}}</p>
                  <p>{{$popularNft->actual_price}}$</p>
                </div>
                <i><p class="rest-type">{{$popularNft->type->name}}</p></i>
              </div>
            </div>
            @endforeach
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
/* p{
    margin-bottom: 10px !important;
} */
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
.marketplace-popular-nfts{
  display:flex;
  flex-flow: column nowrap;
  align-items: center;
  margin-bottom: 100px;
}
.marketplace-popular-nfts-title{
  font-size: 3.5rem; 
  margin-bottom: 100px
}
.marketplace-popular-nfts-content{
  display: flex;
  flex-flow: row nowrap;
  align-items: center;
  justify-content: center;
  gap: 50px;
}
.marketplace-popular-nfts-best{
  min-width: 40%;
  max-width: 40%;
  margin-left: 50px
}
.marketplace-popular-nfts-best .marketplace-popular-nfts-best-img{
  width: 100%;
  margin-bottom: 20px;
}
.marketplace-popular-nfts-best-data{
  padding-right: 20px;
  font-size: 2rem;
  justify-content: space-between;
  display: flex;
  flex-flow: row wrap;
}
.best-main-data{
  display: flex;
  flex-flow: column nowrap;
  margin-right: 50px;
}
.best-main-data p{
  margin-bottom: 0px !important;
}
.marketplace-popular-nfts-rest{
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-end;
  row-gap: 20px;
  column-gap: 50px;
  margin-right: 50px;
}
.marketplace-popular-nfts-rest-item{
  max-width: 40%;
}
.marketplace-popular-nfts-rest .marketplace-popular-nfts-rest-img{
  width: 100%;
  margin-bottom: 20px;
}
.marketplace-popular-nfts-rest-data{
  padding-right: 20px;
  font-size: 1.2rem;
  justify-content: space-between;
  display: flex;
  flex-flow: row wrap;
}
.rest-main-data{
  display: flex;
  flex-flow: column nowrap;
  margin-right: 50px;
}

.rest-main-data p{
  margin-bottom: 0px !important;
}
</style>