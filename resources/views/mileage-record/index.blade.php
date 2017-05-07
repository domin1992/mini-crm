@extends('layouts.master')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Ewidencja przebiegu pojazdu - wpisy</h3>
        </div>
        <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            Data wyjazdu
                        </th>
                        <th>
                            Opis trasy
                        </th>
                        <th>
                            Cel wyjazdu
                        </th>
                        <th>
                            Liczba faktycsznie przejechanych km
                        </th>
                        <th>
                            Stawka za 1 km
                        </th>
                        <th>
                            Wartość
                        </th>
                        <th>
                            Uwagi
                        </th>
                        <th>
                            Opcje
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($mileageRecords)
                        @foreach($mileageRecords->get() as $key => $mileageRecord)
                            <tr>
                                <td>
                                    {{ $mileageRecord->departure }}
                                </td>
                                <td>
                                    {{ $mileageRecord->route_description }}
                                </td>
                                <td>
                                    {{ $mileageRecord->reason }}
                                </td>
                                <td>
                                    {{ number_format($mileageRecord->distance, 2, ',', ' ') }}
                                </td>
                                <td>
                                    {{ number_format($mileageRecord->rate, 2, ',', ' ') }}
                                </td>
                                <td>
                                    {{ number_format($mileageRecord->value, 2, ',', ' ') }}
                                </td>
                                <td>
                                    {{ $mileageRecord->comments }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="/mileage-record/{{ $mileageRecord->id }}/edit" class="btn btn-info">Edytuj</a>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="javascript:void(0)" class="delete-mileage-record" data-mileage-record="{{ $mileageRecord->id }}">Usuń</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-1">
                    <a href="/mileage/{{ $mileage->id }}" class="btn btn-block btn-default">Wstecz</a>
                </div>
                <div class="col-md-1 pull-right">
                    <a href="/mileage-record/create/{{ $mileage->id }}" class="btn btn-block btn-info">Nowy</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('mileage-record.partials.modal-mileage-record-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $("#data-table").DataTable();

    $('.delete-mileage-record').click(function(){
        $('#form-mileage-record-delete').attr('action', '/mileage-record/' + $(this).data('mileage-record'));
        $('.modal-mileage-record-delete').modal('show');
    });
</script>
@endsection
