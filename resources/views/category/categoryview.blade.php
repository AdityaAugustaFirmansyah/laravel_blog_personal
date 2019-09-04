@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-success text-light">Update Category</div>

                <div class="card-body">
                    <form method="post" action="{{route('updateCategory')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Add Category</label>
                            <div class="col-md-6">
                            
                            <input type="text" class="form-control" name="nama" value="{{$category->nama}}" required>
                            <input type="hidden" class="form-control" name="id" value="{{$category->id}}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection