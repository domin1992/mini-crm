<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Manager</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/css/admin-lte.min.css">
  <link rel="stylesheet" href="/css/master.css">
  <link rel="stylesheet" href="/css/skins/_all-skins.min.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="/" class="logo">
      <span class="logo-mini"><b>M</b></span>
      <span class="logo-lg">MANAGER</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{ Auth::User()->firstname }}&nbsp;{{ Auth::User()->lastname }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <p>
                  {{ Auth::User()->firstname }}&nbsp;{{ Auth::User()->lastname }}
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <form action="/logout" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default btn-flat">Wyloguj się</button>
                  </form>

                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li @if(strpos(Route::currentRouteName(), 'dashboard') !== false) class="active" @endif>
          <a href="/dashboard">
            <i class="fa fa-desktop"></i> <span>Pulpit</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'client') !== false) class="active" @endif>
          <a href="/client">
            <i class="fa fa-user"></i> <span>Klienci</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'employee') !== false) class="active" @endif>
          <a href="/employee">
            <i class="fa fa-group"></i> <span>Pracownicy</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'invoice') !== false) class="active" @endif>
          <a href="/invoice">
            <i class="fa fa-file-text-o"></i> <span>Faktury</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'bill') !== false) class="active" @endif>
          <a href="/bill">
            <i class="fa fa-file-text"></i> <span>Rachunki</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'company') !== false) class="active" @endif>
          <a href="/company">
            <i class="fa fa-building-o"></i> <span>Baza firm</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'recurring-payment') !== false) class="active" @endif>
          <a href="/recurring-payment">
            <i class="fa fa-credit-card"></i> <span>Płatności cykliczne</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'user') !== false) class="active" @endif>
          <a href="/user">
            <i class="fa fa-male"></i> <span>Użytkownicy</span>
          </a>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'mileage') !== false) class="active" @endif>
          <a href="/mileage">
            <i class="fa fa-tachometer"></i> <span>Kilometrówka</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-copy"></i> <span>Umowy</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/contract-type"><i class="fa fa-circle-o"></i> Typy umów</a></li>
            <li><a href="/contract"><i class="fa fa-circle-o"></i> Umowy</a></li>
          </ul>
        </li>
        <li @if(strpos(Route::currentRouteName(), 'hosting') !== false) class="active" @endif>
          <a href="/hosting">
            <i class="fa fa-server"></i> <span>Hosting</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    @yield('content')
    {{--
      <section class="content-header">
        <h1>
          Blank page
        </h1>
      </section>

      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
          </div>
          <div class="box-body">
            Start creating your amazing application!
          </div>
          <div class="box-footer">
            Footer
          </div>
        </div>

      </section>
    --}}
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="http://dominiknowak.xyz">Dominik Nowak</a>.</strong> All rights
    reserved.
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <div class="control-sidebar-bg"></div>
</div>

<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/plugins/fastclick/fastclick.js"></script>
<script src="/js/app.min.js"></script>
<script src="/js/demo.js"></script>
@yield('script')
</body>
</html>
