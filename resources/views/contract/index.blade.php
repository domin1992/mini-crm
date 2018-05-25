@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Umowy</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Token
            </th>
            <th>
              Typ umowy
            </th>
            <th>
              Klient
            </th>
            <th>
              Adres email
            </th>
            <th>
              Podpisana
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($contracts as $contract)
            <tr>
              <td>
                {{ $contract->slug }}
              </td>
              <td>
                {{ $contract->type()->first()->name }}
              </td>
              <td>
                @if($contract->client()->first() != null)
                  {{ $contract->client()->first()->company }}
                @endif
              </td>
              <td>
                {{ $contract->email }}
              </td>
              <td>
                @if($contract->signed)
                    <span class="label label-success">Tak</span>
                @else
                    <span class="label label-danger">Nie</span>
                @endif
              </td>
              <td>
                <div class="btn-group">
                  <a href="/contract/{{ $contract->id }}" class="btn btn-info">Przeglądaj</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/contract/{{ $contract->id }}">Edytuj</a></li>
                    <li><a href="javascript:void(0)" class="delete-contract" data-contract="{{ $contract->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6">
                Brak umów
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-right">
          <a href="/contract/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('contract.partials.modal-contract-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();

  $('.delete-contract').click(function(){
    $('#form-contract-delete').attr('action', '/contract/' + $(this).data('contract'));
    $('.modal-contract-delete').modal('show');
  });
</script>
@endsection