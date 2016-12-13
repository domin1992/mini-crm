@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Exportuj</h3>
    </div>
    <form class="form-horizontal" method="POST">
      <div class="box-body">
        <div class="form-group">
            <label class="col-sm-2 control-label">Filtr</label>
            <div class="col-sm-10">
                <div class="radio">
                    <label>
                        <input type="radio" name="filter" id="filter1" value="has_email" checked>
                        Posiada adres e-mail
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="filter" id="filter2" value="has_phone">
                        Posiada numer telefonu
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="filter" id="filter1" value="only_email">
                        Tylko z adresem e-mail bez numeru telefonu
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="filter" id="filter2" value="only_phone">
                        Tylko z numerem telefonu bez adresu email
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="filter" id="filter3" value="all" checked>
                        Wszystkie
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="range" class="col-sm-2 control-label">Okres</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="range" id="range">
            </div>
        </div>
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/company" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1 col-md-offset-10">
            <button type="submit" id="make-export" class="btn btn-block btn-success">Eksportuj</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
        $('#range').daterangepicker();

        // $('#make-export').click(function(){
            // $.post('/company-export', {filter: $('input[name="filter"]:checked').val(), range: $('#range').val(), '_token': $('meta[name="csrf-token"]').attr('content')}, function(response) {
            //     $("body").append("<iframe src='" + response.url+ "' style='display: none;' ></iframe>");
            // });
        // });
    </script>
@endsection