@extends('layouts.app')
@section('css')
<link href="{{ asset('admin_assets\assets\css\fileupload.css') }}" rel="stylesheet" />
@endsection

@section('content')
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                        <div class="row justify-content-center">
                            <div id="send-otp" class="card-body p-2 text-center">
                                <h4>
                                    أرسل رمز التحقق الي
                                    <strong>
                                        {{'+'. $user['country_code'] . " " . $user['phone']}}
                                    </strong>
                                </h4>
                                <div class="alert alert-success" id="successAuth" style="display: none;"></div>
                                <form>
                                    <input id="number" type="hidden"
                                        value="{{'+'. $user['country_code'] . $user['phone']}}">
                                    <div id="recaptcha-container" class="d-flex justify-content-center mt-3"></div>
                                    <button id="send-button" type="button" class="btn btn-primary mt-3"
                                        onclick="sendOTP();">
                                        إرسال
                                    </button>
                                </form>
                            </div>

                            <div id="verifiy-otp" class="card-body text-center d-none">
                                <h4>
                                    رمز التحقق
                                </h4>
                                <p>
                                    تم إرسال رمز التحقق إلى رقم الهاتف المحمول الخاص بك
                                    <br />
                                    <strong>
                                        {{'+'. $user['country_code'] . " " . $user['phone']}}
                                    </strong>
                                </p>
                                <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                                <form>
                                    @csrf
                                    <div class="otp-field otp_form mb-4">
                                        <input type="number" class="input_1 form-control input_otp mx-2 text-center"
                                            index="1" min="0" max="9" step="1">
                                        <input type="number" class="input_2 form-control input_otp mx-2 text-center"
                                            index="2" min="0" max="9" step="1">
                                        <input type="number" class="input_3 form-control input_otp mx-2 text-center"
                                            index="3" min="0" max="9" step="1">
                                        <input type="number" class="input_4 form-control input_otp mx-2 text-center"
                                            index="4" min="0" max="9" step="1">
                                        <input type="number" class="input_5 form-control input_otp mx-2 text-center"
                                            index="5" min="0" max="9" step="1">
                                        <input type="number" class="input_6 form-control input_otp mx-2 text-center"
                                            index="6" min="0" max="9" step="1">
                                    </div>

                                    <button type="button" class="btn btn-primary mb-3" onclick="verify()">
                                        تحقق
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script type="module">
    const firebaseConfig = {
      apiKey: "AIzaSyCVKO1FrbDLb8UTONEhXriEkyREhRcQzVc",
      authDomain: "test-44dcb.firebaseapp.com",
      projectId: "test-44dcb",
      storageBucket: "test-44dcb.appspot.com",
      messagingSenderId: "500012324880",
      appId: "1:500012324880:web:90d1fb9ec604f1f21fd295",
      measurementId: "G-8VGZLBF278"
    };
  
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
</script>

<script>
    $('.otp_form .input_otp').on('input',function(){
        let index = $(this).attr('index');
        let nextIndex = parseInt(index) + 1;
        $(`.input_${nextIndex}`).focus()
    });

    $('.input_otp').on('focus',function(){
        let index = $(this).attr('index');
        let prevIndex = parseInt(index) - 1;

        if ( index > 1) {
            let prev_val = $(`.input_${prevIndex}`).val().length;

            if ( prev_val == 0) {
                $(`.input_${prevIndex}`).focus();
            }
        
        }
    });
</script>

<script type="text/javascript">
    window.onload = function () {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function sendOTP() {
        var number = $("#number").val();

        $("#error").hide();
        if (window.recaptchaVerifier.g.getResponse() == 0) {
            $("#error").text(
                `
                يرجى التحقق من أنك لست روبوتًا
                `
            );
            $("#error").show();
            return;
        }

        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            $("#successAuth").text("Message sent");
            $("#successAuth").show();
            $("#send-otp").addClass("d-none");
            $("#verifiy-otp").removeClass("d-none");
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }

    function verify() {
        var code = $(".input_1").val() + $(".input_2").val() + $(".input_3").val() + $(".input_4").val() + $(".input_5").val() + $(".input_6").val();
        coderesult.confirm(code).then(function (result) {
            var user = result.user;
            $("#successOtpAuth").text("Auth is successful");
            $("#successOtpAuth").show();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': "application/json"
                },
                url: '{{ route("register.store") }}',
                method: 'POST',
                success: function (data) {
                    window.location.href = "{{ route('register.success') }}";
                },
                error: function (error) {
                    $("#error").text(error.responseJSON.message);
                    $("#error").show();
                }
            });

        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }

</script>

@endsection