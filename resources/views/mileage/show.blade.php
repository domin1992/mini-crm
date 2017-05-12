@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Ewidencja przebiegu pojazdu
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ Carbon\Carbon::createFromDate($mileage->mileage_year, $mileage->mileage_month, null)->format('m.Y') }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"><strong>Numer rejestracyjny</strong></div>
                    <div class="col-md-10">{{ $mileage->registration_number }}</div>
                </div>
                <div class="row">
                    <div class="col-md-2"><strong>Pojemność silnika</strong></div>
                    <div class="col-md-10">{{ number_format($mileage->engine_capacity, 2, ',', ' ') }} cm<sup>3</sup></div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-1">
                        <a href="/mileage" class="btn btn-block btn-default">Wstecz</a>
                    </div>
                    <div class="col-md-1">
                        <a href="/mileage-print/{{ $mileage->id }}" class="btn btn-block btn-success">Drukuj</a>
                    </div>
                    <div class="col-md-1">
                        <a href="/mileage/{{ $mileage->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0)" class="btn btn-block btn-danger delete-mileage" data-mileage="{{ $mileage->id }}">Usuń</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Przejazdy</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Lp.</th>
                            <th>Data wyjazdu</th>
                            <th>Opis trasy (skąd-dokąd)</th>
                            <th>Cel wyjazdu</th>
                            <th>Liczba faktycznie przejechanych km</th>
                            <th>Stawka za 1 km</th>
                            <th>Wartość</th>
                            <th>Uwagi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mileage->records()->get() as $key => $record)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $record->departure }}</td>
                                <td>{{ $record->route_description }}</td>
                                <td>{{ $record->reason }}</td>
                                <td>{{ number_format($record->distance, 2, ',', ' ') }}</td>
                                <td>{{ number_format($record->rate, 4, ',', ' ') }}</td>
                                <td>{{ number_format($record->value, 2, ',', ' ') }}</td>
                                <td>{{ $record->comments }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Brak przejazdów</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-1">
                        <a href="/mileage-record/{{ $mileage->id }}" class="btn btn-block btn-info">Przejdź</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('mileage.partials.modal-mileage-delete')
@endsection

@section('script')
<script>
    $('.delete-mileage').click(function(){
        $('#form-mileage-delete').attr('action', '/mileage/' + $(this).data('mileage'));
        $('.modal-mileage-delete').modal('show');
    });
</script>
@endsection