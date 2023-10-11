@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <section class="section-1 question-card" id="section-1" style="height: 100%; margin-top: 20px;">
        <main class="question-main">
            <div class="text-container">
                <h3>الاختبار</h3>
                <p>السؤال {{ $page }} من 30</p>
                <p>{{$slice->first()->title}}</p>
            </div>
            <form>
                <div class="quiz-options">
                        @foreach($slice->first()->answers as $key => $answer)
                            <input type="radio" class="input-radio" number="one-{{$key}}" id="one-{{$key + 1}}" name="answer-{{$slice->first()->id}}" required>
                            <label class="radio-label" for="one-{{$key + 1}}">
                                <span class="alphabet">
                                    @if($key == 0)
                                        ا
                                    @elseif($key == 1)
                                        ب
                                    @elseif($key == 2)
                                        ج
                                    @elseif($key == 3)
                                        د
                                    @endif
                                </span> {{ $answer->title }}
                            </label>
                        @endforeach
                </div>
                <div class="d-flex">
                    @if($page < 2)
                        @if($page > 1)
                            @php
                                $prev = $page - 1; 
                            @endphp
                        <a id="btn" type="submit" href="exam?page={{ $prev }}">السابق</a>
                        @endif
                        @php
                            $pageno = $page + 1; 
                        @endphp
                        <a id="btn" type="submit" href="exam?page={{ $pageno }}">التالي</a>
                    @else
                        <a id="btn" type="submit" href="#">انهاء الاختبار</a>
                    @endif
                </div>
            </form>
        </main>
        <a id="btn" class="back-btn" href="{{ route('home') }}">
            العودة الي الصفحة الرئيسية
        </a>
    </section>
</div>
@endsection


@section('js')
    <script>
        $('.input-radio').on('change', function(){
            let number = 0;
            for(let label of document.querySelectorAll("label")){
                label.classList.remove('active')
            }

            if($(this).attr('number').split('one-')[1] == '1'){
                number = $(this).attr('number').split('one-')[1] - 1 + 2;
            }
            else if($(this).attr('number').split('one-')[1] == '2'){
                number = $(this).attr('number').split('one-')[1] - 1 + 3;
            }
            else if($(this).attr('number').split('one-')[1] == '3'){
                number = $(this).attr('number').split('one-')[1] - 1 + 4;
            }

            $(this).siblings().eq(number).addClass('active')
        });
    </script>
@endsection