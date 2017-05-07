@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Utwórz nowy</h3>
            </div>
            <form class="form-horizontal" action="/mileage" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="mileage_month" class="col-sm-2 control-label">Miesiąc</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="mileage_month" name="mileage_month">
                                <option value="1">Styczeń</option>
                                <option value="2">Luty</option>
                                <option value="3">Marzec</option>
                                <option value="4">Kwiecień</option>
                                <option value="5">Maj</option>
                                <option value="6">Czerwiec</option>
                                <option value="7">Lipiec</option>
                                <option value="8">Sierpień</option>
                                <option value="9">Wrzesień</option>
                                <option value="10">Październik</option>
                                <option value="11">Listopad</option>
                                <option value="12">Grudzień</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mileage_year" class="col-sm-2 control-label">Rok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mileage_year" name="mileage_year">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registration_number" class="col-sm-2 control-label">Numer rejestracyjny</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="registration_number" name="registration_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="engine_capacity" class="col-sm-2 control-label">Pojemność silnika</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="engine_capacity" name="engine_capacity">
                        </div>
                    </div>
                    {{ csrf_field() }}
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="/mileage" class="btn btn-block btn-default">Wstecz</a>
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
