@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-7 col-xl-7">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <form method="POST" action="{{ route('forget-password.change-password.store') }}">
                            @csrf

                            <input type="hidden" name="phone" value="{{ $phone }}">
                            <h3 class="text-center m-b-20">إعادة تعيين كلمة المرور</h3>

                            <input type="password" class="form-control mb-3" name="password" placeholder="كلمة المرور"
                                required autocomplete="new-password">

                            <input type="password" class="form-control mb-3" name="password_confirmation"
                                placeholder="تأكيد كلمة المرور" required autocomplete="new-password">

                            <button type="submit" class="btn btn-block btn-lg btn-info btn-rounded">إعادة تعيين كلمة
                                المرور</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>@endsection