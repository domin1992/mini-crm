@extends('layouts.master')

@section('content')
<section class="content-header">
  <h1>
    Faktura
  </h1>
</section>
<section class="invoice content">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        Company name
      </h2>
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-sm-6 invoice-col">
      <b>Faktura {{ $invoice->invoice_number }}</b>
    </div>
    <div class="col-sm-6 invoice-col">
      {{ $invoice->issue_date }}, {{ $invoice->issue_city }}
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-sm-6 invoice-col">
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
    <div class="col-sm-6 invoice-col">
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
          {{--*/ $positionsValueTaxExclArray = array(); /*--}}
          {{--*/ $positionsTaxValueArray = array(); /*--}}
          {{--*/ $positionsValueTaxInclArray = array(); /*--}}
          @foreach($invoice->invoicePositions()->get() as $key => $position)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $position->name }}</td>
              <td>{{ $position->symbol_pkwiu }}</td>
              <td>{{ $position->measure_unit }}</td>
              <td>{{ $position->quantity }}</td>
              <td>{{ number_format($position->price_tax_excl, 2, ',', '') }} zł</td>
              <td>{{ number_format($position->price_tax_excl * $position->quantity, 2, ',', '') }} zł</td>
              {{--*/ $positionsValueTaxExclArray[] = $position->price_tax_excl * $position->quantity; /*--}}
              @foreach($position->tax()->get() as $tax)
                <td>{{ $tax->display }}</td>
                {{--*/ $positionTax = $tax->value; /*--}}
              @endforeach
              <td>{{ number_format($positionTax * ($position->price_tax_excl * $position->quantity), 2, ',', '') }} zł</td>
              {{--*/ $positionsTaxValueArray[] = $positionTax * ($position->price_tax_excl * $position->quantity); /*--}}
              <td>{{ number_format($positionTax * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity), 2, ',', '') }} zł</td>
              {{--*/ $positionsValueTaxInclArray[] = $positionTax * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity); /*--}}
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5"></td>
            <td><strong>Razem</strong></td>
            <td>{{ number_format(array_sum($positionsValueTaxExclArray), 2, ',', '') }} zł</td>
            <td>-</td>
            <td>{{ number_format(array_sum($positionsTaxValueArray), 2, ',', '') }} zł</td>
            <td>{{ number_format(array_sum($positionsValueTaxInclArray), 2, ',', '') }} zł</td>
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
  <div class="row no-print">
    <div class="col-xs-12">
      <a href="/invoice-print/{{ $invoice->id }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
      {{-- <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> --}}
    </div>
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