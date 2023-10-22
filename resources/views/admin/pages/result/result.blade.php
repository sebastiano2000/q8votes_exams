@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <!-- Page Wrapper -->
    <div class="page-wrapper m-4">
        <div class="content container-fluid">
            <!-- /Page Header -->
            <div class="d-flex justify-content-center h-100">
                <div class="col-lg-7 col-xl-7">
                    <div class="card text-black shadow" style="border-radius: 25px;">
                        <div class="d-flex flex-column align-items-center p-3">
                            <h1 class="text-success-result mt-3">
                                انتهت أسئلة {{$result->subject->name}} 
                            </h1>

                            <div class="result-container">
                                <p class="text-result-name mt-3">
                                    {{$result->user->name}}
                                </p>
                                <p class="text-result-details">
                                    درجتك النهائية هي : {{$result->score}} /  {{$result->subject->questions_count}}
                                </p class="text-result-details">
                                <p class="text-result-details">
                                    النسبة : {{round(($result->score / $result->subject->questions_count) * 100,2)}} %
                                </p class="text-result-details">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->

@endsection

@section('js')
<script>
</script>
@endsection