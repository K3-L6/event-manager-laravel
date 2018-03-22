@extends('layouts.app')

{{-- @push('loader')
 @include('layouts.loader')
@endpush --}}

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')
<ul class="breadcrumb">
  <div class="container-fluid">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/event">Event</a></li>
    <li class="breadcrumb-item active">Attendance</li>
    
    <button class="btn btn-primary float-right" style="width: 300px; margin-left: 1%; margin-right: 1%;" data-toggle="modal" data-target="#myModal">
      Manual Log
    </button>
    
  </div>
</ul>

  <section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
      <div class="row bg-white has-shadow">
        <!-- Item -->
        <div class="col-4">
          <div class="item d-flex align-items-center">
            <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_walkin.png') }}"></div>
            <div class="title"><span>Walk-In</span>
            </div>
            <div class="number"><strong>{{$walkin}}</strong></div>
          </div>
        </div>
        <!-- Item -->
        <div class="col-4">
          <div class="item d-flex align-items-center">
            <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_prereg.png') }}"></div>
            <div class="title"><span>Pre-Registered</span>
            </div>
            <div class="number"><strong>{{$prereg}}</strong></div>
          </div>
        </div>
        <!-- Item -->
        <div class="col-4">
          <div class="item d-flex align-items-center">
            <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_totalguest.png') }}"></div>
            <div class="title"><span>Total Guest</span>
            </div>
            <div class="number"><strong>{{$total}}</strong></div>
          </div>
        </div>
      </div>
    </div>
  </section>

	<div class="container-fluid" style="padding-top: 3%;">
		<div class="col-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  <h2>Guest Attendance</h2>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="mytable" class="table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Company</th>
                      <th>Designation</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
	</div>

  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">MANUAL GUEST LOG FOR {{strtoupper($event->title)}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12">
              <form action="/admin/event/log" method="post">
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

@endsection

@push('scripts')
<script type="text/javascript">
  $(function() {
          var table = $('#mytable').DataTable({
             dom: 
                  "<'row'<'col-12'B>>" +
                  "<'row'<'col-12'tr>>" +
                  "<'row'<'col-3'i><'col-9'p>>",
             processing: true,
             serverSide: true,
             colReorder: true,
             responsive: true,
             // lengthChange: false,
             buttons: [
                'pageLength',
             ],
             columnDefs: [
                 { "width": "25%", "targets": 0 },
                 { "width": "25%", "targets": 1 },
                 { "width": "20%", "targets": 2 },
                 { "width": "20%", "targets": 3 },
                 { "width": "10%", "targets": 4 }
             ],
             ajax: "{{ route('admin.event.logapi') }}",

             columns: [
               {data: 'name', name: 'name'},
               {data: 'companyname', name: 'companyname'},
               {data: 'designation', name: 'designation'},
               {data: 'time', name: 'time'},
               {data: 'action', name: 'action', orderable:false, searchable:false, printable:false},
             ],
             initComplete: function(settings, json) {$('.loader').fadeOut();}
         });
         $('#searchInput').on( 'keyup', function () {
             table.search( this.value ).draw();
         } );


         function readURL(input) {
           if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
              $('#myexcelform').submit();
             }
             reader.readAsDataURL(input.files[0]);
           }
         }
         $("#myexcel").change(function() {
           readURL(this);
         });

     });

</script>
@endpush