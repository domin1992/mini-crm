@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Faktury</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Klient
            </th>
            <th>
              Numer faktury
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
          @forelse($invoices as $invoice)
            <tr>
              <td>
                @foreach($invoice->client()->get() as $client)
                  {{ $client->company }}
                @endforeach
              </td>
              <td>
                {{ $invoice->invoice_number }}
              </td>
              <td>
                {{ $invoice->issue_date }}
              </td>
              <td>
                <div class="btn-group">
                  <a href="/invoice/{{ $invoice->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/invoice/{{ $invoice->id }}/edit">Edytuj</a></li>
                    <li><a href="javascript:void(0)" class="delete-invoice" data-invoice="{{ $invoice->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3">
                Brak faktur
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-right">
          <a href="/invoice/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('invoice.partials.modal-invoice-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();

  $('.delete-invoice').click(function(){
    $('#form-invoice-delete').attr('action', '/invoice/' + $(this).data('invoice'));
    $('.modal-invoice-delete').modal('show');
  });
</script>
@endsection
