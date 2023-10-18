@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
      <!-- QUIZ ONE -->
    <section class="section-1 question-card" id="section-1" style="height: 100%; margin-top: 20px;">
        <main class="question-main">
            <div class="text-container">
                <h3>اختبار للأسئلة المفضلة</h3>
                <p onmousedown="return false" onselectstart="return false">{{$slice->first()->title}}</p>
            </div>
            <form>
                <div class="quiz-options">
                    @foreach($slice->first()->answers as $key => $answer)
                        <input type="radio" question_id="{{$slice->first()->id}}" answer_id="{{$answer->id}}" class="input-radio" number="one-{{$key}}" id="one-{{$key + 1}}" name="answer-{{$slice->first()->id}}" required>
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
                    <a id="btn" type="submit" href="{{route('question.fav')}}">انهاء الاختبار</a>
                </div>
            </form>
        </main>
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