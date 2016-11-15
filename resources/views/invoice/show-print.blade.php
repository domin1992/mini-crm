@extends('layouts.print')

@section('content')
<section class="invoice">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        Company name
      </h2>
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-xs-6">
      <b>Faktura {{ $invoice->invoice_number }}</b>
    </div>
    <div class="col-xs-6">
      {{ $invoice->issue_date }}, {{ $invoice->issue_city }}
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-xs-6">
      <strong>Sprzedawca</strong>
      <address>
        Comapny name<br>
        NIP: 7894561230<br>
        ul. Wysokińskiego 92<br>
        91-555 Łódź<br>
        Polska<br>
        Tel: +48 999 999 999<br>
        Email: test@test.com
      </address>
    </div>
    <div class="col-xs-6">
      <strong>Nabywca</strong>
        <address>
          @foreach($invoice->client()->get() as $client)
            {{ $client->company }}<br>
            NIP: {{ $client->nip }}<br>
          @endforeach
          @foreach($invoice->address()->get() as $address)
            ul. {{ $address->street }} {{ $address->street_number }}
            @if($address->apartment_number)
              m. {{ $address->apartment_number }}
            @endif
          <br>
          {{ $address->postcode }} {{ $address->city }}<br>
          {{ $address->country }}<br>
          @endforeach
        </address>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>L.p.</th>
            <th>Nazwa towaru/usługi</th>
            <th>Symbol PKWiU</th>
            <th>J.M.</th>
            <th>Ilość</th>
            <th>Cena netto</th>
            <th>Wartość netto</th>
            <th>Stawka VAT</th>
            <th>Kwota VAT</th>
            <th>Wartość z VAT</th>
          </tr>
        </thead>
        <tbody>
          @foreach($invoice->invoicePositions()->get() as $key => $position)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $position->name }}</td>
              <td>{{ $position->symbol_pkwiu }}</td>
              <td>{{ $position->measure_unit }}</td>
              <td>{{ $position->quantity }}</td>
              <td>{{ number_format($position->price_tax_excl, 2, ',', '') }} zł</td>
              <td>{{ number_format($position->price_tax_excl * $position->quantity, 2, ',', '') }} zł</td>
              @foreach($position->tax()->get() as $tax)
                <td>{{ $tax->display }}</td>
                <td>{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity), 2, ',', '') }} zł</td>
                <td>{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity), 2, ',', '') }} zł</td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5"></td>
            <td><strong>Razem</strong></td>
            <td>{{ number_format($invoice->sumPositionsValueTaxExcl, 2, ',', '') }} zł</td>
            <td>-</td>
            <td>{{ number_format($invoice->sumPositionsTaxValue, 2, ',', '') }} zł</td>
            <td>{{ number_format($invoice->sumPositionsValueTaxIncl, 2, ',', '') }} zł</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <p class="lead">Fakturę wystawił</p>
      <p>
        John Doe
      </p>
    </div>
    @if($invoice->comment)
      <div class="col-xs-6">
        <p class="lead">Uwagi</p>
        <p>{{ $invoice->comment }}</p>
      </div>
    @endif
  </div>
</section>
<div class="clearfix"></div>
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