@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Rachunki</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Klient
            </th>
            <th>
              Numer rachunku
            </th>
            <th>
              Data wystawienia
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($bills as $bill)
            <tr>
              <td>
                @foreach($bill->client()->get() as $client)
                  {{ $client->company }}
                @endforeach
              </td>
              <td>
                {{ $bill->bill_number }}
              </td>
              <td>
                {{ $bill->issue_date }}
              </td>
              <td>
                <div class="btn-group">
                  <a href="/bill/{{ $bill->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    {{-- <li><a href="/bill/{{ $bill->id }}/edit">Edytuj</a></li> --}}
                    <li><a href="javascript:void(0)" class="delete-bill" data-bill="{{ $bill->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-2 pull-right">
          <a href="/bill/create" class="btn btn-block btn-info">Nowy rachunek</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('bill.partials.modal-bill-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable({
    'order': [[2, 'desc']]
  });

  $('.delete-bill').click(function(){
    $('#form-bill-delete').attr('action', '/bill/' + $(this).data('bill'));
    $('.modal-bill-delete').modal('show');
  });
</script>
@endsection
