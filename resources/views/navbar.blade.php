<!DOCTYPE html>
<html>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo.png') }}" width="40" height="40" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Marketplace<span class="sr-only">(current)</span></a>
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
            <li>
                <img src="/images/{{Auth::user()->img_url}}" width="40" height="40" alt="" style="border-radius: 50%;">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile" style="margin-left: auto;">My Profile</a>
            </li>
            <li class="nav-item2">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
            @endauth
            @guest
            <li class="nav-item2">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item2">
                <a class="nav-link" href="/register">Register</a>
            </li>
            @endguest
            </ul>
    </div>
</nav>

</html>

<style lang="scss">
    .navbar {
        height: 100px;
        font-size: 20px;
    }

    .navbar-brand {
        font-size: 24px;
        padding-right: 40px;
    }

    .nav-item {
        padding-right: 30px
    }

    .nav-item2 {
        padding-right: 14px;
    }

    .navbar-nav > li:last-child
    {
        float:right;
    }
</style>