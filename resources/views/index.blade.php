@extends('template') 

@section('title', '社会の窓通知サービス')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1 class="display-5">社会の窓が空いている人に匿名でメールを送ろう！</h1>
        <p class="lead">
            目の前にいる友人や恋人の社会の窓が空いている。気になるけれど、気軽には言えない。<br />
            そんな相手に匿名でメールを送ってみましょう。
        </p>
    </div>
</div>
<div class="container">
    <form action="{{ route('inquiry') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">社会の窓が空いている人のお名前</label>
            {{-- ここから編集(name) --}}
            <input type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                placeholder="お名前"
                value="{{ old('name', session('inquiry.name')) }}">
            {{-- ここまで編集(name) --}}
            <div class="invalid-feedback">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email">社会の窓が空いている人のメールアドレス</label>
            {{-- ここから編集(email) --}}
            <input type="text"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                placeholder="メールアドレス"
                value="{{ old('email', session('inquiry.email')) }}">
            {{-- ここまで編集(email) --}}
            <div class="invalid-feedback">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="relationship">社会の窓が空いている人との関係</label>
            <select name="relationship" class="form-control @error('relationship') is-invalid @enderror" id="relationship">
                <option value="">選択してください</option>
                @foreach (config('relationship') as $value)
                    {{-- ここから編集(relationship) --}}
                    <option value="{{ $value }}"@if (old('relationship', session('inquiry.relationship')) === $value) selected  @endif>{{ $value }}</option>
                    {{-- ここまで編集(relationship) --}}
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('relationship')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="content">何か伝えたいこと</label>
            {{-- ここから編集(content) --}}
            <textarea name="content"
                class="form-control @error('content') is-invalid @enderror"
                id="content"
                rows="3"
                placeholder="伝えたいことを入力してください">{{ old('content', session('inquiry.content')) }}</textarea>
            {{-- ここまで編集(content) --}}
            <div class="invalid-feedback">
                @error('content')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">確認画面へ</button>
        </div>
    </form>
</div>
@endsection