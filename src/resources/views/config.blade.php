@extends('vendor.installer.layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                Configure Your Website
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('setup.configuration.submit') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="config_company_name" class="form-control" value="{{ old('config_company_name') }}" placeholder="Enter Your Company Name">
                    </div>
                    <div class="mb-3">
                        <label>Company Address <span class="text-danger">*</span></label>
                        <textarea name="config_company_address" class="form-control">{{ old('config_company_address') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>App Name <span class="text-danger">*</span></label>
                        <input type="text" name="config_app_name" class="form-control" value="{{ old('config_app_name') }}" placeholder="Enter Your App Name">
                    </div>
                    <div class="mb-3">
                        <label>App Currency <span class="text-danger">*</span></label>
                        <select name="config_app_currency" class="form-control">
                            <option value="INR">INR</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>App Language <span class="text-danger">*</span></label>
                        <select name="config_app_lang" class="form-control">
                            <option value="en">EN</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>App Logo <span class="text-danger">*</span></label>
                        <input type="file" name="config_app_logo" class="form-control" placeholder="Select App Logo">
                    </div>
                    <div class="mb-3">
                        <label>App Favicon <span class="text-danger">*</span></label>
                        <input type="file" name="config_app_favicon_icon" class="form-control" placeholder="Select App Favicon">
                    </div>
                    <div class="mb-3">
                        <label>App Timestamp <span class="text-danger">*</span></label>
                        <select name="config_app_timestamp" class="form-control">
                            <option value="Asia/Kolkata">Asia/Kolkata</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>App Color Scheme <span class="text-danger">*</span></label>
                        <select name="config_color_scheme_class" class="form-control">
                            <option value="bg-primary">BG-Primary</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Right Footer 1 Text <span class="text-danger">*</span></label>
                        <textarea name="config_right_footer_1" class="form-control">{{ old('config_right_footer_1') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Right Footer 2 Text <span class="text-danger">*</span></label>
                        <textarea name="config_right_footer_2" class="form-control">{{ old('config_right_footer_2') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Left Footer 1 Text <span class="text-danger">*</span></label>
                        <textarea name="config_left_footer_1" class="form-control">{{ old('config_left_footer_1') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Left Footer 2 Text <span class="text-danger">*</span></label>
                        <textarea name="config_left_footer_2" class="form-control">{{ old('config_left_footer_2') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>If Footer Fixed <span class="text-danger">*</span></label>
                        <select name="config_is_footer_fixed" class="form-control">
                            <option value="fixed-footer">Fixed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>If Header Fixed <span class="text-danger">*</span></label>
                        <select name="config_is_header_fixed" class="form-control">
                            <option value="fixed-header">Fixed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>If Sidebar Fixed <span class="text-danger">*</span></label>
                        <select name="config_is_sidebar_fixed" class="form-control">
                            <option value="fixed-sidebar">Fixed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>If Notification Fixed <span class="text-danger">*</span></label>
                        <select name="config_is_checked_notification" class="form-control">
                            <option value="fixed-notification">Fixed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Mailer Protocol <span class="text-danger">*</span></label>
                        <select name="config_mail_mailer" class="form-control">
                            <option value="smtp">SMTP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Mail Host <span class="text-danger">*</span></label>
                        <input type="text" name="config_mail_host" class="form-control" value="{{ old('config_mail_host') }}" placeholder="Enter Mail Host">
                    </div>
                    <div class="mb-3">
                        <label>Mail Port <span class="text-danger">*</span></label>
                        <input type="text" name="config_mail_port" class="form-control" value="{{ old('config_mail_port') }}" placeholder="Enter Mail Port">
                    </div>
                    <div class="mb-3">
                        <label>Mail Encryption <span class="text-danger">*</span></label>
                        <select name="config_mail_encryption" class="form-control">
                            <option value="tls">TLS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Mail Username <span class="text-danger">*</span></label>
                        <input type="text" name="config_mail_username" class="form-control" value="{{ old('config_mail_username') }}" placeholder="Enter Mail Username">
                    </div>
                    <div class="mb-3">
                        <label>Mail Password <span class="text-danger">*</span></label>
                        <input type="text" name="config_mail_password" class="form-control" value="{{ old('config_mail_password') }}" placeholder="Enter Mail Password">
                    </div>
                    <div class="mb-3">
                        <label>Mail From <span class="text-danger">*</span></label>
                        <input type="text" name="config_mail_from" class="form-control" value="{{ old('config_mail_from') }}" placeholder="Enter Mail From Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Config</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
