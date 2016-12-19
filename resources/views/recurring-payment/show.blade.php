@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Płatnośc cykliczna
    </h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $recurringPayment->name }}</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-2"><strong>Klient</strong></div>
          <div class="col-md-10">
            @foreach($recurringPayment->client()->get() as $client)
              {{ $client->company }}
            @endforeach
          </div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Opis</strong></div>
          <div class="col-md-10">{{ $recurringPayment->description }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Cykl</strong></div>
          <div class="col-md-10">
            {{ $recurringPayment->period_count }}
            @if($recurringPayment->period == 1)
              @if($recurringPayment->period_count == 1) dzień @else dni @endif
            @elseif($recurringPayment->period == 2)
              @if($recurringPayment->period_count == 1) tydzień @else tygodni @endif
            @elseif($recurringPayment->period == 3)
              @if($recurringPayment->period_count == 1) miesiąc @else miesięcy @endif
            @elseif($recurringPayment->period == 4)
              @if($recurringPayment->period_count == 1) rok @else lata @endif
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Data rozpoczęcia</strong></div>
          <div class="col-md-10">{{ $recurringPayment->period_start }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Data zakończenia</strong></div>
          <div class="col-md-10">{{ $recurringPayment->period_end }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Cena</strong></div>
          <div class="col-md-10">{{ number_format($recurringPayment->price, 2, ',', ' ') }} zł</div>
        </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/recurring-payment" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1">
            <a href="/recurring-payment/{{ $recurringPayment->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
          </div>
          <div class="col-md-1">
            <a href="javascript:void(0)" class="btn btn-block btn-danger delete-recurring-payment" data-recurring-payment="{{ $recurringPayment->id }}">Usuń</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('recurring-payment.partials.modal-recurring-payment-delete')
@endsection

@section('script')
<script>
  $('.delete-recurring-payment').click(function(){
    $('#form-recurring-payment-delete').attr('action', '/recurring-payment/' + $(this).data('recurring-payment'));
    $('.modal-recurring-payment-delete').modal('show');
  });
</script>
@endsection