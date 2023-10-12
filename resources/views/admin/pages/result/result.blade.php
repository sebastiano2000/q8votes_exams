@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">{{ __('pages.personal_details') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">{{ __('pages.personal_details') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body custom-edit-service">
                           {{ $result->score }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Wrapper -->

</div>
@endsection

@section('js')
<script>
</script>
@endsection