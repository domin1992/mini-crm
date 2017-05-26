@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Faktura
        </h1>
    </section>
    <section class="invoice content">
        <div class="row">
            <div class="col-xs-2">
                <h2>
                    <img src="/img/logo.png" class="img-responsive" alt="">
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <b>
                Faktura&nbsp;
                @if($invoice->advance)
                    zaliczkowa&nbsp;
                @endif
                {{ $invoice->invoice_number }}
                </b>
            </div>
            <div class="col-sm-6 invoice-col">
                {{ $invoice->issue_date }}, {{ $invoice->issue_city }}
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
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
            <div class="col-sm-6 invoice-col">
                <strong>Nabywca</strong>
                <address>
                    @foreach($invoice->client()->get() as $client)
                        {{ $client->company }}<br>
                        NIP: {{ $client->nip }}<br>
                    @endforeach
                    @foreach($invoice->address()->get() as $address)
                        {{ $address->street }}<br>
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
                        @foreach($invoice->invoicePositions()->get() as $key => $position)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->quantity }}</td>
                                <td>{{ $position->measure_unit }}</td>
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
                            <td colspan="4"></td>
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
                <p class="lead">Do zapłaty:</p>
                <p class="lead-bottom">{{ number_format($invoice->sumPositionsValueTaxIncl, 2, ',', '') }} zł</p>
                <p class="lead">Termin płatności:</p>
                <p class="lead-bottom">{{ $invoice->payment_date }}</p>
                @if($invoice->paymentMethod()->first()->module_name == 'bank_transfer')
                    <p class="lead">Płatność przelewem{{ ($invoice->paid ? ' (zapłacono)' : ':') }}</p>
                    @if(!$invoice->paid)
                        <p class="lead-bottom">
                            {{ $owner->name }}<br />
                            {{ $owner->bank_account_number }}<br />
                            ({{ $owner->bank_name }})<br />
                            W tytule przelewu prosimy wpisać numer faktury <strong>{{ $invoice->invoice_number }}</strong>
                        </p>
                    @endif
                @elseif($invoice->paymentMethod()->first()->module_name == 'cash')
                    <p class="lead">Płatność gotówką{{ ($invoice->paid ? ' (zapłacono)' : '') }}</p>
                @elseif($invoice->paymentMethod()->first()->module_name == 'payu')
                    <p class="lead">PayU{{ ($invoice->paid ? ' (zapłacono)' : '') }}</p>
                @endif
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