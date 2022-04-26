@extends('layouts')

@section('content')
<div class="main-home-guest">
    <div class="title">
        <h1>DSG CHAIN MARKETPLACE</h1>
    </div>
    <hr class="separator">
    <div class="content-images">
    @for ($i = 0; $i < 3; $i++)
        <img src="/images/landing1.png" class="content-images-img">
    @endfor
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
    font-size: 4rem !important;
}
.separator{
    width: 500px;
    margin-bottom: 30px;
}
.content-images{
    display: flex;
    flex-flow: row wrap;
    justify-content: center;
    align-items: center;
}
.content-images-img{
    width: 200px;
    margin-right: 50px;    
}
</style>