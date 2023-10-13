@extends('vendor.installer.layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        @if($errors->any())
        <div class="card mb-1">
            <div class="card-body text-danger">
                {{$errors->first()}}
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                Setup Complete
            </div>
            <div class="card-body">
                <p class="text-success">Your Setup Is Now Complete, Launch Your Website Now</p>
                <a class="btn btn-primary" href="{{ url('/') }}">Launch Website</a>
            </div>
        </div>

    </div>
</div>
@endsection
