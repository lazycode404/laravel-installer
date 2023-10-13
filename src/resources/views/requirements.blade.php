@extends('vendor.installer.layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">

            <div class="card">
                <div class="card-header">
                    Minimum Requirements
                </div>
                <div class="card-body">

                    <ul>
                        @foreach ($checks as $key => $check)
                            <li>
                                @lang($key)
                                @if ($check)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    @if ($success)
                        <a href="{{ route('setup.database') }}" class="btn btn-primary">
                            Setup Database
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
