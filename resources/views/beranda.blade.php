
<!-- 

    membuat website pribadi persoanal dengan laravel dan bootstrap (statis)
halaman (home,portofolio,profile,artikel), integerasi login , logout , register +database
di hosting dengan nama subdomain nama ini 
buat laporan / view source code di didalam sebuah artikel di wordpress
~
konsekuensi 1
menulis di papan ditulis dengan style code blade tampilan laravel

konsekuensi 2
membuat output loop di papan tulis 100X
 -->

 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Cover Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->
    


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
    <link href="{{asset('css/cover.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand text-light">Adit WEB</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="{{url('/beranda')}}">Home</a>
        <a class="nav-link" href="{{url('/portofolio')}}">Portfolio</a>
        <a class="nav-link" href="{{url('/profile')}}">Profile</a>
        <a class="nav-link" href="{{url('/blog')}}">artikel</a>
        <a class="nav-link" href="{{url('/galery')}}">Gallery</a>
      </nav>
    </div>
  </header>
  @guest
    @if(Route::has('register'))
    <main role="main" class="inner cover">
    <h1 class="cover-heading text-light">Selamat Datang</h1>
    <p class="lead text-light"> Silahkan login atau register untuk membuat blog</p>
     <a href="{{url('/blog/cek')}}" class="btn btn-lg btn-secondary">Login</a>
  </main>
    @endif
    @else
  <main role="main" class="inner cover">
    <h1 class="cover-heading text-light">Selamat Datang <br> {{Auth::user()->name}} </h1>
    <p class="lead text-light">Mari Membuat Blog sederhana </p>

     <a href="{{url('/post')}}" class="btn btn-lg btn-secondary">Create Blog</a>
  </main>
  @endguest
  <footer class="mastfoot mt-auto">
    <div class="inner">
      
    </div>
  </footer>
</div>
</body>
</html>

