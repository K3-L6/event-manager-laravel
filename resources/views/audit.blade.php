
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
    <li class="breadcrumb-item active">Audit</li>
    <form action="" method="get">
    </form>
  </div>
</ul>

<section class="dashboard-counts no-padding-bottom">
  <div class="container-fluid">
    <div class="row bg-white has-shadow">
      <!-- Item -->
      <div class="col-4">
        <div class="item d-flex align-items-center">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_administrator.png') }}"></div>
          <div class="title"><span>Administrator</span>
          </div>
          <div class="number"><strong>{{$administratorcount}}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-4">
        <div class="item d-flex align-items-center">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_exhibitor.png') }}"></div>
          <div class="title"><span>Exhibitor</span>
          </div>
          <div class="number"><strong>{{$exhibitorcount}}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-4">
        <div class="item d-flex align-items-center">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_registrator.png') }}"></div>
          <div class="title"><span>Registrator</span>
          </div>
          <div class="number"><strong>{{$registratorcount}}</strong></div>
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
      			  <h2>AUDIT TRAIL</h2>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="mytable" class="table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Avatar</th>
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
                  "<'row'<'col-12'B>>" +
                  "<'row'<'col-12'tr>>" +
                  "<'row'<'col-3'i><'col-9'p>>",
             processing: true,
             serverSide: true,
             colReorder: true,
             responsive: true,
             // lengthChange: false,
             buttons: [
                { extend: 'print', className: 'd-none', title:'Audit Trail', exportOptions:{ columns:[0, 1, 2, 3, 4]} },
                { extend: 'excel', className: 'd-none', title:'Audit Trail', exportOptions:{ columns:[0, 1, 2, 3, 4] } },
                'pageLength',
             ],
             columnDefs: [
                 { "width": "10%", "targets": 0 },
                 { "width": "20%", "targets": 1 },
                 { "width": "15%", "targets": 2 },
                 { "width": "30%", "targets": 3 },
                 { "width": "25%", "targets": 4 }
             ],
             ajax: "{{ route('admin.audit.api') }}",

             columns: [
               {data: 'avatar', name: 'avatar'},
               {data: 'user', name: 'user'},
               {data: 'role', name: 'role'},
               {data: 'description', name: 'description'},
               {data: 'time', name: 'time'},
               
             ],
             initComplete: function(settings, json) {$('.loader').fadeOut();}
         });
         $('#searchInput').on( 'keyup', function () {
             table.search( this.value ).draw();
         } );

     });

</script>
@endpush