@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Typy umów</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Nazwa
            </th>
            <th>
              Nazwa upr.
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($contractTypes as $contractType)
            <tr>
              <td>
                {{ $contractType->name }}
              </td>
              <td>
                {{ $contractType->slug }}
              </td>
              <td>
                <div class="btn-group">
                  <a href="/contract-type/{{ $contractType->id }}" class="btn btn-info">Edytuj</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" class="delete-contract-type" data-contract-type="{{ $contractType->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4">
                Brak typów umów
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-right">
          <a href="/contract-type/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('contract-type.partials.modal-contract-type-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();

  $('.delete-contract-type').click(function(){
    $('#form-contract-type-delete').attr('action', '/contract-type/' + $(this).data('contract-type'));
    $('.modal-contract-type-delete').modal('show');
  });
</script>
@endsection
