<!DOCTYPE html>
<html>

<head>

    <!--TITLE-->
    <title>Title Here</title>

    <!--SHORTCUT ICON-->
    <link rel="shortcut icon" href="../images/favicon.icon">

    <!--META TAGS-->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <!--STYLE SHEET-->
    <link rel="stylesheet" href="{{ asset('/assets/css/blog.css') }}">

</head>

<body>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    <div class="container mt-5">

        <h2>Create Blog</h2>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="title">Title</label>
                </div>
                <div class="col-75">
                    <input type="text" id="title" name="title" placeholder="Title..">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="subject">Your message..</label>
                </div>
                <div class="col-75">
                    <textarea name="content" id="content" required placeholder="Write something.." style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="thumbnail">Thumbnail</label>
                </div>
                <div class="col-75">
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
            </div>


            <div class="row">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>

    <!--REMOVE THIS-->
    <div class="credits">
        <b>Figma Design: </b><a href="https://www.figma.com/file/GeEaxbJudYCKI2tX5K5rHc/Xcelonline?node-id=0%3A1"
            title="Figma" target="_blank">Click_Here</a>
    </div>
</body>

</html>
