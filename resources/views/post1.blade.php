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
                <th scope="col">tiitle</th>
                <th scope="col">description</th>
                <th scope="col">created</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            <a class="text-decoration-none text-light btn btn-success mb-3" href="{{url('/addblog')}}">Tambah Blog</a>

            <a class="text-decoration-none text-light btn btn-warning mb-3 ml-5"
                href="{{url('/mail/send/2/'.Auth::user()->email)}}">Upgrade Platinum</a>
            <label class="ml-5">Status Premium</label>
            <a class="text-decoration-none text-light btn btn-danger float-right mb-3 mr-4 "
                href="{{url('/deleteuser/'.Auth::user()->id)}}">Delete Account</a>
            @if(Auth::user()->membership_id > 1)
            <a class="btn btn-primary float-right mr-4" href="{{url('/post/galery')}}">Post Gallery</a>
            @else
            <label class="ml-5">To Make Galler You Must Upgarade Premium</label>
            @endif
            @foreach($data as $dt)

            <tr>
                <th scope="row">{{$angka++}}</th>
                <td>{{$dt->tiitle}}</td>
                <td>{{$dt->desc}}</td>
                <td>{{$dt->created_at}}</td>
                <td>
                    <a class="btn btn-warning" href="{{url('/update/'.$dt->id)}}">Edit</a>
                    <a class="btn btn-danger" href="{{url('/delete/'.$dt->id)}}">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
@endsection
