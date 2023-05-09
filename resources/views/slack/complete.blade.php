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
            <div class="col-md-5">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">お問合わせ完了</h4>
                     <p>以下の内容でお問合わせが完了いたしました</p>
                    <hr>
                    <a href="{{ route('slack.index') }}">お問い合わせページに戻る</a>
                </div>
                
                <form>
                    <div class="col-md-12">
                        <div class="form-group row border-bottom">
                            <label for="name" class="form-label">お名前</label>
                            <input type="text" class="form-control-plaintext" readonly id="name"
                                value="{{ $user->name }}">
                        </div>
                        <div class="form-group row border-bottom">
                            <label for="email" class="col-form-label">メールアドレス</label>
                            <input type="text" class="form-control-plaintext" readonly id="email"
                                value="{{ $user->email }}">
                        </div>
                        <div class="form-group row border-bottom">
                            <label for="content" class="col-form-label">お問合わせ内容</label>
                            <textarea class="col-sm-9 form-control-plaintext" rows="3" wrap="soft" readonly>{{ $user->content }}</textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection