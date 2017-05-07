@extends('layouts.print')

@section('content')
    <section class="invoice">
        <div class="row">
            <div class="col-xs-3">
                <h2>
                    Ewidencja przebiegu pojazdu
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-xs-12">
                Imię i nazwisko osoby używającej pojazd (podatnika): <strong>{{ $owner->name }}</strong><br />
                Adres zamieszkania osoby używającej pojazd (podatnika): <strong>{{ $owner->postcode }} {{ $owner->city }}, ul. {{ $owner->street }}</strong><br />
                Za miesiąc: <strong>{{ Carbon\Carbon::createFromDate($mileage->mileage_year, $mileage->mileage_month, null)->format('m.Y') }}</strong><br />
                Numer rejestracyjny pojazdu: <strong>{{ $mileage->registration_number }}</strong><br />
                Pojemność silnika: <strong>{{ number_format($mileage->engine_capacity, 2, ',', ' ') }} cm<sup>3</sup></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Lp.</th>
                            <th>Data wyjazdu</th>
                            <th>Opis trasy</th>
                            <th>Cel wyjazdu</th>
                            <th>Przejechane</th>
                            <th>Stawka za 1 km</th>
                            <th>Wartość</th>
                            <th>Podpis podatnika</th>
                            <th>Uwagi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mileage->records()->get() as $key => $mileageRecord)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $mileageRecord->departure }}</td>
                                <td>{{ $mileageRecord->route_description }}</td>
                                <td>{{ $mileageRecord->reason }}</td>
                                <td>{{ number_format($mileageRecord->distance, 2, ',', ' ') }}&nbsp;km</td>
                                <td>{{ number_format($mileageRecord->rate, 4, ',', ' ') }}&nbsp;zł</td>
                                <td>{{ number_format($mileageRecord->value, 2, ',', ' ') }}&nbsp;zł</td>
                                <td></td>
                                <td>{{ $mileageRecord->comments }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Brak przejazdów</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td><strong>Razem</strong></td>
                            <td>{{ number_format($mileage->sumDistance, 2, ',', '') }}&nbsp;km</td>
                            <td>-</td>
                            <td>{{ number_format($mileage->sumValue, 2, ',', '') }}&nbsp;zł</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection

@section('script')
@endsection