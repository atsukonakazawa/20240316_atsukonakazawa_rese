@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/emails/notifyEmailConfirm.css') }}">
@endsection

@section('main')
<div class="content-outer">
    <div class="content">
        <div class="title-outer">
            <h2 class="title">
                店舗代表者　専用画面
            </h2>
        </div>
        <div class="subtitle-outer">
            <h2 class="subtitle">
                メール内容確認
            </h2>
        </div>
        <form action="/manager/notify/email/send" method="post">
        @csrf
            <div class="confirm-table__outer">
                    <table class="confirm-table">
                        <tr class="name-row">
                            <th class="user-name">
                                送信先　利用者名
                            </th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr class="email-row">
                            <th>
                                送信先　メールアドレス
                            </th>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr class="subject-row">
                            <th>
                                件名
                            </th>
                            <td>
                            {{ $subject }}
                            </td>
                        </tr>
                        <tr class="notify-row">
                            <th>
                                本文
                            </th>
                            <td>
                                {{ $notify }}
                            </td>
                        </tr>
                    </table>
            </div>
            <div class="button-outer">
                <button type="submit" class="button">
                    送信する
                </button>
                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="hidden" name="email" value="{{ $user->email }}">
                <input type="hidden" name="subject" value="{{ $subject }}">
                <input type="hidden" name="notify" value="{{ $notify }}">
                <a class="back-link" href="/manager/notify/email/create">
                    戻る
                </a>
            </div>
        </form>
    </div>
</div>
@endsection