<!DOCTYPE html>
<html>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">ADMINISTRATOR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="background-color: #343a40!important; z-index: 99;">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href={{ route('user.getAll') }}>Users<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('artist.getAll') }}>Artists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route("collection.getAll") }}>Collections</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{route("type.getAll")}}>Types</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{ route("nft.getAll") }}>NFTs</a>
            </li>
          </ul>
          <ul class="navbar-nav justify-content-end" style="margin-left: auto;">
            <li class="nav-item" style="margin-left: 15;">
                <img src="/images/{{Auth::user()->img_url}}" width="40" height="40" alt="" style="border-radius: 50%;">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile" style="margin-left: auto;">My Profile</a>
            </li>
            <li class="nav-item2">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
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

    .navbar{
        height: 100px;
        font-size: 20px;
    }

    .navbar-brand{
        font-size: 24px;
        padding-right: 40px;
    }

    .nav-item{
        padding-right: 30px;
        margin-left: 15px;
    }

    .nav-item2 {
        padding-right: 14px;
        margin-left: 15px;
        margin-bottom: 10px;
    }

    .navbar-nav > li:last-child
    {
        float:right;
    }
    
</style>