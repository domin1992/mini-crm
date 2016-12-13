@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Firma
    </h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $company->name }}</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-2"><strong>NIP</strong></div>
          <div class="col-md-10">{{ $company->vat_number }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>REGON</strong></div>
          <div class="col-md-10">{{ $company->nbrn }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Telefon</strong></div>
          <div class="col-md-10"><a href="tel:{{ $company->phone }}">{{ $company->phone }}</a></div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>E-mail</strong></div>
          <div class="col-md-10"><a href="mailto:{{ $company->email }}">{{ $company->email }}</a></div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Strona www</strong></div>
          <div class="col-md-10"><a href="{{ $company->email }}">{{ $company->website }}</a></div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Kod pocztowy</strong></div>
          <div class="col-md-10">{{ $company->postcode }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Miasto</strong></div>
          <div class="col-md-10">{{ $company->city }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Ulica</strong></div>
          <div class="col-md-10">{{ $company->street }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Status</strong></div>
          <div class="col-md-10">{{ $company->status }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Kody PKD</strong></div>
          <div class="col-md-10">{{ $company->pkd_codes }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Komentarz</strong></div>
          <div class="col-md-10">{{ $company->comment }}</div>
        </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/company" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1">
            <a href="/company/{{ $company->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
          </div>
          <div class="col-md-1">
            <a href="javascript:void(0)" class="btn btn-block btn-danger delete-company" data-company="{{ $company->id }}">Usuń</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('company.partials.modal-company-delete')
@endsection

@section('script')
<script>
  $('.delete-company').click(function(){
    $('#form-company-delete').attr('action', '/company/' + $(this).data('company'));
    $('.modal-company-delete').modal('show');
  });
</script>
@endsection