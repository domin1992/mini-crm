@extends('layouts.auth')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#">RESETUJ HASŁO</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Ustaw nowe hasło</p>

    <form action="{{ url('/password/reset') }}" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Adres e-mail">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Hasło">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Potwierdź hasło">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Resetuj hasło</button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection
