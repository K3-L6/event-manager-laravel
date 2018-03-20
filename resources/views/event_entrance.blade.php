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
    
    
    
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{-- background cover --}}
    <style type="text/css">
     html, body {
         height:100%;
         width: 100%;
     } 

     body {
         background-image: url('{{ asset('/img/event/' . $event->background) }}');
         background-size: cover;
         background-repeat: no-repeat;
         background-position: left top;
     }
    </style>

    <!-- Font Awesome 4 LOCAL-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <script type="text/javascript" src="{{ asset('js/fontawesome.js') }}"></script>

    {{-- fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{$event->title_font}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{$event->description_font}}">
  </head>
  <body>
    @include('inc.messages')
    <div class="background">
      <div class="mainpanel">
          @if ($event->title_show == 1)
            <h1 style="font-family: {{$event->title_font}}; font-size: {{$event->title_size+5}}vmin; color: {{$event->title_color}};">
              {{$event->title}}
            </h1>
          @else
            <h1 style="font-family: {{$event->title_font}}; font-size: {{$event->title_size+5}}vmin; color: {{$event->title_color}}; display: none;">
              {{$event->title}}
            </h1>
          @endif
          
          @if ($event->description_show == 1)
            <p style="font-family: {{$event->description_font}}; font-size: {{$event->description_size+1}}vmin; color: {{$event->description_color}}">
              {{$event->description}}
            </p>
          @else
            <p style="font-family: {{$event->description_font}}; font-size: {{$event->description_size+1}}vmin; color: {{$event->description_color}}; display:none;">
              {{$event->description}}
            </p>
          @endif
          
      </div>  
    </div>

    <form method="post" id="form" action="/event/entrance/log">
      @csrf()
      <input type="text" id="idcard" name="idcard" style="display: none;">
      
    </form>

    <form method="post" id="exit" action="/event/exit">
      @csrf()
    </form>
    {{-- <button id="testBtn">Test</button> --}}
    
    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/front.js') }}"></script>

    @include('inc.flashy')
    
    <script type="text/javascript">
      $(function() {
        window.history.pushState(null, "", window.location.href);        
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
        
        $(document).keypress(function(e){
          var id = $('#idcard').val();
          $('#idcard').val(id += e.key);
          if(e.which == 13){
            $('#form').submit();  
          }
        });
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
              $('#exit').submit();
            }
        });
      });
    </script>

  </body>
</html>