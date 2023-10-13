@extends('vendor.installer.layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    Welcome To Laravel Web Installer
                </div>
                <div class="card-body">

                    <p>Step By Step Installer</p>

                    <ol>
                        <li>Check Minimum Requirements</li>
                        <li>Enter Database Details</li>
                        <li>Setup User Account</li>
                    </ol>

                    <a href="{{ route('setup.requirements') }}" class="btn btn-primary">
                        Check Minimum Requirements
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
