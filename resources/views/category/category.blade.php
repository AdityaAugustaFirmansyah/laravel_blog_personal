@extends('layouts.app')

@section('content')

@if(Session::get('msg'))
<script>
    alert({{ Session::get('msg') }})
</script>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-success text-light">Create Category</div>

                <div class="card-body">
                    <form method="GET" action="{{route('addCategory')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Add Category</label>

                            <div class="col-md-6">
                            <input type="text" class="form-control" name="nama" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="color-black mt-5 mb-3 text-center">This is all category from us</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                <div class="card"><div class="card-header alert-success text-light">Category 1</div>
                <label for="category" class="text-center mt-5">Education</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                <div class="card"><div class="card-header alert-success text-light">Category 2</div>
                <label for="category" class="text-center mt-5">Sport</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                <div class="card"><div class="card-header alert-success text-light">Category 3</div>
                <label for="category" class="text-center mt-5">People & Blog</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                <div class="card"><div class="card-header alert-success text-light">Category 4</div>
                <label for="category" class="text-center mt-5">Science & Technology </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                <div class="card"><div class="card-header alert-success text-light">Category 5</div>
                <label for="category" class="text-center mt-5">News</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="color-black mt-5 mb-5 text-center">This is Your Category</div>

@foreach($category as $ct)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                     <div class="card">
                     <div class="card-header alert-success text-light">Category {{$angka++}}
                        <a href="{{url('/blog/update/category/'.$ct->id)}}" class="btn btn-warning float-right ml-3">Edit</a>
                        <a href="{{url('/category/delete/'.$ct->id)}}" class="btn btn-danger float-right">Delete</a>
                        </div>
                        <label for="category" class="text-center mt-5">{{$ct->nama}}</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
