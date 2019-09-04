@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-success">New Tag</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/add/tag')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="membership" class="col-md-4 col-form-label text-md-right">New Tag</label>

                            <div class="col-md-6">
                            <input id="password-confirm" type="text" class="form-control" name="name" required>                        
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
                <div class="card"><div class="card-header alert-success text-light">Tag 1</div>
                <label for="category" class="text-center mt-5">JavaScript</label>
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
                <label for="category" class="text-center mt-5">Java</label>
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
                <label for="category" class="text-center mt-5">Web</label>
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
                <label for="category" class="text-center mt-5">Android </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="color-black mt-5 mb-5 text-center">This is Your Category</div>

@foreach($tag as $t)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card-body">
                <div class="card"><div class="card-header alert-success text-light">
                Category {{$no++}}
                <a href="{{url('/tag/delete/'.$t->id)}}" class="btn btn-danger float-right">Delete</a>
                </div>
                <label for="category" class="text-center mt-5">{{$t->name}} </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
