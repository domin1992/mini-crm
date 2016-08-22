@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dodaj nowy adres</h3>
    </div>
    <form class="form-horizontal" action="/address" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nazwa <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
          </div>
        </div>
        <div class="form-group">
          <label for="street" class="col-sm-2 control-label">Ulica <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="street" name="street">
          </div>
        </div>
        <div class="form-group">
          <label for="street_number" class="col-sm-2 control-label">Numer ulicy <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="street_number" name="street_number">
          </div>
        </div>
        <div class="form-group">
          <label for="apartment_number" class="col-sm-2 control-label">Numer mieszkania</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="apartment_number" name="apartment_number">
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-sm-2 control-label">Miasto <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="city" name="city">
          </div>
        </div>
        <div class="form-group">
          <label for="postcode" class="col-sm-2 control-label">Kod pocztowy <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="postcode" name="postcode">
          </div>
        </div>
        <div class="form-group">
          <label for="country" class="col-sm-2 control-label">Kraj <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="country" name="country">
          </div>
        </div>
        <div class="form-group">
          <label for="other" class="col-sm-2 control-label">Inne</label>
          <div class="col-sm-10">
            <textarea id="other" name="other" class="form-control" rows="8"></textarea>
          </div>
        </div>
        <input type="hidden" name="client_id" value="{{ Request::input('client_id') }}">
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/client/{{ Request::input('client_id') }}" class="btn btn-block btn-default">Wstecz</a>
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
