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
                    @if (count(Auth::user()->role->access) == 1)
                      <form id="logout" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <a href="javascript:{}" class="main-link" onclick="document.getElementById('logout').submit(); return false;">
                          <i class="fa fa-chevron-left" style="color: white;"></i>
                        </a>
                      </form>  
                    @else
                      <a href="/home" class="main-link">
                          <i class="fa fa-chevron-left" style="color: white;"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-11 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <h1>SUB EVENTS</h1>
                  <div class="table-responsive" style="padding-right: 2%;">
                    <table id="mytable" class="table" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th style="width: 40%">Title</th>
                          <th style="width: 50%">Description</th>
                          <th style="width: 10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($subevent as $subevent)
                        <tr>
                          <td>{{$subevent->title}}</td>
                          <td>{{$subevent->description}}</td>
                          <td>
                            <div class="btn-group" role="group">

                              <button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#myModal{{$subevent->id}}">
                                <i class="fa fa-plus"></i>
                              </button>

                              <form method="get" action="/exhibitor/guestlogslist/{{$subevent->id}}">
                                <button type="submit" class="btn btn-sm btn-info btn-block"><i class="fa fa-check"></i></button>
                              </form>

                              <form method="get" action="/subevent/entrance/{{$subevent->id}}">
                                <button type="submit" class="btn btn-sm btn-primary btn-block"><i class="fa fa-chevron-right"></i></button>
                              </form>
                            </div>
                          </td>
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
      
      @foreach ($subevents as $x)
        <div class="modal fade" id="myModal{{$x->id}}">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">MANUAL GUEST LOG FOR {{strtoupper($x->title)}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <form action="/exhibitor/manuallog/{{$x->id}}" method="post">
                      @csrf()
                      <input type="text" class="form-control" value="{{old('idcard')}}" style="font-size: 50px; text-align: center;" name="idcard">
                      <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1%;">SAVE</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      @endforeach
      
      
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