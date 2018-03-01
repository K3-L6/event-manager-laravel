
@extends('layouts.app')
@push('title') 
  Guest List
@endpush

@push('loader')
 @include('layouts.loader')
@endpush

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')
<ul class="breadcrumb">
  <div class="container-fluid">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active">Guest</li>
    <form action="/admin/guest/register" method="get">
      <button class="btn btn-primary btn-sm float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Create</button>
    </form>
    <form action="/admin/guest/import" id="myexcelform" method="post" enctype="multipart/form-data">
      @csrf()
      <label class="btn btn-primary btn-sm float-right btn-file" style="width: 150px; margin-left: 1%; margin-right: 1%;">
          Import 
          <input type="file" id="myexcel" name="myexcel">
      </label>
      {{-- <button class="btn btn-primary btn-sm float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Import</button> --}}
    </form>
  </div>
</ul>
  <section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
      <div class="row bg-white has-shadow">
        <!-- Item -->
        <div class="col-xl-4 col-sm-12">
          <div class="item d-flex align-items-center">
            <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_walkin.png') }}"></div>
            <div class="title"><span>Walk-In</span>
            </div>
            <div class="number"><strong>{{$walkin}}</strong></div>
          </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-12">
          <div class="item d-flex align-items-center">
            <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_prereg.png') }}"></div>
            <div class="title"><span>Pre-Registered</span>
            </div>
            <div class="number"><strong>{{$prereg}}</strong></div>
          </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-12">
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

	<div class="container" style="padding-top: 3%;">
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="mytable" class="table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Company</th>
                      <th class="none">Office Telephone Number</th>
                      <th class="none">Office Address</th>
                      <th class="none">Email Address</th>
                      <th class="none">Mobile Number</th>
                      <th class="none">Guest Type</th>
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

@endsection

@push('scripts')
<script type="text/javascript">
  $(function() {
          var table = $('#mytable').DataTable({
             dom: 'Btpi',
             processing: true,
             serverSide: true,
             colReorder: true,
             responsive: true,
             // lengthChange: false,
             buttons: [
                'pageLength',
             ],
             columnDefs: [
                 { "width": "30%", "targets": 0 },
                 { "width": "30%", "targets": 1 },
                 { "width": "30%", "targets": 2 },
                 { "width": "10%", "targets": 3 }
             ],
             ajax: "{{ route('admin.guest.api') }}",

             columns: [
               {data: 'name', name: 'name'},
               {data: 'designation', name: 'designation'},
               {data: 'companyname', name: 'companyname'},
               {data: 'officetelnumber', name: 'officetelnumber'},
               {data: 'officeaddress', name: 'officeaddress'},
               {data: 'email', name: 'email'},
               {data: 'mobilenumber', name: 'mobilenumber'},
               {data: 'type', name: 'type'},
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