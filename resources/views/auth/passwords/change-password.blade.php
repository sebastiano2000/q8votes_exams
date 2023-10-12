@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-7 col-xl-7">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <form class="form-horizontal form-material" method="POST"
                            action="{{ route('forget-password.change-password.store') }}">
                            @csrf


                            <input type="hidden" name="phone" value="{{ $phone }}">
                            <h3 class="text-center m-b-20">إعادة تعيين كلمة المرور</h3>
                            <div class="form-group">
                                <input type="password" class="form-control mb-3" name="password"
                                    placeholder="كلمة المرور" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="تأكيد كلمة المرور" required>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block btn-lg btn-info btn-rounded">إعادة
                                    تعيين كلمة
                                    المرور</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>@endsection