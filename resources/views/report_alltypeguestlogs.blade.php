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
        <option value="/admin/report/alltypeguestlogs" selected>All Guest Type</option>
        <option value="/admin/report/preregguestlogs">Pre Registered Guest</option>
        <option value="/admin/report/walkinguestlogs">Walk In Guest</option>
      </select>
    </div>
    <form action="/admin/report/alltypeguestlogs/print" id="printForm" method="post">
      @csrf()
      <button id="print" class="btn btn-primary float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Print</button>
    </form>
    <form action="/admin/report/alltypeguestlogs/excel" id="excelForm" method="post">
      @csrf()
      <button id="excel" class="btn btn-primary float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Excel</button>
    </form>
  </div>
</ul>

	<div class="container-fluid" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  <h2>ALL TYPE GUEST ATTENDACE REPORT</h2>
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
                      <th>Type</th>
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
                { extend: 'print', className: 'd-none', title:'ALL TYPE GUEST LIST REPORT', exportOptions:{ columns:[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]} , 
                customize: function(win){
                  $(win.document.body).css( 'font-size', '8px' );
                  $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
                  $(win.document.body).find( 'th' ).css( 'font-size', '8px' );
                }},
                { extend: 'excel', className: 'd-none', title:'ALL TYPE GUEST ATTENDACE REPORT', exportOptions:{ columns:[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]} },
                'pageLength',
             ],
             
             ajax: "{{ route('admin.report.alltypeguestlogs.api') }}",
             columnDefs: [
                 { "width": "25%", "targets": 0 },
                 { "width": "25%", "targets": 7 },
                 { "width": "25%", "targets": 8 },
                 { "width": "25%", "targets": 9 }
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
               {data: 'type', name: 'type'},
             ],
             initComplete: function(settings, json) {$('.loader').fadeOut();}
         });
         $(document).on('click', '#print', function(){
            $('#printForm').submit(function(){
              if(!table.data().any()){return false;}
              $(".buttons-print")[0].click();
              return true;
            });
         });
         $(document).on('click', '#excel', function(){
            $('#excelForm').submit(function(){
              if(!table.data().any()){return false;}
              $(".buttons-excel")[0].click();
              return true;
            });
         });
         $('#searchInput').on( 'keyup', function () {
             table.search( this.value ).draw();
         } );

     });

</script>
@endpush