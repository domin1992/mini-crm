@extends('layouts.master')

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dodaj nowy</h3>
    </div>
    <form class="form-horizontal" action="/contract" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="client_id" class="col-sm-2 control-label">Klient</label>
          <div class="col-sm-10">
              <select class="form-control" name="client_id" id="client_id">
                  <option value="0" selected="selected">Wybierz</option>
                  @foreach(App\Client::all() as $client)
                      <option value="{{ $client->id }}">{{ $client->company }}</option>
                  @endforeach
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="contract_type_id" class="col-sm-2 control-label">Typ umowy</label>
          <div class="col-sm-10">
              <select class="form-control" name="contract_type_id" id="contract_type_id">
                  <option value="0" selected="selected">Wybierz</option>
                  @foreach(App\ContractType::all() as $contractType)
                      <option value="{{ $contractType->id }}">{{ $contractType->name }}</option>
                  @endforeach
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="contract_sign_method_id" class="col-sm-2 control-label">Metoda podpisu</label>
          <div class="col-sm-10">
              <select class="form-control" name="contract_sign_method_id" id="contract_sign_method_id">
                  <option value="0" selected="selected">Wybierz</option>
                  @foreach(App\ContractSignMethod::all() as $contractSignMethod)
                      <option value="{{ $contractSignMethod->id }}">{{ $contractSignMethod->name }}</option>
                  @endforeach
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Adres email</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">Numer telefonu</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="phone" name="phone">
          </div>
        </div>
        <div id="predefined-fields"></div>
        {{ csrf_field() }}
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-md-1">
            <a href="/contract-type" class="btn btn-block btn-default">Wstecz</a>
          </div>
          <div class="col-md-1 col-md-offset-10">
            <button type="submit" class="btn btn-block btn-success">Zapisz</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection

@section('script')
    <script>
        $('#contract_type_id').on('change', function(){
            if($(this).val() != 0){
                $('#predefined-fields').fadeOut();
                $.getJSON('/ajax-contract-type/' + $(this).val())
                .done(function(response){
                    var html = '';
                    for(var i = 0; i < response.fields.length; i++){
                        html += '<div class="form-group">';
                        html += '<label for="' + response.fields[i].name + '" class="col-sm-2 control-label">' + response.fields[i].placeholder + ' [' + response.fields[i].name + ']</label>';
                        html += '<div class="col-sm-10">';
                        html += '<input type="text" class="form-control" id="' + response.fields[i].name + '" name="' + response.fields[i].name + '">';
                        html += '</div>';
                        html += '</div>';
                    }
                    $('#predefined-fields').html(html);
                    $('#predefined-fields').fadeIn();
                })
                .fail(function(){
                    alert('Błąd połaczenia z bazą danych');
                });
            }
            else{
                $('#predefined-fields').fadeOut();
            }
        });
    </script>
@endsection