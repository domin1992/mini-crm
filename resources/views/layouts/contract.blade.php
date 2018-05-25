<!DOCTYPE html>
<html lang="pl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Zencore</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="/css/contract.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="contract">
            <div class="wrapper">
                <form action="/umowa/{{ $contract->slug }}" method="post" data-sign-method="{{ $contract->signMethod()->first()->slug }}">
                    @yield('content')
                    @if($contract->signMethod()->first()->slug == 'sms')
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Podpisz kodem sms</h5>
                                <div class="form-group form-group-phone">
                                    <label for="phone">Numer telefonu</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">+48</div>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="XXXXXXXXX">
                                    </div>
                                </div>
                                <div class="form-group form-group-phone">
                                    <button type="button" id="submit-phone" class="btn btn-default">Wyślij kod sms</button>
                                </div>
                                <div class="form-group form-group-sms-code">
                                    <label for="phone">Kod SMS</label>
                                    <input type="text" class="form-control" id="sms_code" name="sms_code">
                                </div>
                            </div>
                        </div>
                    @endif
                    {{ csrf_field() }}
                    <button type="submit" id="submit-form" class="btn btn-success">Akceptuj</button>
                </form>
            </div>
        </div>
        <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        @if($contract->signMethod()->first()->slug == 'sms')
            <script>
                $(document).ready(function(){
                    if($('form').data('sign-method') == 'sms'){
                        $('#submit-form').hide();
                        $('.form-group-sms-code').hide();
                    }
                });
                $('#submit-phone').click(function(){
                    $.post('/ajax-umowa-sms/' + '{{ $contract->slug }}', {'_token': '{{ csrf_token() }}', 'phone': $('#phone').val()})
                    .done(function(response){
                        if(response.success == 1 || response.success == '1'){
                            $('.form-group-phone').fadeOut(400, function(){
                                $('.form-group-sms-code').fadeIn();
                                $('#submit-form').fadeIn();
                            });
                        }
                        else{
                            alert(response.msg);
                        }
                    })
                    .fail(function(){
                        alert('Błąd połaczenia z bazą danych');
                    });
                });
                $('#submit-form').click(function(e){
                    e.preventDefault();
                    var self = $(this);
                    $.post('/ajax-umowa-sms-sprawdz/' + '{{ $contract->slug }}', {'_token': '{{ csrf_token() }}', 'sms_code': $('#sms_code').val()})
                    .done(function(response){
                        if(response.success == 1 || response.success == '1'){
                            self.closest('form').submit();
                        }
                        else{
                            alert(response.msg);
                        }
                    })
                    .fail(function(){
                        alert('Błąd połaczenia z bazą danych');
                    });
                });
            </script>
        @endif
        @yield('script')
    </body>
</html>