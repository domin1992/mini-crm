@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edycja</h3>
    </div>
    <form class="form-horizontal" action="/employee/{{ $employee->id }}" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">Imię</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $employee->firstname }}">
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">Nazwisko</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $employee->lastname }}">
          </div>
        </div>
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Tytuł</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="{{ $employee->title }}">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Adres e-mail</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">Telefon</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}">
          </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/employee/{{ $employee->id }}" class="btn btn-block btn-default">Wstecz</a>
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
