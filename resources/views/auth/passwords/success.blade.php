@extends('layouts.app')
@section('css')
<link href="{{ asset('admin_assets\assets\css\fileupload.css') }}" rel="stylesheet" />
@endsection

@section('content')

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column align-items-center">
                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                تم تغيير كلمة المرور بنجاح
                            </p>

                            <a href="{{route('login')}}" class="btn btn-primary">
                                تسجيل الدخول
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')

<script>
</script>

@endsection