<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Event Manager</title>
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Google fonts - Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Aclonica" rel="stylesheet">
    
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/style.sea.css') }}" id="theme-stylesheet">
    
    <!-- Font Awesome 4 LOCAL-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <script type="text/javascript" src="{{ asset('js/fontawesome.js') }}"></script>
    
    

    
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">

    {{-- font selector --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontselect.css') }}">

    {{-- overide css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    
    @stack('loader')
    <div class="page home-page">
      
        @include('layouts.topbar')

        <div class="page-content d-flex align-items-stretch">
            
            @stack('sidebar')

            <div class="content-inner">
              <!-- Page Header-->
                <header class="page-header">
                    <div class="container-fluid">
                        <h2 class="no-margin-bottom">
                            @stack('title')
                        </h2>
                    </div>
                </header>
                
                @yield('content')

            </div>
        </div>
    </div>



    <!-- Javascript files-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/charts-home.js') }}"></script>
    <script src="{{ asset('js/front.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/jquery.fontselect.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $(".iconimage").animate({height: "35px"});
        });
    </script>

    @include('inc.flashy')
    @stack('scripts')
</body>
</html>
