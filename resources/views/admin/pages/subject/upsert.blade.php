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
                            <h3 class="page-title">
                                اضف مادة جديدة
                            </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:(0);">
                                        المادة
                                    </a>
                                </li>
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
                                <form method="post" enctype="multipart/form-data" action="{{ route('subject.modify') }}"
                                    class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}"
                                    title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}"
                                    redirect="{{ route('subject') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="@isset($subject->id){{$subject->id}}@endisset">
                                    <div class="col-md-6">
                                        <label class="mb-2">
                                            اسم المادة
                                        </label>
                                        <input class="form-control" type="text" name="name"
                                            placeholder="{{ __('pages.name') }}"
                                            value="@isset($subject->id){{$subject->name}}@endisset">
                                        <p class="error error_name"></p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="mb-2">
                                            عدد الاسئلة
                                        </label>
                                        <input class="form-control" type="number" name="questions_count"
                                            placeholder="عدد الاسئلة"
                                            value="@isset($subject->id){{$subject->questions_count}}@endisset">
                                        <p class="error error_name"></p>
                                    </div>

                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit" name="form_submit"
                                            placeholder="submit">{{ __('pages.submit') }}</button>
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