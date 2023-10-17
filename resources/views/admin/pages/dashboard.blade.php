@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                @if(!Auth::user()->isAdmin())
                <div class="row row-cols-2 justify-content-center">
                    <div class="col-xl-5 col-8">
                        <div class="container-tenant mb-4">
                            <div class="wrapper-tenant">
                                <h1>
                                    مراجعة للأسئلة الموضوعية
                                </h1>
                                <div class="button-wrapper">
                                    <a href="{{ route('exam.test') }}" class="btn-tenant fill-tenant">إبدأ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-8">
                        <div class="container-tenant mb-4">
                            <div class="wrapper-tenant">
                                <h1>
                                    اختبار تجريبي للأسئلة الموضوعية
                                </h1>
                                <div class="button-wrapper">
                                    <a href="{{ route('exam') }}" class="btn-tenant fill-tenant">إبدأ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
</script>
@endsection