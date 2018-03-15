@extends('layouts.app')

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')
<ul class="breadcrumb">
  <div class="container-fluid">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/guest">Guest</a></li>
    <li class="breadcrumb-item active">Registration</li>
  </div>
</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-12" style="width: 100%;">

      <form action="/admin/guest/register" method="post">  
      @csrf()

        <div class="card">
        	
          <div class="card-close">
        	  
        	</div>
    			
          <div class="card-header d-flex align-items-center">
    			   <h2>Guest Information</h2>
    			</div>

          <div class="card-body">
            
              <div class="form-group row">
                <label class="col-3 form-control-label" name="lastname">Last Name</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('lastname')}}" name="lastname">
                  @if ($errors->has('lastname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('lastname') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="middlename">Middle Name</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('middlename')}}" name="middlename">
                  @if ($errors->has('middlename'))
                      <span class="help-block">
                          <strong>{{ $errors->first('middlename') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="firstname">First Name</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('firstname')}}" name="firstname">
                  @if ($errors->has('firstname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('firstname') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="email">Email</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('email')}}" name="email">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="mobilenumber">Mobile Number</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('mobilenumber')}}" name="mobilenumber">
                  @if ($errors->has('mobilenumber'))
                      <span class="help-block">
                          <strong>{{ $errors->first('mobilenumber') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="mobilenumber">Guest Type</label>
                <div class="col-9">
                  <select class="form-control" name="type">
                    <option value="1">Pre Registered Guest</option>
                    <option value="2" selected>Walk-In Guest</option>
                  </select>
                </div>
              </div>

          </div>
        </div>

        <div class="card">
          
          <div class="card-close">
            
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>Company Information</h2>
          </div>

          <div class="card-body">
          
              <div class="form-group row">
                <label class="col-3 form-control-label" name="companyname">Company Name</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('companyname')}}" name="companyname">
                  @if ($errors->has('companyname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('companyname') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="designation">Designation</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('designation')}}" name="designation">
                  @if ($errors->has('designation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('designation') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="officetelnumber">Office Tel Number</label>
                <div class="col-9">
                  <input type="text" class="form-control" value="{{old('officetelnumber')}}" name="officetelnumber">
                  @if ($errors->has('officetelnumber'))
                      <span class="help-block">
                          <strong>{{ $errors->first('officetelnumber') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-3 form-control-label" name="officeaddress">Office Address</label>
                <div class="col-9">
                  <textarea class="form-control" name="officeaddress" rows="8">{{old('officeaddress')}}</textarea>
                  @if ($errors->has('officeaddress'))
                      <span class="help-block">
                          <strong>{{ $errors->first('officeaddress') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

          </div>
        </div>

        <div class="card">
          
          <div class="card-close">
            
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>RFID CARD</h2>
          </div>

          <div class="card-body">
          
          <div class="form-group row">
            <div class="col-12">
              <input type="text" class="form-control" value="{{old('idcard')}}" style="font-size: 50px; text-align: center;" name="idcard">
              @if ($errors->has('idcard'))
                  <span class="help-block">
                      <strong>{{ $errors->first('idcard') }}</strong>
                  </span>
              @endif
            </div>
          </div>

          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>

      </form>

    </div>
	</div>

@endsection
