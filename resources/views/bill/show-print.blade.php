@extends('layouts.print')

@section('content')
<section class="bill">
  <div class="row">
    <div class="col-xs-3">
      <h2>
          <img src="/img/logo.png" class="img-responsive" alt="">
      </h2>
    </div>
  </div>
  <div class="row bill-info">
    <div class="col-xs-6">
      <b>
        Rachunek {{ $bill->bill_number }}
      </b>
    </div>
    <div class="col-xs-6">
      {{ $bill->issue_date }}, {{ $bill->issue_city }}
    </div>
  </div>
  <div class="row bill-info">
    <div class="col-xs-6">
      <strong>Sprzedawca</strong>
      <address>
        {{ $owner->name }}<br>
        NIP: {{ $owner->vat_number }}<br>
        ul. {{ $owner->street }}<br>
        {{ $owner->postcode }} {{ $owner->city }}<br>
        Tel: {{ $owner->phone }}<br>
        Email: {{ $owner->email }}
      </address>
    </div>
    <div class="col-xs-6">
      <strong>Nabywca</strong>
        <address>
          @foreach($bill->client()->get() as $client)
            {{ $client->company }}<br>
          @endforeach
          @foreach($bill->address()->get() as $address)
            {{ $address->street }} {{ $address->street_number }}
            @if($address->apartment_number)
              m. {{ $address->apartment_number }}
            @endif
          <br>
          {{ $address->postcode }} {{ $address->city }}<br>
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
            <th>Ilość</th>
            <th>JM</th>
            <th>Cena netto</th>
            <th>Wartość netto</th>
            <th>Stawka VAT</th>
            <th>Kwota VAT</th>
            <th>Wartość z&nbsp;VAT</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bill->billPositions()->get() as $key => $position)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $position->name }}</td>
              <td>{{ $position->quantity }}</td>
              <td>{{ $position->measure_unit }}</td>
              <td>{{ number_format($position->price_tax_excl, 2, ',', '') }}&nbsp;zł</td>
              <td>{{ number_format($position->price_tax_excl * $position->quantity, 2, ',', '') }}&nbsp;zł</td>
              @foreach($position->tax()->get() as $tax)
                <td>{{ $tax->display }}</td>
                <td>{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity), 2, ',', '') }}&nbsp;zł</td>
                <td>{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity), 2, ',', '') }}&nbsp;zł</td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td><strong>Razem</strong></td>
            <td>{{ number_format($bill->sumPositionsValueTaxExcl, 2, ',', '') }}&nbsp;zł</td>
            <td>-</td>
            <td>{{ number_format($bill->sumPositionsTaxValue, 2, ',', '') }}&nbsp;zł</td>
            <td>{{ number_format($bill->sumPositionsValueTaxIncl, 2, ',', '') }}&nbsp;zł</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <p class="lead">Do zapłaty:</p>
      <p class="lead-bottom">{{ number_format($bill->sumPositionsValueTaxIncl, 2, ',', '') }} zł</p>
      <p class="lead">Data sprzedaży:</p>
      <p class="lead-bottom">{{ $bill->sell_date }}</p>
      @if($bill->payment_method == 0)
        <p class="lead">Zapłacono przelewem</p>
      @elseif($bill->payment_method == 1)
        <p class="lead">Zapłacono gotówką</p>
      @elseif($bill->payment_method == 2)
        <p class="lead">Zapłacono przez PayU</p>
      @endif
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