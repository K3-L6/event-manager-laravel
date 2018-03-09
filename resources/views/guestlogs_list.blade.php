<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Event Manager</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/style.sea.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    @include('inc.messages')
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-1">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <a href="/home" class="main-link">
                        <i class="fa fa-chevron-left" style="color: white;"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-11 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <h1>GUEST LOGS FOR {{strtoupper($subevent->title)}}</h1>
                  <div class="table-responsive" style="padding-right: 2%;">
                    <table id="mytable" class="table" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th style="width: 40%">Name</th>
                          <th style="width: 40%">Company</th>
                          <th style="width: 20%">Designation</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($subeventlog as $subeventlog)
                        <tr>
                          <td>
                            {{ucwords($subeventlog->guest->firstname) . ' ' . ucwords($subeventlog->guest->middlename) . ' ' . ucwords($subeventlog->guest->lastname)}}
                          </td>
                          <td>{{ucwords($subeventlog->guest->companyname)}}</td>
                          <td>{{ucwords($subeventlog->guest->designation)}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/front.js') }}"></script>

  </body>
</html>