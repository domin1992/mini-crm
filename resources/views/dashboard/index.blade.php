@extends('layouts.master')

@section('content')
<section class="content-header">
  <h1>
    Pulpit
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-person-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Klienci</span>
          <span class="info-box-number">{{ $statistics['clients'] }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pracownicy</span>
          <span class="info-box-number">{{ $statistics['employees'] }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-paper-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Faktury</span>
          <span class="info-box-number">{{ $statistics['invoices'] }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-world-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Firmy</span>
          <span class="info-box-number">{{ $statistics['companies'] }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-card"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Płatności cykliczne</span>
          <span class="info-box-number">{{ $statistics['recurringPayments'] }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-body"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Użytkownicy</span>
          <span class="info-box-number">{{ $statistics['users'] }}</span>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
