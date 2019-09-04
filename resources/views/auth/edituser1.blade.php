@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-success">Konfirmasi Pembayaran</div>

                <div class="card-body">
                    <form method="POST" action="{{url ('/paymentplat')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="membership" class="col-md-4 col-form-label text-md-right">Kode Pembayaran (gimik)</label>

                            <div class="col-md-6">
                            <input id="password-confirm" type="hidden" class="form-control" value="3" name="membership_id" required>
                            <input id="password-confirm" type="hidden" class="form-control" value="{{Auth::user()->id}}" name="id" required>
                            <input id="password-confirm" type="text" class="form-control" name="kode" required>

            
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
