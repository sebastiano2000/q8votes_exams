@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                @if(!Auth::user()->isAdmin())
                <div class="row row-cols-2 justify-content-center">
                    @foreach($subjects as $subject)
                    <div class="col-xl-5 col-8">
                        <div class="container-tenant mb-4">
                            <div class="wrapper-tenant">
                                <h1>
                                    مراجعة {{$subject->name}}
                                </h1>
                                <div class="button-wrapper">
                                    <a href="{{ route('exam.test', ['subject_id' => $subject->id]) }}"
                                        class="btn-tenant fill-tenant">إبدأ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-8">
                        <div class="container-tenant mb-4">
                            <div class="wrapper-tenant">
                                <h1>
                                    اختبار تجريبي {{$subject->name}}
                                </h1>
                                <div class="button-wrapper">
                                    <a href="{{ route('exam', ['subject_id' => $subject->id]) }}"
                                        class="btn-tenant fill-tenant">إبدأ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($preparators as $preparator)
                    @if($preparator->picture)
                    <div class="col-xl-5 col-8">
                        <div class="container-tenant mb-4">
                            <div class="wrapper-tenant">
                                <h1>
                                    مذكرات {{$preparator->name}}
                                </h1>
                                <div class="button-wrapper">
                                    <a href="{{ asset('/preparators/'.$preparator->picture->name) }}" target="_blank"
                                        class="btn-tenant fill-tenant">إبدأ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
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