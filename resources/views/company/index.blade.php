@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Firmy</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Nazwa
            </th>
            <th>
              NIP
            </th>
            <th>
              E-mail
            </th>
            <th>
              Telefon
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($companies as $company)
            <tr>
              <td>
                {{ $company->name }}
              </td>
              <td>
                {{ $company->vat_number }}
              </td>
              <td>
                {{ $company->email }}
              </td>
              <td>
                {{ $company->phone }}
              </td>
              <td>
                <div class="btn-group">
                  <a href="/company/{{ $company->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/company/{{ $company->id }}/edit">Edytuj</a></li>
                    <li><a href="javascript:void(0)" class="delete-company" data-company="{{ $company->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">
                Brak firm
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-left">
          <a href="/company-export" class="btn btn-block btn-info">Export</a>
        </div>
        <div class="col-md-1 pull-right">
          <a href="/company/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('company.partials.modal-company-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();

  $('.delete-company').click(function(){
    $('#form-company-delete').attr('action', '/company/' + $(this).data('company'));
    $('.modal-company-delete').modal('show');
  });
</script>
@endsection
