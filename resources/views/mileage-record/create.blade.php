@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Utwórz nowy</h3>
            </div>
            <form class="form-horizontal" action="/mileage-record" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="departure" class="col-sm-2 control-label">Data wyjazdu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="departure" name="departure">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="route_description" class="col-sm-2 control-label">Opis trasy (skąd-dokąd)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="route_description" name="route_description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reason" class="col-sm-2 control-label">Cel wyjazdu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="reason" name="reason">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="distance" class="col-sm-2 control-label">Liczba faktycznie przejechanych km</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="distance" name="distance">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rate" class="col-sm-2 control-label">Stawka za 1 km</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rate" name="rate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comments" class="col-sm-2 control-label">Uwagi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="comments" name="comments">
                        </div>
                    </div>
                    <input type="hidden" name="mileage_id" value="{{ $mileage->id }}">
                    {{ csrf_field() }}
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="/mileage-record/{{ $mileage->id }}" class="btn btn-block btn-default">Wstecz</a>
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
