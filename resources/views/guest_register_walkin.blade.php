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
    <!-- Font Awesome 4 LOCAL-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <script type="text/javascript" src="{{ asset('js/fontawesome.js') }}"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-1">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <a href="/registrator" class="main-link">
                        <i class="fa fa-chevron-left" style="color: white;"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    --> 
            <div class="col-lg-11 bg-white"> 
              <form action="/registrator/walkin/register" method="post" enctype="multipart/form-data">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <div class="row">
                  
                    <div class="col-md-12 ">
                    
                 <h1  style="margin-bottom: 5%;">Walk In Guest Registration</h1>
                
  @csrf
  
             <div class="form-group row" style="margin-top: 3%;">
                <label  for = "fname" class="col-md-3 form-control-label" name="fname">First Name</label>
                <div class="col-md-8">
                  <input id "fname" type="text" class="form-control"   value="{{old('fname')}}" name="fname">
                 
                  @if ($errors->has('fname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('fname') }}</strong>
                      </span>
                  @endif
                </div>
               </div>

               <div class="form-group row" style="margin-top: 3%;">
                <label  for="mname" class="col-md-3 form-control-label" name="title">Middle Name</label>
                <div class="col-md-8">
                  <input type="text" class="form-control"  value="{{old('mname')}}" name="mname">
                  
                  @if ($errors->has('mname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('mname') }}</strong>
                      </span>
                  @endif
                </div>
               </div>

                <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="lname">Last Name</label>
                <div class="col-md-8">
                  <input type="text" class="form-control"  value="{{old('lname')}}" name="lname">
                 
                  @if ($errors->has('lname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('lname') }}</strong>
                      </span>
                  @endif
                </div>
               </div>

               <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="email">Email</label>
                <div class="col-md-8">
                  <input type="email" class="form-control"  value="{{old('email')}}" name="email">
                  
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
               </div>
                <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="designation">Designation</label>
                <div class="col-md-8">
                  <input type="text" class="form-control"  value="{{old('designation')}}" name="designation">
                 
                  @if ($errors->has('designation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('designation') }}</strong>
                      </span>
                  @endif
                </div>
               </div>

               <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="cname">Company Name</label>
                <div class="col-md-8">
                  <input type="text" class="form-control"  value="{{old('cname')}}" name="cname">
                  
                  @if ($errors->has('cname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('cname') }}</strong>
                      </span>
                  @endif
                </div>
               </div>
                <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="addr">Office Address</label>
                <div class="col-md-8">
                  <input type="text" class="form-control"  value="{{old('addr')}}" name="addr">
                 
                  @if ($errors->has('addr'))
                      <span class="help-block">
                          <strong>{{ $errors->first('addr') }}</strong>
                      </span>
                  @endif
                </div>
               </div>

               <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="mobilenum">Mobile Number</label>
                <div class="col-md-8">
                  <input type="number" class="form-control"  value="{{old('mobilenum')}}" name="mobilenum">
                  
                  @if ($errors->has('mobilenum'))
                      <span class="help-block">
                          <strong>{{ $errors->first('mobilenum') }}</strong>
                      </span>
                  @endif
                </div>
               </div>

               <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="telnum">Office Tel #</label>
                <div class="col-md-8">
                  <input type="number" class="form-control"  value="{{old('telnum')}}" name="telnum">
                  
                  @if ($errors->has('telnum'))
                      <span class="help-block">
                          <strong>{{ $errors->first('telnum') }}</strong>
                      </span>
                  @endif
                </div>
               </div>

               <div class="form-group row" style="margin-top: 3%;">
                <label class="col-md-3 form-control-label" name="idcard">Badge ID</label>
                <div class="col-md-8">
                  <input type="text" class="form-control"  value="{{old('idcard')}}" name="idcard">
                 
                  @if ($errors->has('idcard'))
                      <span class="help-block">
                          <strong>{{ $errors->first('idcard') }}</strong>
                      </span>
                  @endif
                </div>
               </div>
            

               


                <button type="submit" class="btn btn-primary btn-block">Submit</button>

                    
   
 

</form>
         
                    </div>

                    
                    
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






  