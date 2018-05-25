@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Umowa
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Szczegóły</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">Token</div>
                            <div class="col-md-10">{{ $contract->slug }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Typ umowy</div>
                            <div class="col-md-10">{{ $contract->type()->first()->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Metoda podpisu</div>
                            <div class="col-md-10">{{ $contract->signMethod()->first()->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Email</div>
                            <div class="col-md-10">{{ $contract->email }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Podpisane</div>
                            <div class="col-md-10">
                                @if($contract->signed)
                                    <span class="label label-success">Tak</span>
                                @else
                                    <span class="label label-danger">Nie</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Numer telefonu</div>
                            <div class="col-md-10">{{ ($contract->phone ? $contract->phone : '-') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Kod SMS</div>
                            <div class="col-md-10">{{ ($contract->sms_code ? $contract->sms_code : '-') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Link</div>
                            <div class="col-md-10"><a href="{{ env('APP_URL') }}/umowa/{{ $contract->slug }}" target="_blank">{{ env('APP_URL') }}/umowa/{{ $contract->slug }}</a></div>
                        </div>
                    </div>
                </div>
                @if($contract->client()->first())
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Klient</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">Nazwa</div>
                                <div class="col-md-10">{{ $contract->client()->first()->company }}</div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Wyślij email</h3>
                    </div>
                    <div class="box-body">
                        <form action="/contract/{{ $contract->id }}/send" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" value="{{ $contract->email }}">
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Wyślij</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formularz</h3>
                    </div>
                    <div class="box-body">
                        @foreach($contractFieldsDisplay as $field)
                            <div class="row">
                                <div class="col-md-2">{{ $field['placeholder'] }}</div>
                                <div class="col-md-10">{{ $field['value'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection