@extends('layouts.auth')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#">MANAGER</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Zaloguj się</p>

    <form action="{{ url('/login') }}" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Zapamiętaj mnie
            </label>
          </div>
        </div>
        {{ csrf_field() }}
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Zaloguj</button>
        </div>
      </div>
    </form>

    <a href="{{ url('/password/reset') }}">Zapomniałem hasła</a><br>

  </div>
</div>
@endsection
