@extends('layouts.master')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Ewidencja przebiegu pojazdu</h3>
        </div>
        <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            Miesiąc
                        </th>
                        <th>
                            Numer rejestracyjny
                        </th>
                        <th>
                            Pojemność silnika
                        </th>
                        <th>
                            Opcje
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mileages as $mileage)
                        <tr>
                            <td>
                                {{ Carbon\Carbon::createFromDate($mileage->mileage_year, $mileage->mileage_month, null)->format('m.Y') }}
                            </td>
                            <td>
                                {{ $mileage->registration_number }}
                            </td>
                            <td>
                                {{ number_format($mileage->engine_capacity, 2, ',', ' ') }} cm<sup>3</sup>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="/mileage/{{ $mileage->id }}" class="btn btn-info">Zobacz</a>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/mileage/{{ $mileage->id }}/edit">Edytuj</a></li>
                                        <li><a href="javascript:void(0)" class="delete-mileage" data-mileage="{{ $mileage->id }}">Usuń</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-1 pull-right">
                    <a href="/mileage/create" class="btn btn-block btn-info">Nowy</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('mileage.partials.modal-mileage-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $("#data-table").DataTable();

    $('.delete-mileage').click(function(){
        $('#form-mileage-delete').attr('action', '/mileage/' + $(this).data('mileage'));
        $('.modal-mileage-delete').modal('show');
    });
</script>
@endsection
