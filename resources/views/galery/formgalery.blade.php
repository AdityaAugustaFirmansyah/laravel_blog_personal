@extends('layouts.app')

@section('content')

<form style="padding:30px;" action="{{ url('/galery/add') }} " method="post" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="form-group">
        <label for="exampleInputEmail1">Image Required png,jpg,jpeg</label>
        <input name="image" type="file" class="form-control" id="tiitle" aria-describedby="emailHelp" placeholder="masukan gambarnya require jpg,png,jpeg" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Description Image</label>
        <input name="description" type="text" class="form-control" id="tiitle" aria-describedby="emailHelp" placeholder="masukan deskripsi gambar" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
