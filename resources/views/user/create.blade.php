@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dodaj nowy</h3>
    </div>
    <form class="form-horizontal" action="/user" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">Imię</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname">
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">Nazwisko</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">E-mail</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Hasło</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10 col-md-offset-2">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="admin" name="admin"> Admin
              </label>
            </div>
          </div>
        </div>
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/user" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1 col-md-offset-10">
            <button type="submit" class="btn btn-block btn-success">Zapisz</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection
