@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <a class="text-decoration-none text-light btn btn-success mb-3" href="{{url('/addblog')}}">Tambah Blog</a>
    @if(Auth::user()->membership_id == 1)
    <a class="text-decoration-none text-light btn btn-secondary mb-3 ml-5"
        href="{{url('/mail/send/1/'.Auth::user()->email)}}">Upgrade Premium</a>
    <a class="text-decoration-none text-light btn btn-warning mb-3 ml-5"
        href="{{url('/mail/send/2/'.Auth::user()->email)}}">Upgrade Platinum</a>
    @endif

    @if(Auth::user()->membership_id == 2)
    <a class="text-decoration-none text-light btn btn-warning mb-3 ml-5"
        href="{{url('/mail/send/2/'.Auth::user()->email)}}">Upgrade Platinum</a>
    @endif

    @foreach($status as $st)
    <label class="ml-5">Status {{$st->membership->type}}</label>
    @endforeach
    <a class="text-decoration-none text-light btn btn-danger float-right mb-3 mr-4 "
        href="{{url('/deleteuser/'.Auth::user()->id)}}">Delete Account</a>
    @if(Auth::user()->membership_id > 1)
    <a class="btn btn-primary float-right mr-4" href="{{url('/post/galery')}}">Post Gallery</a>
    @else
    <label class="ml-5">To Make Galler You Must Upgarade Premium</label>
    @endif
    <div class="table-responsive">
    <table class="table" id="tabledata">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">tiitle</th>
                <th scope="col">description</th>
                <th scope="col">created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    </div>
</body>

<script>
    $(document).ready(function(){
        var table = $('#tabledata').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{url('/json')}}",
            },
            "columns": [
                {
                    data: "id",
                    name: "id"
                },
                {
                    data: "tiitle",
                    name: "tiitle"
                },
                {
                    data: "desc",
                    name: "desc"
                },
                {
                    data: "created_at",
                    name: "created_at"
                },
            ],
            "aoColumnDefs":[
                {
                "aTargets": [4],
				"data": null,
				"orderable": false,
				defaultContent: "<button class='btn-edit btn btn-info btn-xs'>Edit</button>|<button class='btn-delete btn btn-danger btn-xs'>Delete</button>"
                }
            ]
        });
        $('#tabledata tbody').on('click','.btn-edit',function() {
            var data = table.row( $(this).parents('tr') ).data()
            location.replace("{{url('/update')}}"+"/"+data["id"])
        })

        $('#tabledata tbody').on('click','.btn-delete',function() {
            var data = table.row( $(this).parents('tr') ).data()
            location.replace("{{url('/delete')}}"+"/"+data["id"])
        })
    })
</script>

</html>
@endsection
