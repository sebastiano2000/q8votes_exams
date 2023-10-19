
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
                            <h3 class="page-title">الاسئلة المفضلة</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <form class="form" action="{{ route('question.filter') }}" method="get">
                                        <div class="form-group d-flex align-items-center">
                                            <input type="search" placeholder="{{ __('pages.search_by_name') }}" name="name" class="form-control d-block search_input w-50" value="{{request()->input('name')}}">
                                            <button class="btn btn-primary mx-2 btn-search">{{ __('pages.search') }}</button>
                                        </div>
                                    </form>
                                    <table id="example2" class=" display  table table-hover table-center mb-0"  filter="{{ route('question.filter') }}">
                                        <thead>
                                            <tr>
                                                <th>رأس السؤال</th>
                                                <th class="text-end">{{ __('pages.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($questions as $question)
                                                <tr class="record">
                                                    <td>{{ $question->title }}</td>
                                                    <td class="text-end">
                                                        <div class="actions">
                                                            <a href="{{ route('question.exam', ['question' => $question->id]) }}" class="btn btn-sm bg-success-light" >
                                                                <i class="ti-book"></i> امتحن السؤال
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#" class="btn btn-sm bg-danger-light btn_delete" route="{{ route('save.list',['question_id' => $question->id, 'result' => false])}}">
                                                                <i class="ti-trash"></i> {{ __('pages.delete') }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>  
                                    </table>
                                </div>
                                <nav aria-label="Page navigation example2" class="mt-2">
                                    <ul class="pagination">
                                        @for($i = 1; $i <= $questions->lastPage(); $i++)
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