@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edycja adresu</h3>
    </div>
    <form class="form-horizontal" action="/address/{{ $address->id }}" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nazwa <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $address->name }}">
          </div>
        </div>
        <div class="form-group">
          <label for="street" class="col-sm-2 control-label">Ulica <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="street" name="street" value="{{ $address->street }}">
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-sm-2 control-label">Miasto <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="city" name="city" value="{{ $address->city }}">
          </div>
        </div>
        <div class="form-group">
          <label for="postcode" class="col-sm-2 control-label">Kod pocztowy <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $address->postcode }}">
          </div>
        </div>
        <div class="form-group">
          <label for="country" class="col-sm-2 control-label">Kraj <span class="required">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="country" name="country" value="{{ $address->country }}">
          </div>
        </div>
        <div class="form-group">
          <label for="other" class="col-sm-2 control-label">Inne</label>
          <div class="col-sm-10">
            <textarea id="other" name="other" class="form-control" rows="8" value="{{ $address->other }}"></textarea>
          </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="client_id" value="{{ $address->client_id }}">
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/client/{{ $address->id }}" class="btn btn-block btn-default">Wstecz</a>
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
