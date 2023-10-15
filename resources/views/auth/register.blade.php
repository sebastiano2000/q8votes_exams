@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11 m-3">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                    تسجيل حساب جديد
                                </p>
                                <form method="POST" action="{{ route('register.create')}}" onsubmit="validate()">
                                    @csrf
                                    <div class="form-outline flex-fill mb-4">
                                        <label class="form-label" for="name">
                                            {{__('pages.Full name')}}
                                        </label>
                                        <input id="name" type="name" class="form-control" name="name"
                                            value="{{ old('name') }}" required autocomplete="name">
                                    </div>

                                    <div class="form-outline flex-fill mb-4">
                                        <label class="form-label" for="phone">
                                            {{__('pages.Phone')}}
                                        </label>
                                        <div class="input-group">
                                            <x-country-phone-code></x-country-phone-code>
                                            <input id="phone" type="text"
                                                class="form-control mr-2 @error('phone') is-invalid @enderror"
                                                placeholder="رقم الهاتف"" name=" phone" value="{{ old('phone') }}"
                                                required autocomplete="phone">
                                        </div>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline flex-fill mb-4">
                                        <label class="form-label" for="password">
                                            كلمة المرور
                                        </label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline flex-fill mb-4">
                                        <label class="form-label" for="confirm-password">
                                            تأكيد كلمة المرور
                                        </label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            تسجيل
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                    class="img-fluid" alt="Sample image">
                            </div>
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
    function validate() {
        var phone = document.getElementById("phone").value;
        var password = document.getElementById("password").value;
        var password_confirmation = document.getElementById("password-confirm").value;
        var name = document.getElementById("name").value;

        if (phone == "" || password == "" || password_confirmation == "" || name == "") {
            event.preventDefault();
            alert("يجب ملئ جميع الحقول");
        }

        if (password != password_confirmation) {
            event.preventDefault();
            alert("كلمة المرور غير متطابقة");
        }

        if (isNaN(phone)) {
            event.preventDefault();
            alert("رقم الهاتف يجب أن يكون أرقام فقط");
        }
    }
</script>

@endsection
