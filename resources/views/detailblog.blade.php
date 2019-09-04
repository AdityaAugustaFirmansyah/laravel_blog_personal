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
<link href="/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


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
    </nav>
  </div>



  @foreach($blog as $blg)
  <center>
      <img src="{{asset('image/images/'.$blg->image)}}" class="mt-5">
    </center>

      

<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-3 mb-4 font-italic border-bottom">
        category  : {{$blg->category->nama}}
      </h3>

      @endforeach

      @foreach($blog as $blg)
      <div class="blog-post">
        <h2 class="blog-post-title">Judul : {{$blg->tiitle}}</h2>
        <br>
        <br>
        <p>{{$blg->content}}</p>
        
      </div><!-- /.blog-post -->

      @endforeach
      

    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">
      <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">Qr Blog</h4>
        @foreach($blog as $blg)
        {!!QrCode::size(250)->generate(url('/blog',$blg->id))!!}
        @endforeach
      </div>

      <div class="p-3">
        <h4 class="font-italic">Newest Blog</h4>
        <ol class="list-unstyled mb-0">
        @foreach($recent as $rc)
          <li><a href="#">{{$rc->tiitle}}</a></li>
        @endforeach
        </ol>
      </div>

      <div class="p-3">
        <h4 class="font-italic">ASC title a-z</h4>
        <ol class="list-unstyled mb-0">
        @foreach($ascBlog as $as)
          <li><a href="#">{{$as->tiitle}}</a></li>
        @endforeach
        </ol>
      </div>

      <div class="p-3">
        <h4 class="font-italic">DESC title z-a</h4>
        <ol class="list-unstyled mb-0">
        @foreach($descBlog as $as)
          <li><a href="#">{{$as->tiitle}}</a></li>
        @endforeach
        </ol>
      </div>

      <div class="p-3">
        <h4 class="font-italic">Share</h4>
        <ol class="list-unstyled">
          <li><a href="https://www.instagram.com/">Instagram</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="https://www.facebook.com/">Facebook</a></li>
        </ol>
      </div>

      <div class="p-3">
        <h4 class="font-italic">Tag</h4>
        <ol class="list-unstyled">
        @foreach($tag as $t)
          <li><p class="text-primary">{{$t}}</p></li>
        @endforeach
        </ol>
      </div>
      
    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
    @guest
    @if(Route::has('register'))
    <main role="main" class="inner cover">
    <p class="lead text-light"> Silahkan login atau register untuk komentar blog ini</p>
     <a href="{{url('/blog/cek')}}" class="btn btn-lg btn-secondary">Login</a>
  </main>
  @endif
  @else
<form action="{{route('comentars.create')}}" method="GET">
@csrf
  <div id="comment_form">
    <div>
        <textarea rows="5" cols="100" name="comentar" id="comment" placeholder="Commentar disini "></textarea>
    </div>
    @foreach($blog as $blg)
    <input type="hidden" name="blog_id" value = {{$blg->id}}>
    @endforeach
    <input id="password-confirm" type="hidden" class="form-control" value="{{Auth::user()->id}}" name="user_id" required>
    <div>
        <input type="submit" name="submit" class="btn-primary" value="Add Comment">
    </div> 
</div>
</form>

</footer>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
  <h1 class="display-4">Komentar</h1>
  @foreach ($comment as $cm)
    <p class="mt-5 lead">username = {{$cm->namas->name}}</p>
    <p>{{$cm->created_at->diffForHumans()}}</p>
    <pre class="lead">{{$cm->comentar}}</pre>
    @if($cm->user_id == Auth::user()->id)
    <input type="submit" name="submit" class="btn-primary" value="Edit Comment">
    @endif
    <div class="border-bottom"></div>
  @endforeach
  @endguest  
  </div>
</div>
@guest
  @if(Route::has('register'))
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
  <h1 class="display-4">Komentar</h1>
  @foreach ($comment as $cm)
    <p class="mt-5 lead">username = {{$cm->namas->name}}</p>
    <p>{{$cm->created_at->diffForHumans()}}</p>
    <pre class="lead">{{$cm->comentar}}</pre>
    <div class="border-bottom"></div>
  @endforeach
</div>
</div>
@endif
@endguest
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script></body>
</html>
@endsection