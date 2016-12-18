@extends('layouts.master')

@section('content')
  <section class="content-header">
    <h1>
      Użytkownik
    </h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $user->firstname }} {{ $user->lastname }}</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-2"><strong>E-mail</strong></div>
          <div class="col-md-10"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Admin</strong></div>
          <div class="col-md-10">@if($user->admin == 1) Tak @else Nie @endif</div>
        </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/user" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1">
            <a href="/user/{{ $user->id }}/edit" class="btn btn-block btn-info">Edytuj</a>
          </div>
          <div class="col-md-1">
            <a href="javascript:void(0)" class="btn btn-block btn-danger delete-user" data-user="{{ $user->id }}">Usuń</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('user.partials.modal-user-delete')
@endsection

@section('script')
<script>
  $('.delete-user').click(function(){
    $('#form-user-delete').attr('action', '/user/' + $(this).data('user'));
    $('.modal-user-delete').modal('show');
  });
</script>
@endsection