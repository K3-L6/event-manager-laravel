
@extends('layouts.app')
@push('title') 
  SUBEVENT LIST
@endpush

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')
<ul class="breadcrumb">
  <div class="container-fluid">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active">Subevent</li>
  </div>
</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
              <button id="print" class="btn btn-primary btn-sm" style="width: 150px;">
                Print
              </button>
              <a href="/admin/subevent/register" class="btn btn-sm btn-primary" style="width: 150px;">
              	Create 
              </a>

              
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  <h3 class="h4">SUBEVENT TABLE</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="mytable" class="table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Exhibitor</th>
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
                { extend: 'print', className: 'd-none', title:'Events', exportOptions:{ columns:[0, 1, 2]} },
                { extend: 'excel', className: 'd-none', title:'Events', exportOptions:{ columns:[0, 1, 2] } },
                'pageLength',
             ],
             columnDefs: [
                 { "width": "30%", "targets": 0 },
                 { "width": "30%", "targets": 1 },
                 { "width": "30%", "targets": 2 },
                 { "width": "10%", "targets": 3 }
             ],
             ajax: "{{ route('admin.subevent.api') }}",

             columns: [
               {data: 'title', name: 'title'},
               {data: 'description', name: 'description'},
               {data: 'exhibitor', name: 'exhibitor'},
               {data: 'action', name: 'action', orderable:false, searchable:false, printable:false},
             ]
         });
         $(document).on('click', '#print', function(){
            $(".buttons-print")[0].click();
         });
         $('#searchInput').on( 'keyup', function () {
             table.search( this.value ).draw();
         } );

     });

</script>
@endpush