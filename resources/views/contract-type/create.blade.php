@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dodaj nowy</h3>
    </div>
    <form class="form-horizontal" action="/contract-type" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nazwa</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
          </div>
        </div>
        <div class="form-group">
          <label for="fields" class="col-sm-2 control-label">Pola</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="fields" name="fields" rows="8"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="email_content" class="col-sm-2 control-label">Treść email</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="email_content" name="email_content" rows="8"></textarea>
          </div>
        </div>
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/contract-type" class="btn btn-block btn-default">Wstecz</a>
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
