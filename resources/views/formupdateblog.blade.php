@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<form style="padding:30px;" action="{{url('/updates')}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
    <div class="form-group">
        <label for="exampleInputEmail1">Tiitle</label>
        <input name="tiitle" type="text" class="form-control" id="tiitle" aria-describedby="emailHelp" placeholder="Enter tiitle" value="{{$blog->tiitle}}">
    </div>

    <div class="form-group">
        <input name="id" type="hidden" class="form-control" id="tiitle" aria-describedby="emailHelp" placeholder="Enter tiitle" value="{{$blog->id}}">
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input name="desc" type="text" class="form-control" id="desc" placeholder="enter description" value="{{$blog->desc}}">
    </div>

    <label for="exampleInputPassword1">Category</label>
    <br>
    <label for="exampleInputPassword1">Your Category in blog = {{$blog->tiitle}}</label>
    <br>
    <label for="exampleInputPassword1">Category is {{$blog->category->nama}}</label>
    <select class="form-control form-control-sm" name="category_id">
        <option value="1" @if($blog->category_id == "1") selected @endif >Education</option>
        <option value="2" @if($blog->category_id == "2") selected @endif >Sport</option>
        <option value="5" @if($blog->category_id == "5") selected @endif >News</option>
        <option value="3" @if($blog->category_id == "3") selected @endif >People&Blog</option>
        <option value="4" @if($blog->category_id == "4") selected @endif >Science & Technology</option>
        @foreach($category as $ct)
        <option value="{{$ct->id}}">{{$ct->nama}}</option>
        @endforeach
    </select>

    
        <!-- <h6 class="mt-3">Your Tag</h6>
        @foreach($tagArr as $tag)
        <p class="btn btn-dark">{{$tag}}</p>
        @endforeach -->
        <label for="exampleInputPassword1" class="mt-3">Your Tag in blog {{$blog->tiitle}}</label>
        <br>
        @foreach($tagArr as $tag)
            <p class="btn btn-dark">{{$tag}}</p>
        @endforeach

        <select class="form-control form-control-sm multi" name="tag_blog[]" multiple="multiple">
            <option value="JavaScript">JavaScript</option>
            <option value="Java">Java</option>
            <option value="Web">Web</option>
            <option value="Android">Android</option> 
            @foreach($tag1 as $t)
            <option value="{{$t->name}}">{{$t->name}}</option> 
            @endforeach
        </select>

    <img class="bd-placeholder-img card-img-right flex-auto d-none d-lg-block mt-3" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail" src="{{asset('image/images/'.$blog->image)}}"></img>
    
    <div class="form-group">
        <label for="exampleInputEmail1">Image Required png,jpg,jpeg</label>
        <input name="image" type="file" class="form-control" id="image" aria-describedby="emailHelp" placeholder="Enter tiitle">
    </div>

    <label for="exampleInputPassword1">content</label>
    <div class="form-group">
        
        <textarea name="content" id="content" cols="150" rows="10" value="fhiewgfiwgfe">{{$blog->content}}</textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    $(document).ready(function() {
        $('.multi').select2().text();
    });

</script>
@endsection
