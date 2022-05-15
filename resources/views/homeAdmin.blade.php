@extends('layouts')

@section('content')
<div class="main-home">
    <h3 class="title"><strong>DSG CHAIN MARKETPLACE</strong></h3>
    <p class="subtitle text-muted">Welcome to the biggest NFT marketplace of the world.</p>
</div>
@endsection

<style lang="scss">
.main-home{
    display: flex;
    align-items: center;
    flex-flow: column nowrap;
}
.title{
    font-size: 30px;
    font-weight: bold;
}
.subtitle{
    font-size: 20px;
}
</style>