<!DOCTYPE html>
<html>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">ADMINISTRATOR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
        </div>
      </nav>
</html>

<style lang="scss">
    .navbar{
        height: 100px;
        font-size: 20px;
    }

    .navbar-brand{
        font-size: 24px;
        padding-right: 40px;
    }

    .nav-item{
        padding-right: 30px
    }
    
</style>