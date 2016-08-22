@extends('layouts.auth')

<!-- Main Content -->
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#">RESETUJ HASŁO</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Wpisz swój adres e-mail</p>

    <form action="{{ url('/password/email') }}" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        {{ csrf_field() }}
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Wyślij link do resetowania hasła</button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection
