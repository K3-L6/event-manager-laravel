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
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/style.sea.css') }}" id="theme-stylesheet">
    {{-- flashy --}}
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>

    
    
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{-- background cover --}}
    <style type="text/css">
     html, body {
         height:100%;
         width: 100%;
     } 

     body {
         background-image: url('{{ asset('/img/subevent/' . $subevent->background) }}');
         background-size: cover;
         background-repeat: no-repeat;
         background-position: left top;
     }
    </style>

    <!-- Font Awesome 4 LOCAL-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <script type="text/javascript" src="{{ asset('js/fontawesome.js') }}"></script>

    {{-- fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{$subevent->title_font}}">
  </head>
  <body>
    @include('inc.messages')
    <div class="background">
      <div class="mainpanel">
          <h1 style="font-family: {{$subevent->title_font}}; font-size: {{$subevent->title_size}}vw; color: {{$subevent->title_color}};">{{$subevent->title}}</h1>
          <p style="font-family: {{$subevent->description_font}}; font-size: {{$subevent->description_size}}vw; color: {{$subevent->description_color}}">{{$subevent->description}}</p>
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