@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-8 col-auto">
                        <h3 class="page-title">محضرين</h3>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('preparator.upsert') }}" class="btn btn-primary float-end mt-2">
                            <i class="ti-plus"></i>
                            اضف محضر
                        </a>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <form class="form" action="{{ route('preparator.filter') }}" method="get">
                                    <div class="form-group d-flex align-items-center">
                                        <input type="search" placeholder="{{ __('pages.search_by_name') }}" name="name"
                                            class="form-control d-block search_input w-50"
                                            value="{{request()->input('name')}}">
                                        <button class="btn btn-primary mx-2 btn-search">{{ __('pages.search')
                                            }}</button>
                                    </div>
                                </form>
                                <table id="example" class=" display  table table-hover table-center mb-0"
                                    filter="{{ route('preparator.filter') }}">
                                    <thead>
                                        <tr>
                                            <th>اسم المحضر</th>
                                            <th class="text-end">{{ __('pages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($preparators as $preparator)
                                        <tr class="record">
                                            <td>{{ $preparator->name }}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('preparator.upsert',['preparator' => $preparator->id]) }}"
                                                        class="btn btn-sm bg-success-light">
                                                        <i class="ti-pencil"></i> {{ __('pages.edit') }}
                                                    </a>
                                                    <a data-bs-toggle="modal" href="#"
                                                        class="btn btn-sm bg-danger-light btn_delete"
                                                        route="{{ route('preparator.delete',['preparator' => $preparator->id])}}">
                                                        <i class="ti-trash"></i> {{ __('pages.delete') }}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation example" class="mt-2">
                                <ul class="pagination">
                                    @for($i = 1; $i <= $preparators->lastPage(); $i++)
                                        <li class="page-item">
                                            <a class="page-link" href="?page={{$i}}">{{$i}}</a>
                                        </li>
                                    @endfor
                                </ul>
                            </nav>
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
</script>
@endsection
