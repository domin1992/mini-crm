@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edycja</h3>
    </div>
    <form class="form-horizontal" action="/client/{{ $client->id }}" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="company" class="col-sm-2 control-label">Nazwa firmy</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="company" name="company" value="{{ $client->company }}">
          </div>
        </div>
        <div class="form-group">
          <label for="nip" class="col-sm-2 control-label">NIP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nip" name="nip" value="{{ $client->nip }}">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">E-mail</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}">
          </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/client/{{ $client->id }}" class="btn btn-block btn-default">Wstecz</a>
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
