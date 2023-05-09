@extends('layouts.app')

@section('content')

<!-- header -->

<div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">{{ config('app.name') }}</span>
            </nav>
        </div>
    </div>
</div>

<!-- content -->
<div class="container">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('slack.post') }}">

            <!-- csrf_token -->
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">名前</label>
                <input type="input" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">

                @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <!-- email -->
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="input" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                @if($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <!-- content -->
            <div class="mb-3">
                <label for="Content">お問合わせ内容</label>
                <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" rows="3" maxlength="256" wrap="soft" >{{ old('content') }}</textarea>

                @if($errors->has('content'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
            </div>
            
            <button type="submit" class="btn btn-dark btn-lg">送信する</button>
        </form>
    </div>
</div>
@endsection