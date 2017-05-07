@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edycja</h3>
            </div>
            <form class="form-horizontal" action="/mileage/{{ $mileage->id }}" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="mileage_month" class="col-sm-2 control-label">Miesiąc</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="mileage_month" name="mileage_month">
                                <option value="1"{{ ($mileage->mileage_month == 1 ? ' selected="selected"' : '') }}>Styczeń</option>
                                <option value="2"{{ ($mileage->mileage_month == 2 ? ' selected="selected"' : '') }}>Luty</option>
                                <option value="3"{{ ($mileage->mileage_month == 3 ? ' selected="selected"' : '') }}>Marzec</option>
                                <option value="4"{{ ($mileage->mileage_month == 4 ? ' selected="selected"' : '') }}>Kwiecień</option>
                                <option value="5"{{ ($mileage->mileage_month == 5 ? ' selected="selected"' : '') }}>Maj</option>
                                <option value="6"{{ ($mileage->mileage_month == 6 ? ' selected="selected"' : '') }}>Czerwiec</option>
                                <option value="7"{{ ($mileage->mileage_month == 7 ? ' selected="selected"' : '') }}>Lipiec</option>
                                <option value="8"{{ ($mileage->mileage_month == 8 ? ' selected="selected"' : '') }}>Sierpień</option>
                                <option value="9"{{ ($mileage->mileage_month == 9 ? ' selected="selected"' : '') }}>Wrzesień</option>
                                <option value="10"{{ ($mileage->mileage_month == 10 ? ' selected="selected"' : '') }}>Październik</option>
                                <option value="11"{{ ($mileage->mileage_month == 11 ? ' selected="selected"' : '') }}>Listopad</option>
                                <option value="12"{{ ($mileage->mileage_month == 12 ? ' selected="selected"' : '') }}>Grudzień</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mileage_year" class="col-sm-2 control-label">Rok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mileage_year" name="mileage_year" value="{{ $mileage->mileage_year }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registration_number" class="col-sm-2 control-label">Numer rejestracyjny</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ $mileage->registration_number }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="engine_capacity" class="col-sm-2 control-label">Pojemność silnika</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="engine_capacity" name="engine_capacity" value="{{ $mileage->engine_capacity }}">
                        </div>
                    </div>
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="/mileage/{{ $mileage->id }}" class="btn btn-block btn-default">Wstecz</a>
                        </div>
                        <div class="col-md-1 col-md-offset-10">
                            <button type="submit" class="btn btn-block btn-success">Zapisz</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
