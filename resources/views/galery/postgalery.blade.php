@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">no</th>
                <th scope="col">Image</th>
                <th scope="col">description</th>
                <th scope="col">created</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>

            @if(Auth::user()->membership_id > 1)
            <a class="btn btn-primary float-right mb-4 mr-4" href="{{url('/form/add/galery')}}">Upload Gallery</a>
            @else
            <label class="ml-5">To Make Galler You Must Upgarade Premium</label>
            @endif
            
            @foreach($gallery as $galer)
            <tr>
                <td>{{$no++}}</td>
                <td><img src="{{asset('image/imagegalery/'.$galer->image)}}"></td>
                <td>{{$galer->description}}</td>
                <td>{{$galer->created_at}}</td>
                <td><a href="{{url('/delete/gallery/'.$galer->id)}}" class="btn btn-danger">Hapus</a></td>
            </tr>
            @endforeach    
        </tbody>
    </table>
</body>

</html>
@endsection
