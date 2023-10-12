
@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">نتائج الاختبار</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <form class="form" action="{{ route('result.filter') }}" method="get">
                                        <div class="form-group d-flex align-items-center">
                                            <input type="search" placeholder="{{ __('pages.search_by_name') }}" name="name" class="form-control d-block search_input w-50" value="{{request()->input('name')}}">
                                            <button class="btn btn-primary mx-2 btn-search">{{ __('pages.search') }}</button>
                                        </div>
                                    </form>
                                    <table id="example" class=" display  table table-hover table-center mb-0"  filter="{{ route('result.filter') }}">
                                        <thead>
                                            <tr>
                                                <th>اسم المتدرب</th>
                                                <th>النتيجة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($results as $result)
                                                <tr class="record">
                                                    <td>{{ $result->user->name }}</td>
                                                    <td>{{ $result->score }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>  
                                    </table>
                                </div>
                                <nav aria-label="Page navigation example" class="mt-2">
                                    <ul class="pagination">
                                        @for($i = 1; $i <= $results->lastPage(); $i++)
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