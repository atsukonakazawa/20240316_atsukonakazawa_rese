@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/change.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="change-box">
        <form action="/changed" method="get">
        @csrf
        @foreach($reservations as $reservation)
            <h2 class="change-title">
                予約変更画面
            </h2>
            <input class="date" name="date" type="date" id="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"><br>
            <select class="time" name="time" id="time"><br>
                <option disabled selected value="">変更後の時間を選択してください</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
            </select>
            <select class="people" name="people" id="people"><br>
                <option disabled selected value="">変更後の人数を選択してください</option>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <option value="4">4人</option>
                <option value="5">5人</option>
                <option value="6">6人</option>
                <option value="7">7人</option>
                <option value="8">8人</option>
                <option value="9">9人</option>
                <option value="10">10人</option>
                <option value="" disabled>
                    それ以上の場合はお電話にてお問い合わせください
                </option>
            </select>
        @endforeach
            <div class="confirm-outer" id="confirmationSection">
                <table class="confirm-table">
                    <tr class="confirm-shop__name-row">
                        <th>
                            Shop
                        </th>
                        <td>
                        @foreach($reservations as $reservation)
                            {{ $reservation->shop->shop_name }}
                        @endforeach
                        </td>
                    </tr>
                    <tr class="confirm-shop__date-row">
                        <th>
                            Date
                        </th>
                        <td id="confirmDate">
                            <span class="output-date">
                        </td>
                    </tr>
                    <tr class="confirm-shop__time-row">
                        <th>
                            Time
                        </th>
                        <td id="confirmTime">
                            <span class="output-time">
                        </td>
                    </tr>
                    <tr class="confirm-shop__people-row">
                        <th>
                            Number
                        </th>
                        <td id="confirmPeople">
                            <span class="output-people">
                        </td>
                    </tr>
                </table>
                <div class="error-messages">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @foreach($reservations as $reservation)
                    <input type="hidden" name="rese_id" value="{{ $reservation->id }}">
                @endforeach
                <button class="change-button" type="submit">
                    変更する
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/detail.js') }}"></script>
@endsection
