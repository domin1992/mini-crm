@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Hosting</h3>
    </div>
    <div class="box-body">
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              Firma
            </th>
            <th>
              Nazwa konta
            </th>
            <th>
              Data zakończenia
            </th>
            <th>
              Cena
            </th>
            <th>
              Opcje
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($hostings as $hosting)
            <tr>
              <td>
                {{ $hosting->account_name }}
              </td>
              <td>
                @if($hosting->client()->first())
                  {{ $hosting->client()->first()->company }}
                @endif
              </td>
              <td>
                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $hosting->cycle()->orderBy('created_at', 'desc')->first()->end_date)->format('Y-m-d') }}
              </td>
              <td>
                {{ number_format($hosting->price_tax_excl, 2, ',', ' ') }} zł
              </td>
              <td>
                <div class="btn-group">
                  <a href="/hosting/{{ $hosting->id }}" class="btn btn-info">Zobacz</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/hosting/{{ $hosting->id }}/edit">Edytuj</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">
                Brak hostingów
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-1 pull-right">
          <a href="/hosting/create" class="btn btn-block btn-info">Nowy</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $("#data-table").DataTable();
</script>
@endsection
