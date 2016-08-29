@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Pracownicy</h3>
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
          @forelse($employees as $employee)
            <tr>
              <td>
                {{ $employee->firstname }}
              </td>
              <td>
                {{ $employee->lastname }}
              </td>
              <td>
                {{ $employee->email }}
              </td>
              <td>
                <div class="btn-group">
                  <a href="/employee/{{ $employee->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/employee/{{ $employee->id }}/edit">Edytuj</a></li>
                    <li><a href="javascript:void(0)" class="delete-employee" data-employee="{{ $employee->id }}">Usuń</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3">
                Brak pracowników
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-right">
          <a href="/employee/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@include('employee.partials.modal-employee-delete')
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();

  $('.delete-employee').click(function(){
    $('#form-employee-delete').attr('action', '/employee/' + $(this).data('employee'));
    $('.modal-employee-delete').modal('show');
  });
</script>
@endsection
