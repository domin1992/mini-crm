@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Klienci</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Nazwa firmy
            </th>
            <th>
              NIP
            </th>
            <th>
              E-mail
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($clients as $client)
            <tr>
              <td>
                {{ $client->company }}
              </td>
              <td>
                {{ $client->nip }}
              </td>
              <td>
                {{ $client->email }}
              </td>
              <td>
                <div class="btn-group">
                  <a href="/client/{{ $client->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/client/{{ $client->id }}/edit">Edytuj</a></li>
                    <li><a href="javascript:void(0)" class="delete-client" data-client="{{ $client->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3">
                Brak klientow
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-right">
          <a href="/client/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('client.partials.modal-client-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();
  
  $('.delete-client').click(function(){
    $('#form-client-delete').attr('action', '/client/' + $(this).data('client'));
    $('.modal-client-delete').modal('show');
  });
</script>
@endsection
