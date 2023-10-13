@extends('vendor.installer.layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                Setup Your User Account
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('setup.account.submit') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Your Full Name">
                    </div>
                    <div class="mb-3">
                        <label>E-Mail <span class="text-danger">*</span></label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Your E-Mail Address">
                    </div>
                    <div class="mb-3">
                        <label>Profile Pic <span class="text-danger">*</span></label>
                        <input type="file" name="profile_pic" class="form-control" value="{{ old('profile_pic') }}" placeholder="Select Profile Pic">
                    </div>
                    <div class="mb-3">
                        <label>Password <span class="text-danger">*</span></label>
                        <input autocomplete="new-password" type="password" name="password" value="{{ old('password')}}" class="form-control" placeholder="Enter Your Password">
                    </div>
                    <div class="mb-3">
                        <label>Re-Type Password <span class="text-danger">*</span></label>
                        <input autocomplete="new-password" type="password" name="confirm_password" value="{{ old('password')}}" class="form-control" placeholder="Confirm Your Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
