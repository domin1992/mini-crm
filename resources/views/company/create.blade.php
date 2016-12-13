@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dodaj nowy</h3>
    </div>
    <form action="/company" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
            <p>Wybierz plik XML z Datastore</p>
        </div>
        <div class="form-group">
          <label for="xml">Plik XML</label>
          <input type="file" id="xml" name="xml">
        </div>
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/company" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1 col-md-offset-10">
            <button type="submit" class="btn btn-block btn-success">Wyślij</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection
