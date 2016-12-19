@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dodaj nową</h3>
    </div>
    <form class="form-horizontal" action="/recurring-payment" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nazwa</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
          </div>
        </div>
        <div class="form-group">
          <label for="client_id" class="col-sm-2 control-label">Klient</label>
          <div class="col-sm-10">
            <select class="form-control" name="client_id" id="client_id">
              <option value="0" selected="selected">Wybierz</option>
              @foreach(App\Client::all() as $client)
                <option value="{{ $client->id }}">{{ $client->company }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-sm-2 control-label">Opis</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="period_count" class="col-sm-2 control-label">Cykl ilość</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="period_count" name="period_count">
          </div>
        </div>
        <div class="form-group">
          <label for="period" class="col-sm-2 control-label">Cykl</label>
          <div class="col-sm-10">
            <select class="form-control" name="period" id="period">
              <option value="0" selected="selected">Wybierz</option>
              <option value="1">Dzień</option>
              <option value="2">Tydzień</option>
              <option value="3">Miesiąc</option>
              <option value="4">Rok</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="period_start_date" class="col-sm-2 control-label">Data rozpoczęcia</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="period_start_date" name="period_start_date">
          </div>
        </div>
        <div class="bootstrap-timepicker">
          <div class="form-group">
            <label for="period_start_time" class="col-sm-2 control-label">Godzina rozpoczęcia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control timepicker" id="period_start_time" name="period_start_time">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="price" class="col-sm-2 control-label">Cena</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="price" name="price">
          </div>
        </div>
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/recurring-payment" class="btn btn-block btn-default">Wstecz</a>
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
  $('#period_start_date').datepicker({
    language: 'pl',
    defaultViewDate: 'today',
    todayBtn: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
    autoclose: true,
  });
  $("#period_start_time").timepicker({
    showInputs: false,
    template: 'dropdown',
    showMeridian: false
  });
</script>
@endsection