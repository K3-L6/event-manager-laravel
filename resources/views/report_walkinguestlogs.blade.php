@extends('layouts.app')

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
    <li class="breadcrumb-item active">Event Attendance</li>
    <div class="float-right">
      <select class="report-filter" onchange="location = this.value">
        <option value="/admin/report/alltypeguestlogs">All Guest Type</option>
        <option value="/admin/report/preregguestlogs">Pre Registered Guest</option>
        <option value="/admin/report/walkinguestlogs" selected>Walk In Guest</option>
      </select>
    </div>
    <form action="" method="get">
      <button id="print" class="btn btn-primary float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Print</button>
    </form>
    <form action="" method="get">
      <button id="excel" class="btn btn-primary float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Excel</button>
    </form>
  </div>
</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  <h2>WALK-IN GUEST ATTENDANCE REPORT</h2>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="mytable" class="table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th class="none">Email</th>
                      <th class="none">Mobile Number</th>
                      <th class="none">Designation</th>
                      <th class="none">Company</th>
                      <th class="none">Office Tel#</th>
                      <th class="none">Office Address</th>
                      <th>Time</th>
                      <th>Date</th>
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
             dom: 
                  "<'row'<'col-sm-12'B>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-3'i><'col-sm-9'p>>",
             processing: true,
             serverSide: true,
             colReorder: true,
             responsive: true,
             // lengthChange: false,
             buttons: [
                { extend: 'print', className: 'd-none', title:'WALK-IN GUEST ATTENDANCE REPORT', exportOptions:{ columns:[0, 1, 2, 3, 4, 5, 6, 7, 8]} },
                { extend: 'excel', className: 'd-none', title:'WALK-IN GUEST ATTENDANCE REPORT', exportOptions:{ columns:[0, 1, 2, 3, 4, 5, 6, 7, 8]} },
                'pageLength',
             ],
             
             ajax: "{{ route('admin.report.walkinguestlogs.api') }}",
             columnDefs: [
                 { "width": "40%", "targets": 0 },
                 { "width": "30%", "targets": 7 },
                 { "width": "30%", "targets": 8 }
             ],
             columns: [
               {data: 'name', name: 'name'},
               {data: 'email', name: 'email'},
               {data: 'mobilenumber', name: 'mobilenumber'},
               {data: 'designation', name: 'designation'},
               {data: 'companyname', name: 'companyname'},
               {data: 'officetelnumber', name: 'officetelnumber'},
               {data: 'officeaddress', name: 'officeaddress'},
               {data: 'time', name: 'time'},
               {data: 'date', name: 'date'},
             ],
             initComplete: function(settings, json) {$('.loader').fadeOut();}
         });
         $(document).on('click', '#print', function(){
            $(".buttons-print")[0].click();
         });
         $(document).on('click', '#excel', function(){
            $(".buttons-excel")[0].click();
         });
         $('#searchInput').on( 'keyup', function () {
             table.search( this.value ).draw();
         } );

     });

</script>
@endpush