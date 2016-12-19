@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Użytkownicy</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Imię
            </th>
            <th>
              Nazwisko
            </th>
            <th>
              E-mail
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <td>
                {{ $user->firstname }}
              </td>
              <td>
                {{ $user->lastname }}
              </td>
              <td>
                {{ $user->email }}
              </td>
              <td>
                <div class="btn-group">
                  <a href="/user/{{ $user->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/user/{{ $user->id }}/edit">Edytuj</a></li>
                    <li><a href="javascript:void(0)" class="delete-user" data-user="{{ $user->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3">
                Brak klientow
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-right">
          <a href="/user/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('user.partials.modal-user-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();

  $('.delete-user').click(function(){
    $('#form-user-delete').attr('action', '/user/' + $(this).data('user'));
    $('.modal-user-delete').modal('show');
  });
</script>
@endsection
