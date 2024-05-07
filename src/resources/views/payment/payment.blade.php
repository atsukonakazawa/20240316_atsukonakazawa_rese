@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/payment.css') }}">
@endsection

@section('main')
    <form class="pay-form" action="/pay" method="POST">
        @csrf
        <input class="amount" type="number" name="amount" placeholder="金額を入力してください">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-name="Stripe決済デモ"
            data-label="決済をする"
            data-description="これはデモ決済です"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
        </script>
    </form>
@endsection