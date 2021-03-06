@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Dodaj nowy rachunek</h3>
            </div>
            <form class="form-horizontal" action="/bill" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="client_id" class="col-sm-2 control-label">Klient <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" name="client_id" id="client_id">
                                <option value="0" selected="selected">Wybierz</option>
                                @foreach(App\Client::all() as $client)
                                    <option value="{{ $client->id }}">{{ $client->company }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="address_container" class="form-group" style="display: none;">
                        <label for="address_id" class="col-sm-2 control-label">Adres <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="address_id" name="address_id">
                                <!-- <option value="0" selected>Wybierz</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="issue_city" class="col-sm-2 control-label">Miejsce wystawienia <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="issue_city" name="issue_city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="issue_date" class="col-sm-2 control-label">Data wystawienia <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="issue_date" name="issue_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sell_date" class="col-sm-2 control-label">Data sprzedaży <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sell_date" name="sell_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="payment_method_id" class="col-sm-2 control-label">Metoda płatności <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="payment_method_id" name="payment_method_id">
                                @foreach(App\PaymentMethod::all() as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="paid" name="paid"> Zapłacono
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="positions" class="col-sm-2 control-label">Pozycje</label>
                        <div class="col-sm-10">
                            <table class="table" id="positions">
                                <thead>
                                    <tr>
                                        <th>Nazwa <span class="required">*</span></th>
                                        <th>Ilość <span class="required">*</span></th>
                                        <th>JM <span class="required">*</span></th>
                                        <th>Cena netto <span class="required">*</span></th>
                                        <th>Podatek VAT <span class="required">*</span></th>
                                        <th>Usuń</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7"><a href="javascript:void(0)" id="add-position" class="btn btn-info pull-right">Dodaj pozycje</a></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" id="positions_list" name="positions_list">
                    {{ csrf_field() }}
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="/bill" class="btn btn-block btn-default">Wstecz</a>
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
    <script src="/plugins/select2/select2.min.js"></script>
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/plugins/datepicker/locales/bootstrap-datepicker.pl.js"></script>
    <script>
        $(document).ready(function(){
            // Declare default values
            var positionRowIndexer = [];
            var taxes = [];

            // Ajax request for tax rules
            $.getJSON('/ajax-tax')
            .done(function(response){
                taxes = response;
                $('#add-position').trigger('click');
            })
            .fail(function(){
                alert('Nie można pobrać reguł podatkowych');
            });

            // Add invoice position event
            $('#add-position').click(function(){
                if(positionRowIndexer.length <= 0)
                    var next = 0;
                else
                    var next = positionRowIndexer[positionRowIndexer.length - 1] + 1;
                positionRowIndexer.push(next);
                $('#positions_list').val(positionRowIndexer.toString());
                var row = '';
                row += '<tr data-row="' + next + '">';
                row += '<td><input type="text" class="form-control" name="' + next + '_name"></td>';
                row += '<td><input type="text" class="form-control" name="' + next + '_quantity"></td>';
                row += '<td><input type="text" class="form-control" name="' + next + '_measure_unit"></td>';
                row += '<td><input type="text" class="form-control" name="' + next + '_price_tax_excl"></td>';
                row += '<td><select class="form-control" name="' + next + '_tax_id">';
                row += '<option value="0" selected="selected">Wybierz</option>';
                for(var key in taxes){
                    row += '<option value="' + taxes[key].id + '">' + taxes[key].display + '</option>';
                }
                row += '</select></td>';
                row += '<td><a href="javascript:void(0)" class="btn btn-danger remove-position"><i class="fa fa-trash-o"></i></a></td>';
                row += '</tr>';
                $('#positions tbody').append(row);
            });

            // Remove invoice position event
            $('#positions').delegate('.remove-position', 'click', function(){
                var rowIndex = $(this).closest('tr').data('row');
                $(this).closest('tr').remove();
                var indexToRemove = positionRowIndexer.indexOf(rowIndex);
                if(indexToRemove > -1)
                    positionRowIndexer.splice(indexToRemove, 1);
                $('#positions_list').val(positionRowIndexer.toString());
            });

            // Init datepicker plugin
            $('#issue_date').datepicker({
                language: 'pl',
                defaultViewDate: 'today',
                todayBtn: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                autoclose: true,
            });
            $('#sell_date').datepicker({
                language: 'pl',
                defaultViewDate: 'today',
                todayBtn: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                autoclose: true,
            });

            // Ajax request for client addresses (required for invoice)
            $('#client_id').on('change', function(){
                if($(this).val() != 0){
                    $('#address_container').fadeOut();
                    $.getJSON('/ajax-client/' + $(this).val())
                    .done(function(response){
                        var html = '';
                        html += '<option value="0" selected="selected">Wybierz</option>';
                        for(var i = 0; i < response.addresses.length; i++){
                            html += '<option value="' + response.addresses[i].id + '">' + response.addresses[i].name + '</option>';
                        }
                        $('#address_id').html(html);
                        $('#address_container').fadeIn();
                    })
                    .fail(function(){
                        alert('Błąd połaczenia z bazą danych');
                    });
                }
                else{
                    $('#address_container').fadeOut();
                }
            });
        });
    </script>
@endsection