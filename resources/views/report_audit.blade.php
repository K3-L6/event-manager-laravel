
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
    <li class="breadcrumb-item active">Audit</li>
    <form action="/admin/report/audit/print" id="printForm" method="post">
      @csrf()
      <button id="print" class="btn btn-primary  float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Print</button>
    </form>
    <form action="/admin/report/audit/excel" id="excelForm" method="post">
      @csrf()
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
      			  <h2>AUDIT TRAIL REPORT</h2>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="mytable" class="table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Action</th>
                      <th>Time</th>
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
                { extend: 'print', className: 'd-none', title:'AUDIT TRAIL REPORT', exportOptions:{ columns:[0, 1, 2, 3]} },
                { extend: 'excel', className: 'd-none', title:'AUDIT TRAIL REPORT', exportOptions:{ columns:[0, 1, 2, 3] } },
                'pageLength',
             ],
             columnDefs: [
                 { "width": "20%", "targets": 0 },
                 { "width": "15%", "targets": 1 },
                 { "width": "40%", "targets": 2 },
                 { "width": "25%", "targets": 3 }
             ],
             ajax: "{{ route('admin.report.auditapi') }}",

             columns: [
               {data: 'user', name: 'user'},
               {data: 'role', name: 'role'},
               {data: 'description', name: 'description'},
               {data: 'time', name: 'time'},
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