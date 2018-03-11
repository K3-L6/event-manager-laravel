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
    <li class="breadcrumb-item active">Users</li>
    <form action="/admin/usersetting/roles" method="get">
      <button class="btn btn-primary float-right" style="width: 300px; margin-left: 1%; margin-right: 1%;">CREATE ROLE</button>
    </form>
    <form action="/admin/user/register" method="get">
      <button class="btn btn-primary float-right" style="width: 300px; margin-left: 1%; margin-right: 1%;">CREATE USERS</button>
    </form>
  </div>
</ul>

<section class="dashboard-counts no-padding-bottom">
  <div class="container-fluid">
    <div class="row bg-white has-shadow">
      <!-- Item -->
      <div class="col-xl-4 col-sm-12">
        <div class="item d-flex align-items-center">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_administrator.png') }}"></div>
          <div class="title"><span>Administrator</span>
          </div>
          <div class="number"><strong>{{$administratorcount}}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-4 col-sm-12">
        <div class="item d-flex align-items-center">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_exhibitor.png') }}"></div>
          <div class="title"><span>Exhibitor</span>
          </div>
          <div class="number"><strong>{{$exhibitorcount}}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-4 col-sm-12">
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


	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  <h2>USERS LIST</h2>
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
                { extend: 'print', className: 'd-none', title:'Events', exportOptions:{ columns:[0, 1, 2]} },
                { extend: 'excel', className: 'd-none', title:'Events', exportOptions:{ columns:[0, 1, 2] } },
                'pageLength',
             ],
             columnDefs: [
                 { "width": "10%", "targets": 0 },
                 { "width": "35%", "targets": 1 },
                 { "width": "30%", "targets": 2 },
                 { "width": "15%", "targets": 3 }
             ],
             ajax: "{{ route('admin.usersetting.api') }}",

             columns: [
               {data: 'avatar', name: 'avatar'},
               {data: 'name', name: 'name'},
               {data: 'role', name: 'role'},
               {data: 'action', name: 'action', orderable:false, searchable:false, printable:false},
             ],
             initComplete: function(settings, json) {$('.loader').fadeOut();}
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