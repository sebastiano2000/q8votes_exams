@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100 flex-column">
            <img src="{{ asset('admin_assets/images/logoq.png') }}" class="light-logo mb-3" alt="homepage"
                style="max-height: 100px" />
            <div class=" col-lg-7 col-xl-7">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        @if (session('message'))
                        <div class="alert alert-danger">{{ session('message') }}</div>
                        @endif
                        @error('session')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}"
                            method="POST">
                            @csrf

                            <h3 class="text-center m-b-20">تسجيل الدخول لبنك الأسئلة الموضوعية </h3>
                            <div class="form-group">
                                <input class="form-control" type="text" required="" placeholder="رقم الهاتف"
                                    name="phone">
                                @error('phone')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" required="" placeholder="كلمة السر"
                                    name="password">
                            </div>
                            @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <div class="form-group text-center">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">تسجيل
                                    الدخول</button>
                            </div>
                        </form>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center justify-content-between">
                                    <a href="{{ route('forget-password.reset') }}" class="text-muted">
                                        نسيت كلمة السر؟
                                    </a>
                                    <a href="{{ route('register') }}" class="text-muted">
                                        ليس لديك حساب؟
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div>
                <a href="https://wa.me/+96596615789">
                    <h2 style="text-">
                        WhatsApp
                        <img src="{{ asset('admin_assets/images/whatsapp.png') }}" alt="whatsapp" width="40px">
                    </h1>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection