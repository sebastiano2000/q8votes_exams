@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-7 col-xl-7">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('forget-password.check') }}">
                            @csrf
                            <div class="form-outline flex-fill mb-4">
                                <label class="form-label" for="phone">
                                    {{__('pages.Phone')}}
                                </label>
                                <div class="input-group">
                                    <x-country-phone-code></x-country-phone-code>
                                    <input id="phone" type="text"
                                        class="form-control mr-2 @error('phone') is-invalid @enderror"
                                        placeholder="رقم الهاتف"" name=" phone" value="{{ old('phone') }}" required
                                        autocomplete="phone">
                                </div>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        بدء إعادة تعيين كلمة المرور
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection