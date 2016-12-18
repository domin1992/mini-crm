@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Klient
    </h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $client->company }}</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-2"><strong>NIP</strong></div>
          <div class="col-md-10">{{ $client->nip }}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>E-mail</strong></div>
          <div class="col-md-10"><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></div>
        </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/client" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1 col-md-offset-7">
            <a href="/address/create?client_id={{ $client->id }}" class="btn btn-block btn-success">Dodaj adres</a>
          </div>
          <div class="col-md-1">
            <a href="/contact/create?client_id={{ $client->id }}" class="btn btn-block btn-success">Dodaj kontakt</a>
          </div>
          <div class="col-md-1">
            <a href="/client/{{ $client->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
          </div>
          <div class="col-md-1">
            <a href="javascript:void(0)" class="btn btn-block btn-danger delete-client" data-client="{{ $client->id }}">Usuń</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @if($client->addresses()->get()->count() > 0)
    <section class="content-header">
      <h1>
        Adresy
      </h1>
    </section>
    <section class="content">
      <div class="row">
        @foreach($client->addresses()->get() as $address)
          <div class="col-md-6">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">{{ $address->name }}</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2"><strong>Ulica</strong></div>
                  <div class="col-md-10">
                    {{ $address->street }}&nbsp;{{ $address->street_number }}
                    @if($address->apartment_number != '')
                      m. {{ $address->apartment_number }}
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2"><strong>Miasto</strong></div>
                  <div class="col-md-10">{{ $address->city }}</div>
                </div>
                <div class="row">
                  <div class="col-md-2"><strong>Kod pocztowy</strong></div>
                  <div class="col-md-10">{{ $address->postcode }}</div>
                </div>
                <div class="row">
                  <div class="col-md-2"><strong>Kraj</strong></div>
                  <div class="col-md-10">{{ $address->country }}</div>
                </div>
                <div class="row">
                  <div class="col-md-2"><strong>Inne</strong></div>
                  <div class="col-md-10">{{ $address->other }}</div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2 col-md-offset-8">
                    <a href="/address/{{ $address->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
                  </div>
                  <div class="col-md-2">
                    <a href="javascript:void(0)" class="btn btn-block btn-danger delete-address" data-address="{{ $address->id }}">Usuń</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif
  @if($client->contacts()->get()->count() > 0)
    <section class="content-header">
      <h1>
        Kontakty
      </h1>
    </section>
    <section class="content">
      <div class="row">
        @foreach($client->contacts()->get() as $contact)
          <div class="col-md-6">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">{{ $contact->firstname }}&nbsp;{{ $contact->lastname }}</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2"><strong>Stanowisko</strong></div>
                  <div class="col-md-10">{{ $contact->title }}</div>
                </div>
                <div class="row">
                  <div class="col-md-2"><strong>Adres e-mail</strong></div>
                  <div class="col-md-10"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div>
                </div>
                <div class="row">
                  <div class="col-md-2"><strong>Numer telefonu</strong></div>
                  <div class="col-md-10"><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></div>
                </div>
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2 col-md-offset-8">
                    <a href="/contact/{{ $contact->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
                  </div>
                  <div class="col-md-2">
                    <a href="javascript:void(0)" class="btn btn-block btn-danger delete-contact" data-contact="{{ $contact->id }}">Usuń</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif
  @include('client.partials.modal-client-delete')
  @include('client.partials.modal-address-delete')
  @include('client.partials.modal-contact-delete')
@endsection

@section('script')
<script>
  $('.delete-client').click(function(){
    $('#form-client-delete').attr('action', '/client/' + $(this).data('client'));
    $('.modal-client-delete').modal('show');
  });
  $('.delete-address').click(function(){
    $('#form-address-delete').attr('action', '/address/' + $(this).data('address'));
    $('.modal-address-delete').modal('show');
  });
  $('.delete-contact').click(function(){
    $('#form-contact-delete').attr('action', '/contact/' + $(this).data('contact'));
    $('.modal-contact-delete').modal('show');
  });
</script>
@endsection