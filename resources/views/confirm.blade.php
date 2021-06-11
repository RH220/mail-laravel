@extends('template')

@section('title', '送信内容の確認 | 社会の窓通知サービス')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1 class="display-5">送信内容の確認</h1>
        <p class="lead">
            以下の内容でメールを送信します。<br />
            内容を確認し、大丈夫そうな場合のみ送信してください。
        </p>
    </div>
</div>
<div class="container">
    <form action="{{ route('confirm') }}" method="post">
        @csrf
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">from</th>
                    <!-- config関数はLaravelの関数で、コンフィグファイルの中の1項目を抽出しています。 -->
                    <!-- 項目としては差出人名で、この項目は.envのMAIL_FROM_NAMEを参照しています。 -->
                    <td>{{ config('mail.from.name') }} &lt;{{ config('mail.from.address') }}&gt;</td>
                </tr>
                <tr>
                    <th scope="row">to</th>
                    <td>{{ session('inquiry.email') }}</td>
                </tr>
                <tr>
                    <th scope="row">件名</th>
                    <td>{{ session('inquiry.name') }}さんにお知らせがあります</td>
                </tr>
                <tr>
                    <th scope="row">本文</th>
                    <td>{!! nl2br($message) !!}</td>
                </tr>
            </tbody>
        </table>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">送信する</button>
            <a class="btn btn-secondary" href="{{ route('index') }}">戻る</a>
        </div>
    </form>
</div>
@endsection