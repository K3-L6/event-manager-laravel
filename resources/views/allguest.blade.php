
@extends('layouts.app')
@push('title') 
  GUEST LIST
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
    <form action="" method="get">
      <button class="btn btn-primary btn-sm float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Import</button>
    </form>
    <form action="" method="get">
      <button id="print" class="btn btn-primary btn-sm float-right" style="width: 150px; margin-left: 1%; margin-right: 1%;">Print</button>
    </form>
  </div>
</ul>

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
                      <th>Company Name</th>
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
                { extend: 'print', className: 'd-none', title:'Guest List', exportOptions:{ columns:[0, 1, 2]} },
                'pageLength',
             ],
             columnDefs: [
                 { "width": "30%", "targets": 0 },
                 { "width": "20%", "targets": 1 },
                 { "width": "30%", "targets": 2 },
                 { "width": "20%", "targets": 3 }
             ],
             ajax: "{{ route('admin.guest.api') }}",

             columns: [
               {data: 'name', name: 'name'},
               {data: 'designation', name: 'designation'},
               {data: 'companyname', name: 'companyname'},
               {data: 'action', name: 'action', orderable:false, searchable:false, printable:false},
             ]
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