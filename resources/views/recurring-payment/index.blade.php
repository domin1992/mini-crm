@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Płatności cykliczne</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Nazwa
            </th>
            <th>
              Firma
            </th>
            <th>
              Data zakończenia
            </th>
            <th>
              Cena
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($recurringPayments as $recurringPayment)
            <tr>
              <td>
                {{ $recurringPayment->name }}
              </td>
              <td>
                @foreach($recurringPayment->client()->get() as $client)
                  {{ $client->company }}
                @endforeach
              </td>
              <td>
                {{ $recurringPayment->period_end }}
              </td>
              <td>
                {{ number_format($recurringPayment->price, 2, ',', ' ') }} zł
              </td>
              <td>
                <div class="btn-group">
                  <a href="/recurring-payment/{{ $recurringPayment->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/recurring-payment/{{ $recurringPayment->id }}/edit">Edytuj</a></li>
                    <li><a href="javascript:void(0)" class="delete-recurring-payment" data-recurring-payment="{{ $recurringPayment->id }}">Usuń</a></li>
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
          <a href="/recurring-payment/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('recurring-payment.partials.modal-recurring-payment-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();

  $('.delete-recurring-payment').click(function(){
    $('#form-recurring-payment-delete').attr('action', '/recurring-payment/' + $(this).data('recurring-payment'));
    $('.modal-recurring-payment-delete').modal('show');
  });
</script>
@endsection
