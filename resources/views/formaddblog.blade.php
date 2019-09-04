@extends('layouts.app')

@section('content')

<a class="text-decoration-none text-light btn btn-success mb-3 mr-4" href="{{url('category')}}">Add Category</a>
<a href="{{url('/form/add/tag')}}" class="text-decoration-none text-light btn btn-success mb-3 mr-4">create tag</a>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<form style="padding:30px;" action="{{ url('/add') }} " method="post" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="form-group">
        <label for="exampleInputEmail1">Tiitle</label>
        <input name="tiitle" type="text" class="form-control" id="tiitle" aria-describedby="emailHelp" placeholder="masukan judul maksimal 15 karakter" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input name="desc" type="text" class="form-control" id="desc" placeholder="masukan description maksimal 20 karakter" required>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Category</label>
    <select class="form-control form-control-sm" name="category_id" required>
        <option value="1">Education</option>
        <option value="2">Sport</option>
        <option value="5">News</option>
        <option value="3">People&Blog</option>
        <option value="4">Science & Technology</option>
        @foreach($blog as $bg)
        <option value="{{$bg->id}}">{{$bg->nama}}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Your TAG</label>
    <select class="form-control form-control-sm multi" name="tag_blog[]" multiple="multiple" required>
        <option value="JavaScript">JavaScript</option>
        <option value="Java">Java</option>
        <option value="Web">Web</option>
        <option value="Android">Android</option>
        @foreach($tag as $t)
        <option value="{{$t->name}}">{{$t->name}}</option>
        @endforeach
    </select>
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail1">Image Required png,jpg,jpeg</label>
        <input name="image" type="file" class="form-control" id="tiitle" aria-describedby="emailHelp" placeholder="masukan thumbnail nya require jpg,png,jpeg" required>
    </div>


    <label for="exampleInputPassword1">content</label>
    <div class="form-group">

        <textarea name="content" id="content" cols="150" rows="10" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    $(document).ready(function() {
        $('.multi').select2().text();
    });

</script>
@endsection
