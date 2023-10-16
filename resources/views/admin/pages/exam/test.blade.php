@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <section class="section-1 question-card" id="section-1" style="height: 100%; margin-top: 20px;">
        <main class="question-main">
            <div class="{{in_array($slice->id, Auth::user()->list->pluck('question_id')->toArray()) ? 'click active active-2 active-3' : 'click' }}" question_id="{{$slice->id}}" style="float: left;">
                <span class="{{in_array($slice->id, Auth::user()->list->pluck('question_id')->toArray()) ? 'star ti ti-star test' : 'star ti ti-star' }}"></span>
                <div class="ring"></div>
                <div class="ring2"></div>
            </div>
            <div class="text-container">
                <h3>مراجعة للأسئلة الموضوعية</h3>
                <p>السؤال {{ $page }}</p>
                <p onmousedown="return false" onselectstart="return false">{{$slice->title}}</p>
            </div>
            <form>
                <div class="quiz-options">
                        @foreach($slice->answers as $key => $answer)
                            <input type="radio" question_id="{{$slice->id}}" answer_id="{{$answer->id}}" class="input-radio" number="one-{{$key}}" id="one-{{$key + 1}}" name="answer-{{$slice->id}}" required>
                            <label class="radio-label" for="one-{{$key + 1}}" answer_id="{{$answer->id}}">
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
                    @if($page > 1)
                        @php
                            $prev = $page - 1;
                        @endphp
                    <a id="btn" type="submit" href="test?page={{ $prev }}">السابق</a>
                    @endif
                    @php
                        $pageno = $page + 1;
                    @endphp
                    <a id="btn" type="submit" href="test?page={{ $pageno }}">التالي</a>
                </div>
            </form>
        </main>
        <a id="btn" class="back-btn" style="min-width: 230px !important;" href="{{ route('home') }}">
            العودة الي الصفحة الرئيسية
        </a>
    </section>
</div>
@endsection

@section('js')
<script>
    $('.click').click(function() {
        if ($('.star').hasClass("test")) {
                $('.click').removeClass('active')
            setTimeout(function() {
                $('.click').removeClass('active-2')
            }, 30)
                $('.click').removeClass('active-3')
            setTimeout(function() {
                $('.star').removeClass('test')
            }, 15)

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: '{{ route("save.list") }}',
                method: 'post',
                data: {question_id: $(this).attr("question_id"), result: false},
                success: (data) => {}
            });
        } else {
            $('.click').addClass('active')
            $('.click').addClass('active-2')
            setTimeout(function() {
                $('.star').addClass('test')
            }, 150)
            setTimeout(function() {
                $('.click').addClass('active-3')
            }, 150)

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: '{{ route("save.list") }}',
                method: 'post',
                data: {question_id: $(this).attr("question_id"), result: true},
                success: (data) => {}
            });
        }
    })

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

        $(this).siblings().eq(number).addClass('active');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: '{{ route("save.test") }}',
            method: 'post',
            data: {question_id: $(this).attr("question_id"), answer_id: $(this).attr('answer_id')},
            success: (data) => {                
                for(let label of document.querySelectorAll("label")){
                    label.classList.remove('false_input')
                }

                $(`.radio-label`).addClass('false_input')
                $(`.radio-label[answer_id='${data}']`).removeClass('false_input').addClass('true_input')
            }
        });
    });
</script>
@endsection