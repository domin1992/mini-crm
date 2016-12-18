@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edycja</h3>
    </div>
    <form class="form-horizontal" action="/company/{{ $company->id }}" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="company" class="col-sm-2 control-label">Nazwa</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="company" name="company" value="{{ $company->name }}">
          </div>
        </div>
        <div class="form-group">
          <label for="vat_number" class="col-sm-2 control-label">NIP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="vat_number" name="vat_number" value="{{ $company->vat_number }}">
          </div>
        </div>
        <div class="form-group">
          <label for="nbrn" class="col-sm-2 control-label">REGON</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nbrn" name="nbrn" value="{{ $company->nbrn }}">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">E-mail</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">Telefon</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $company->phone }}">
          </div>
        </div>
        <div class="form-group">
          <label for="website" class="col-sm-2 control-label">Strona www</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="website" name="website" value="{{ $company->website }}">
          </div>
        </div>
        <div class="form-group">
          <label for="postcode" class="col-sm-2 control-label">Kod pocztowy</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $company->postcode }}">
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-sm-2 control-label">Miasto</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="city" name="city" value="{{ $company->city }}">
          </div>
        </div>
        <div class="form-group">
          <label for="street" class="col-sm-2 control-label">Ulica</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="street" name="street" value="{{ $company->street }}">
          </div>
        </div>
        <div class="form-group">
          <label for="status" class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="status" name="status" value="{{ $company->status }}">
          </div>
        </div>
        <div class="form-group">
          <label for="pkd_codes" class="col-sm-2 control-label">Kody PKD</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="pkd_codes" name="pkd_codes" value="{{ $company->pkd_codes }}">
          </div>
        </div>
        <div class="form-group">
          <label for="comment" class="col-sm-2 control-label">Komentarz</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="comment" id="comment" rows="8">{{ $company->comment }}</textarea>
          </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/company/{{ $company->id }}" class="btn btn-block btn-default">Wstecz</a>
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
