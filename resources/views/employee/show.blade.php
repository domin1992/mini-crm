@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Pracownik
    </h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $employee->firstname }} {{ $employee->lastname }} ({{ $employee->title }})</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-2"><strong>Adres e-mail</strong></div>
          <div class="col-md-10"><a href="{{ $employee->email }}">{{ $employee->email }}</a></div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Telefon</strong></div>
          <div class="col-md-10">{{ $employee->phone }}</div>
        </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/employee" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1 col-md-offset-9">
            <a href="/employee/{{ $employee->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
          </div>
          <div class="col-md-1">
            <a href="javascript:void(0)" class="btn btn-block btn-danger delete-employee" data-employee="{{ $employee->id }}">Usuń</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('employee.partials.modal-employee-delete')
@endsection

@section('script')
<script>
  $('.delete-employee').click(function(){
    $('#form-employee-delete').attr('action', '/employee/' + $(this).data('employee'));
    $('.modal-employee-delete').modal('show');
  });
</script>
@endsection