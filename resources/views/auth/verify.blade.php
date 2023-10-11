@extends('layouts.app')
@section('content')

<section>
    <div class="container">
        <header>
            <i class="bx bxs-check-shield"></i>
        </header>
        <h4>Enter OTP Code</h4>
        <form action="#">
            <div class="input-field">
                <input type="number" />
                <input type="number" disabled />
                <input type="number" disabled />
                <input type="number" disabled />
            </div>
            <button>Verify OTP</button>
        </form>
    </div>
</section>
@endsection
