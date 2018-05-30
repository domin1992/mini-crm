@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edycja</h3>
    </div>
    <form class="form-horizontal" action="/hosting/{{ $hosting->id }}" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="client_id" class="col-sm-2 control-label">Klient *</label>
          <div class="col-sm-10">
            <select class="form-control" name="client_id" id="client_id">
              @foreach(App\Client::all() as $client)
                <option value="{{ $client->id }}" @if($hosting->client_id == $client->id) selected="selected" @endif>{{ $client->company }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Adres e-mail</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ $hosting->email }}">
            </div>
        </div>
        <div class="form-group">
          <label for="account_name" class="col-sm-2 control-label">Nazwa konta</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="account_name" name="account_name" value="{{ $hosting->account_name }}">
          </div>
        </div>
        <div class="form-group">
          <label for="package" class="col-sm-2 control-label">Pakiet *</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="package" name="package" value="{{ $hosting->package }}">
          </div>
        </div>
        <div class="form-group">
          <label for="package_slug" class="col-sm-2 control-label">Pakiet nazwa upr. *</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="package_slug" name="package_slug" value="{{ $hosting->package_slug }}">
          </div>
        </div>
        <div class="form-group">
          <label for="start_date" class="col-sm-2 control-label">Data rozpoczęcia *</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="start_date" name="start_date" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $hosting->start_date)->format('Y-m-d') }}">
          </div>
        </div>
        <div class="bootstrap-timepicker">
          <div class="form-group">
            <label for="start_time" class="col-sm-2 control-label">Godzina rozpoczęcia *</label>
            <div class="col-sm-10">
              <input type="text" class="form-control timepicker" id="start_time" name="start_time" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $hosting->start_date)->format('H:i:s') }}">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="price_tax_excl" class="col-sm-2 control-label">Cena *</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="price_tax_excl" name="price_tax_excl" value="{{ $hosting->price_tax_excl }}">
          </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="finishing" name="finishing"{{ (!$hosting->finishing ? ' checked' : '') }}> Aktywne
                    </label>
                </div>
            </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/hosting/{{ $hosting->id }}" class="btn btn-block btn-default">Wstecz</a>
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

@section('script')
<script src="/plugins/select2/select2.min.js"></script>
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/plugins/datepicker/locales/bootstrap-datepicker.pl.js"></script>
<script src="/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
  $('#start_date').datepicker({
    language: 'pl',
    defaultViewDate: 'today',
    todayBtn: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
    autoclose: true,
  });
  $("#start_time").timepicker({
    showInputs: false,
    template: 'dropdown',
    showMeridian: false
  });
</script>
@endsection