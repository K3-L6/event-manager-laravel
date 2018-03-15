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
  </head>
  <body onload="start_tts()">
    @include('inc.messages')
    <div class="background">
      <div class="mainpanel">
          <h1 style="font-family: {{$event->title_font}}; font-size: {{$event->title_size+5}}vmin; color: {{$event->title_color}};">
            Welcome
          </h1>

          <h1 style="font-family: {{$event->title_font}}; font-size: {{$event->title_size-10}}vmin; color: {{$event->title_color}};">
            {{ucwords($guest->firstname) . ' ' . ucwords($guest->lastname)}}
          </h1>
          
      </div>  
    </div>

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
        jQuery(document).ready(function() {
            msg = new SpeechSynthesisUtterance();
            var voices = speechSynthesis.getVoices();

            window.history.pushState(null, "", window.location.href);        
            window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
            };
            setTimeout(function() {
                 document.location.href = '/event/entrance';
            }, 5000);
        });
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
              $('#exit').submit();
            }
        });

        function start_tts(){
            checkCompatibilty();
            speak();
        }

        function checkCompatibilty () {
            if(!('speechSynthesis' in window)){
                alert('Your browser is not supported. Use latest version of google chrome for christ sake.');
            }
        };
        
        function speak () {

            msg.voice = speechSynthesis.getVoices().filter(function (voice) { return voice.name == "Google US English"; })[0];
            
            msg.text = "{{'Welcome. ' . $guest->firstname . '. ' . $guest->lastname}}";
            msg.rate = 1;
            msg.pitch = 1;
            msg.volume = 1;

            window.speechSynthesis.speak(msg);
        };
    </script>

  </body>
</html>