@extends('layouts.app')

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')
<ul class="breadcrumb">
  <div class="container-fluid">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
  </div>
</ul>

	<div class="container-fluid" style="padding-top: 3%;">
		
		<div class="col-12" style="width: 100%;">

      <form action="/admin/setting" method="post" enctype="multipart/form-data">  
      @csrf()
         
        <div class="card">
          
          <div class="card-close">
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>Event Resets</h2>
          </div>

          <div class="card-body">
          
                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="EventReset" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Reset To Default
                      </label>
                  </div>  
                </div>

                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="DeleteEventLogs" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Delete All Event Logs
                      </label>
                  </div>  
                </div>

          </div>
        </div>

        <div class="card">
          
          <div class="card-close">
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>Sub Event Resets</h2>
          </div>

          <div class="card-body">
          
                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="SubEventReset" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Delete All Sub Events
                      </label>
                  </div>  
                </div>

                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="DeleteSubEventLogs" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Delete All Sub Event Logs
                      </label>
                  </div>  
                </div>

          </div>
        </div>

        <div class="card">
          
          <div class="card-close">
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>Guest Resets</h2>
          </div>

          <div class="card-body">
          
                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="DeleteAllGuest" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Delete All Guest Registered
                      </label>
                  </div>  
                </div>

                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="DeletePreRegistered" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Delete All Pre Registered Guest
                      </label>
                  </div>  
                </div>

                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="DeleteWalkIn" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Delete All Walk In Guest
                      </label>
                  </div>  
                </div>

          </div>
        </div>

        <div class="card">
          
          <div class="card-close">
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>Audit Trail Resets</h2>
          </div>

          <div class="card-body">
          
                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="ResetAudit" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Reset Audit Trails
                      </label>
                  </div>  
                </div>

          </div>
        </div>

        <div class="card">
          
          <div class="card-close">
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>Users Control Resets</h2>
          </div>

          <div class="card-body">
                
                <div class="col-12">
                  <div class="checkbox">
                      <label style="font-size: 40px">
                          <input name="DefaultUser" type="checkbox" value="1">
                          <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                          Restore Default Users
                      </label>
                  </div>  
                </div>



          </div>
        </div>    
        
        <div class="card">
          
          <div class="card-close">
            
          </div>
          
          <div class="card-header d-flex align-items-center">
             <h2>BADGE SIZE DEFAULTS</h2>
          </div>

          <div class="card-body">

            <div class="form-group row">
              <div class="col-12">
                <select class="form-control" value="{{$status}}" name="status" style="font-size: 50px; text-align: center; text-align-last: center; height: 80px;">
                  @switch($status)
                      @case(1)
                            <option value="1" selected>76.2 mm by 101.6 mm</option>
                            <option value="2">127 mm by 101.6 mm</option>
                            <option value="3">101.6 mm by 127 mm</option>
                            <option value="4">Standard ID-1 (85.60 mm by 53.98 mm)</option>
                            <option value="5">Standard ID-2 (105 mm by 74 mm)</option>
                            <option value="6">Standard ID-3 (125 mm by 88 mm)</option>
                          @break
                      @case(2)
                            <option value="1">76.2 mm by 101.6 mm</option>
                            <option value="2" selected>127 mm by 101.6 mm</option>
                            <option value="3">101.6 mm by 127 mm</option>
                            <option value="4">Standard ID-1 (85.60 mm by 53.98 mm)</option>
                            <option value="5">Standard ID-2 (105 mm by 74 mm)</option>
                            <option value="6">Standard ID-3 (125 mm by 88 mm)</option>
                          @break
                      @case(3)
                            <option value="1">76.2 mm by 101.6 mm</option>
                            <option value="2">127 mm by 101.6 mm</option>
                            <option value="3" selected>101.6 mm by 127 mm</option>
                            <option value="4">Standard ID-1 (85.60 mm by 53.98 mm)</option>
                            <option value="5">Standard ID-2 (105 mm by 74 mm)</option>
                            <option value="6">Standard ID-3 (125 mm by 88 mm)</option>
                          @break
                      @case(4)
                            <option value="1">76.2 mm by 101.6 mm</option>
                            <option value="2">127 mm by 101.6 mm</option>
                            <option value="3">101.6 mm by 127 mm</option>
                            <option value="4" selected>Standard ID-1 (85.60 mm by 53.98 mm)</option>
                            <option value="5">Standard ID-2 (105 mm by 74 mm)</option>
                            <option value="6">Standard ID-3 (125 mm by 88 mm)</option>
                          @break
                      @case(5)
                            <option value="1">76.2 mm by 101.6 mm</option>
                            <option value="2">127 mm by 101.6 mm</option>
                            <option value="3">101.6 mm by 127 mm</option>
                            <option value="4">Standard ID-1 (85.60 mm by 53.98 mm)</option>
                            <option value="5" selected>Standard ID-2 (105 mm by 74 mm)</option>
                            <option value="6">Standard ID-3 (125 mm by 88 mm)</option>
                          @break
                      @case(6)
                            <option value="1">76.2 mm by 101.6 mm</option>
                            <option value="2">127 mm by 101.6 mm</option>
                            <option value="3">101.6 mm by 127 mm</option>
                            <option value="4">Standard ID-1 (85.60 mm by 53.98 mm)</option>
                            <option value="5">Standard ID-2 (105 mm by 74 mm)</option>
                            <option value="6" selected>Standard ID-3 (125 mm by 88 mm)</option>
                          @break
                  
                  @endswitch
                  
                </select>
                
              </div>
            </div>

          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">EXECUTE</button>

      </form>

    </div>
	</div>

@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#avatar_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#avatar_upload").change(function() {
      readURL(this);
    });
  });
</script>
@endpush
