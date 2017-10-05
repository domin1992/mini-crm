@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Rachunek
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Rachunek {{ $bill->bill_number }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3 col-md-2">Miejsce wystawienia</div>
                    <div class="col-sm-9 col-md-10">{{ $bill->issue_city }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-2">Data wystawienia</div>
                    <div class="col-sm-9 col-md-10">{{ $bill->issue_date }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-2">Data sprzedaży</div>
                    <div class="col-sm-9 col-md-10">{{ $bill->sell_date }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-2">Metoda płatności</div>
                    <div class="col-sm-9 col-md-10">{{ $bill->paymentMethod()->first()->name }}{{ ($bill->paid ? ' (zapłacono)' : '') }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-2">Do zapłaty</div>
                    <div class="col-sm-9 col-md-10">{{ number_format($bill->sumPositionsValueTaxIncl, 2, ',', ' ') }} zł</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-2">Nabywca</div>
                    <div class="col-sm-9 col-md-10">
                        @foreach($bill->client()->get() as $client)
                            {{ $client->company }}<br>
                        @endforeach
                        @foreach($bill->address()->get() as $address)
                            {{ $address->street }}<br>
                            {{ $address->postcode }} {{ $address->city }}<br>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="/bill-print/{{ $bill->id }}" class="btn btn-info pull-right">Drukuj</a>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pozycje</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table">
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
                                <td>{{ number_format($position->price_tax_excl, 2, ',', ' ') }} zł</td>
                                <td>{{ number_format($position->price_tax_excl * $position->quantity, 2, ',', ' ') }} zł</td>
                                @foreach($position->tax()->get() as $tax)
                                    <td>{{ $tax->display }}</td>
                                    <td>{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity), 2, ',', ' ') }} zł</td>
                                    <td>{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity), 2, ',', ' ') }} zł</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td><strong>Razem</strong></td>
                            <td>{{ number_format($bill->sumPositionsValueTaxExcl, 2, ',', ' ') }} zł</td>
                            <td>-</td>
                            <td>{{ number_format($bill->sumPositionsTaxValue, 2, ',', ' ') }} zł</td>
                            <td>{{ number_format($bill->sumPositionsValueTaxIncl, 2, ',', ' ') }} zł</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Wyślij na adres e-mail</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="/bill-send/{{ $bill->id }}" method="post">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Adres e-mail</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        {{ csrf_field() }}
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Wyślij</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection