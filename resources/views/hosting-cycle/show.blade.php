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
                      {{-- <div class="row">
                      <div class="col-md-2"><strong>Cykl</strong></div>
                      <div class="col-md-10">
                      {{ $hosting->period_count }}

  </div>
</div> --}}
<div class="row">
    <div class="col-md-3"><strong>Data rozpoczęcia</strong></div>
    <div class="col-md-9">{{ $hosting->start_date }}</div>
</div>
{{-- <div class="row">
<div class="col-md-2"><strong>Data zakończenia</strong></div>
<div class="col-md-10">{{ $hosting->period_end }}</div>
</div> --}}
<div class="row">
    <div class="col-md-3"><strong>Cena</strong></div>
    <div class="col-md-9">{{ number_format($hosting->price_tax_excl, 2, ',', ' ') }} zł</div>
</div>
</div>
<div class="box-footer">
        <a href="/hosting" class="btn btn-default">Wstecz</a>
        <a href="/hosting/{{ $hosting->id }}/edit" class="btn btn-info">Edytuj</a>
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
                                                            <form id="unpaid-form" action="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/unpaid" method="post" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                            <a href="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/unpaid" onclick="event.preventDefault(); document.getElementById('unpaid-form').submit();">Nie zapłacono</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <form id="paid-form" action="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/paid" method="post" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                            <a href="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/paid" onclick="event.preventDefault(); document.getElementById('paid-form').submit();">Zapłacono</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <form id="delete-form" action="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/destroy" method="post">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            {{ csrf_field() }}
                                                        </form>
                                                        <a href="/hosting/{{ $hosting->id }}/cycle/{{ $hostingCycle->id }}/destroy" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Usuń</a>
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