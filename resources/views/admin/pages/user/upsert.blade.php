@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="content container-fluid">		
                <!-- Page Header -->

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">{{ __('pages.add_user') }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('pages.users') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- /Page Header -->        
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body custom-edit-service">                 
                                <!-- Add Blog -->
                                <form method="post" enctype="multipart/form-data" action="{{ route('user.modify') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}" redirect="{{ route('user') }}">
                                    @csrf
                                    <div class="service-fields mb-3">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{ __('pages.name') }}</label>
                                                    <input class="form-control" type="text" name="name" placeholder="{{ __('pages.name') }}" value="@isset($user->id){{$user->name}}@endisset">
                                                    <p class="error error_name"></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{ __('pages.Phone') }}</label>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input placeholder="{{ __('pages.Phone') }}" type="phone" id="number" class="form-control" name="phone" value="@isset($user->id){{$user->phone}}@endisset">
                                                                <p class="error error_phone"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <x-country-phone-code></x-country-phone-code>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">كلمة السر</label>
                                                    <input class="form-control text-start" type="text" name="password" value="@isset($user->id){{$user->password}}@endisset" placeholder="كلمة السر" >
                                                    <p class="error error_password"></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">تاكيد كلمة السر</label>
                                                    <input class="form-control text-start" type="text" name="password_confirmation" value="@isset($user->id){{$user->password}}@endisset" placeholder="كلمة السر" >
                                                    <p class="error error"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @isset($user->id)
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                    @endisset
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit" name="form_submit" placeholder="submit">{{ __('pages.submit') }}</button>
                                    </div>
                                </form>
                                <!-- /Add Blog -->
                            </div>
                        </div>
                    </div>			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
</script>
@endsection