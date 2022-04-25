<!DOCTYPE html>
<html>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo.png') }}" width="30" height="30" alt="">
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
            <li class="nav-item">
                <a class="nav-link" href="/profile">My Profile</a>
            </li>
            @auth
            <li class="nav-item">
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
</style>