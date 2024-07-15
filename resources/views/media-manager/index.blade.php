<!-- resources/views/media-manager/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Media</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/media.css') }}">
    @vite(['resources/js/media/app.js'])
</head>

<body>
    <div class="container">
        <h1>Hi</h1>
        <div id="mediamanager">
            <ul>
                <li><router-link to="/media">Media</router-link></li>
                <li><router-link to="/media/upload">Upload</router-link></li>
            </ul>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <router-link to="/media" class="nav-link active" aria-current="page">
                        All Media
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/media/upload" class="nav-link">
                        Upload Media
                    </router-link>
                </li>
            </ul>

            <router-view></router-view>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
