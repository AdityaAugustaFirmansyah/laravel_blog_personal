@extends('layouts.app')

@section('content')

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Blog Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/cybrog.css')}}" rel="stylesheet">
    <link href="{{asset('css/blog.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                <a class="p-2 text-muted" href="{{url('/beranda')}}">beranda</a>
                <a class="p-2 text-muted" href="{{url('/portofolio')}}">Portfolio</a>
                <a class="p-2 text-muted" href="{{url('/profile')}}">profile</a>
                <a class="p-2 text-muted" href="{{url('/blog')}}">Blog</a>
                <a class="p-2 text-muted" href="{{url('/galery')}}">Gallery</a>
            </nav>
        </div>

        <div class="jumbotron p-3 p-md-1 text-white rounded bg-white">
            <div class="col-md-12 px-0">
                <div class="row">
                    <img src="{{asset('image/avatar.png')}}" class="col-5">
                    <h2 class="col text-light mt-5">Selamat Datang Di Blog Kami</h2>
                </div>
            </div>
        </div>
        <select class="form-control form-control-lg" onChange="window.location.href=this.value">
            <option>Category</option>
            <option value="{{url('/blog')}}">All</option>            
            <option value="{{url('/blog/category/1')}}">Education</option>
            <option value="{{url('/blog/category/2')}}" >Sport</option>
            <option value="{{url('/blog/category/5')}}" >News</option>
            <option value="{{url('/blog/category/3')}}">People&Blog</option>
            <option value="{{url('/blog/category/4 ')}}">Science & Technology</option>
        </select>
        <div class="row mb-2 mt-4">
        @foreach($blog as $blg)
            <div class="col-md-6">
            
                <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-primary">{{$blg->category->nama}}</strong>
                        <strong class="d-inline-block mb-2 text-dark">Created by = {{$blg->user->name}}</strong>
                        <h3 class="mb-0">
                            <a class="text-dark" href="{{url('/blog/'.$blg->id)}}">{{substr($blg ->tiitle,0,15.)."..."}}</a>
                        </h3>
                        <div class="mb-1 text-muted">{{"dibuat dari ".$blg->created_at->diffForHumans()}}</div>
                        <p class="card-text mb-auto">{{substr($blg->desc,0,20)."..."}}</p>
                        <a href="{{url('/blog/'.$blg->id)}}" style="margin-bottom:20px;">Continue reading</a>
                    </div>
                    <img class="bd-placeholder-img card-img-right flex-auto d-none d-lg-block" width="200" height="250"
                        xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"
                        aria-label="Placeholder: Thumbnail" src="{{asset('image/images/'.$blg->image)}}"></img>
                </div>
                
            </div>
            @endforeach
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')

        </script>
        <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP"
            crossorigin="anonymous"></script>
</body>

</html>
@endsection
