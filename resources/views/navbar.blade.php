<!DOCTYPE html>
<html>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f5f5f5 !important; ">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo.png') }}" width="40" height="40" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="background-color: #f5f5f5 ; color: rgba(255,255,255,.5)!important; z-index: 99;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/marketplace">Marketplace<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About Us</a>
            </li>
        </ul>
        <ul class="navbar-nav justify-content-end" style="margin-left: auto;">
            @auth
            <li class="nav-item img">
                <img src="/images/{{Auth::user()->img_url}}" width="40" height="40" alt="" style="border-radius: 50%;">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile" style="margin-left: auto;">My Profile</a>
            </li>
            <li class="nav-item2">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
            @endauth
            @auth('custom')
            <li class="nav-item">
                <img src="/images/{{Auth::guard('custom')->user()->img_url}}" width="40" height="40" alt="" style="border-radius: 50%;">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile/artists" style="margin-left: auto;">My Profile</a>
            </li>
            <li class="nav-item2">
                <a class="nav-link" href="/artists/logout">Logout</a>
            </li>
            @endauth
            @if(!Auth::check() && !Auth::guard('custom')->check())
            <li class="nav-item2">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item2">
                <a class="nav-link" href="/register">Register</a>
            </li>
            @endif
        </ul>
    </div>
</nav>

</html>

<style lang="scss">
    
    @media(max-width: 1000px) {
        .nav-item img {
            display: none;
        }
    }

    .navbar {
        height: 90px;
        font-size: 20px;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 99;
        box-shadow: 0px 0px 20px 3px rgba(52,58,64,0.88);
    }

    .navbar-brand {
        font-size: 24px;
        padding-right: 40px;
    }

    .nav-item {
        padding-right: 30px;
        margin-left: 15px;
    }

    .nav-item2 {
        padding-right: 14px;
        margin-left: 15px;
        margin-bottom: 5px;
    }

    .navbar-nav > li:last-child
    {
        float:right;
    }
</style>