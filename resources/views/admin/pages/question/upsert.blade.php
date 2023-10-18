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
                            <h3 class="page-title">اضف سؤال</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:(0);">الاسئلة</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- /Page Header -->        
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body custom-edit-service p-3">                 
                                <!-- Add Blog -->
                                <form method="post" enctype="multipart/form-data" action="{{ route('question.modify') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}" redirect="{{ route('question') }}">
                                    @csrf
                                    <div class="service-fields mb-3">
                                        <div class="form-group">
                                            <div class="row">
                                            
                                                <div class="col-md-6">
                                                    <label class="mb-2">اسم المادة</label>
                                                    <select class="form-control" name="subject_id">
                                                        @foreach($subjects as $subject)
                                                            <option value="{{$subject->id}}" @if($subject->id == $question->subject_id) selected @endif>{{$subject->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="error error_name"></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">رأس السؤال</label>
                                                    <input class="form-control" type="text" name="name" placeholder="{{ __('pages.name') }}" value="@isset($question->id){{$question->title}}@endisset">
                                                    <p class="error error_name"></p>
                                                </div>
                                                
                                                @if($question->id)
                                                    @foreach($question->answers as $key => $answer)
                                                        @if($answer->status)
                                                            <input type="hidden" name="status[{{$key}}]" value="1">
                                                        @else
                                                            <input type="hidden" name="status[{{$key}}]" value="0">
                                                        @endif
                                                        <div class="col-md-6">
                                                            <label class="mb-2">الاجابة {{ $key + 1 }} @if($answer->status) (الصحيحة) @endif</label>
                                                            <input class="form-control" type="text" name="title[{{$key}}]" placeholder="{{ __('pages.name') }}" value="@isset($answer->id){{$answer->title}}@endisset">
                                                            <p class="error error_title_{{$key}}"></p>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $random = rand(0,3)
                                                    @endphp

                                                    @foreach([0,1,2,3] as $position)
                                                        @if($random == $position)
                                                            <input type="hidden" name="status[{{$position}}]" value="1">
                                                        @else
                                                            <input type="hidden" name="status[{{$position}}]" value="0">
                                                        @endif
                                                        <div class="col-md-6">
                                                            <label class="mb-2">الاجابة {{ $position + 1 }} @if($random == $position) (الصحيحة) @endif</label>
                                                            <input class="form-control" type="text" name="title[{{$position}}]" placeholder="{{ __('pages.name') }}" value="@isset($question->id){{$question->title}}@endisset">
                                                            <p class="error error_title_{{$position}}"></p>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @isset($question->id)
                                        <input type="hidden" value="{{$question->id}}" name="id">
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
    $('.dropify').dropify();

</script>
@endsection