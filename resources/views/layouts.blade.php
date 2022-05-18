<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <title>DSGChain</title>
</head>

<body>
    <div class="app">
        @include('navbar')
        <div class="app-main">
            <div class="app-centered">
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
                @yield('content')
            </div>
        </div>
        
    </div>
</body>

</html>

<style lang="scss">
    .app{
        font-family: 'Roboto', sans-serif;
    }

    .app-main{
        display: flex;
        justify-content: center; 
        /*background-color: #f8f9fa!important;*/
        margin-top: 40px
    }
    .app-centered{
        padding-top: 20px;
        display: flex;
        flex-flow: column nowrap;
        width: 95%;
    }

    .content-title{
        font-size: 30px;
        font-weight: 100;
        padding-bottom: 20px
    }
</style>

