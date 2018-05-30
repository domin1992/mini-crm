@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Hosting
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
                          <div class="col-md-3"><strong>Klient</strong></div>
                          <div class="col-md-9">
                              @foreach($hosting->client()->get() as $client)
                                  {{ $client->company }}
                              @endforeach
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"><strong>Nazwa konta</strong></div>
                          <div class="col-md-9">{{ $hosting->account_name }}</div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"><strong>Adres email</strong></div>
                          <div class="col-md-9">{{ $hosting->email }}</div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"><strong>Pakiet</strong></div>
                          <div class="col-md-9">{{ $hosting->package }}</div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"><strong>Pakiet nazwa upr.</strong></div>
                          <div class="col-md-9">{{ $hosting->package_slug }}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"><strong>Data rozpoczęcia</strong></div>
                        <div class="col-md-9">{{ $hosting->start_date }}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"><strong>Cena</strong></div>
                        <div class="col-md-9">{{ number_format($hosting->price_tax_excl, 2, ',', ' ') }} zł</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"><strong>Aktywne</strong></div>
                        <div class="col-md-9">
                            @if(!$hosting->finishing)
                                <span class="label label-success">Tak</span>
                            @else
                                <span class="label label-warning">Nie</span>
                            @endif
                        </div>
                      </div>
                    </div>
                    <div class="box-footer">
                      <a href="/hosting" class="btn btn-default">Wstecz</a>
                      <a href="/hosting/{{ $hosting->id }}/edit" class="btn btn-info">Edytuj</a>
                      @if(!$hosting->finishing)
                          <form id="finish-form" action="/hosting/{{ $hosting->id }}/finish" method="post" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                          <a href="/hosting/{{ $hosting->id }}/finish" class="btn btn-warning" onclick="event.preventDefault(); document.getElementById('finish-form').submit();">Deaktywuj</a>
                      @else
                          <form id="unfinish-form" action="/hosting/{{ $hosting->id }}/unfinish" method="post" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                          <a href="/hosting/{{ $hosting->id }}/unfinish" class="btn btn-warning" onclick="event.preventDefault(); document.getElementById('unfinish-form').submit();">Aktywuj</a>
                      @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Historia</h3>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Start</th>
                                    <th>Koniec</th>
                                    <th>Okres</th>
                                    <th>Zapłacono</th>
                                    <th>Cena netto</th>
                                    <th>Opcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hosting->cycle()->get() as $hostingCycle)
                                    <tr>
                                        <td>{{ $hostingCycle->start_date }}</td>
                                        <td>{{ $hostingCycle->end_date }}</td>
                                        <td>
                                            {{ $hostingCycle->period_count }}
                                            @if($hostingCycle->period == 1)
                                                @if($hostingCycle->period_count == 1) dzień @else dni @endif
                                            @elseif($hostingCycle->period == 2)
                                                @if($hostingCycle->period_count == 1) tydzień @else tygodni @endif
                                            @elseif($hostingCycle->period == 3)
                                                @if($hostingCycle->period_count == 1) miesiąc @else miesięcy @endif
                                            @elseif($hostingCycle->period == 4)
                                                @if($hostingCycle->period_count == 1) rok @else lata @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($hostingCycle->paid)
                                                <span class="label label-success">Tak</span>
                                            @else
                                                <span class="label label-warning">Nie</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($hostingCycle->price_tax_excl, 2, ',', ' ') }} zł</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/edit" class="btn btn-info">Edytuj</a>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @if($hostingCycle->paid)
                                                        <li>
                                                            <form id="unpaid-form-{{ $hostingCycle->id }}" action="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/unpaid" method="post" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                            <a href="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/unpaid" onclick="event.preventDefault(); document.getElementById('unpaid-form-{{ $hostingCycle->id }}').submit();">Nie zapłacono</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <form id="paid-form-{{ $hostingCycle->id }}" action="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/paid" method="post" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                            <a href="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/paid" onclick="event.preventDefault(); document.getElementById('paid-form-{{ $hostingCycle->id }}').submit();">Zapłacono</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <form id="delete-form-{{ $hostingCycle->id }}" action="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/destroy" method="post">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            {{ csrf_field() }}
                                                        </form>
                                                        <a href="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/destroy" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $hostingCycle->id }}').submit();">Usuń</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="/hosting/{{ $hosting->id }}/cycle/create" class="btn btn-info pull-right">Nowy</a>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </section>
@endsection

@section('script')
@endsection