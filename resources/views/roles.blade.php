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
    <li class="breadcrumb-item"><a href="/admin/usersetting">Users</a></li>
    <li class="breadcrumb-item active">Roles</li>
    
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
      
      <div class="col-12" style="width: 100%">
        
        <form method="post" action="/admin/usersetting/roles">
          
          @csrf()

          <div class="card">
            
            <div class="card-close">
              <button type="submit" style="width: 150px;" class="btn btn-sm btn-primary btn-block">Save Role</button>
            </div>
            
            <div class="card-header d-flex align-items-center">
               <h2>Roles Registration</h2>
            </div>

            <div class="card-body">
            
                <div class="form-group row">
                  <label class="col-3 form-control-label" name="name">Role Name</label>
                  <div class="col-9">
                    <input type="text" class="form-control" value="{{old('name')}}" name="name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-3 form-control-label" name="description">Description</label>
                  <div class="col-9">
                    <textarea class="form-control" name="description" rows="5">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                
                <div class="row">

                  <div class="col-4">
                    <div class="checkbox">
                        <label style="font-size: 20px">
                            <input name="administrator" type="checkbox" value="1">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            Administrator
                        </label>
                    </div>  
                  </div>
                  
                  <div class="col-4">
                    <div class="checkbox">
                        <label style="font-size: 20px">
                            <input name="exhibitor" type="checkbox" value="1">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            Exhibitor
                        </label>
                    </div>  
                  </div>

                  <div class="col-4">
                    <div class="checkbox">
                        <label style="font-size: 20px">
                            <input name="registrator" type="checkbox" value="1">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            Registrator
                        </label>
                    </div>  
                  </div>
                
                </div>

                @if ($errors->has('administrator'))
                    <span class="help-block">
                        <strong>{{ $errors->first('administrator') }}</strong>
                    </span>
                @endif
                @if ($errors->has('exhibitor'))
                    <span class="help-block">
                        <strong>{{ $errors->first('exhibitor') }}</strong>
                    </span>
                @endif
                @if ($errors->has('registrator'))
                    <span class="help-block">
                        <strong>{{ $errors->first('registrator') }}</strong>
                    </span>
                @endif
                
            </div>
          </div>

        </form>
          
        
        <div class="card">
          
          <div class="card-close">
            
          </div>
          
          <div class="card-header d-flex align-items-center">
            <h2>ROLES LIST</h2>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="mytable" class="table" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Modules</th>
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
                  "<'row'<'col-12'B>>" +
                  "<'row'<'col-12'tr>>" +
                  "<'row'<'col-3'i><'col-9'p>>",
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
                 { "width": "20%", "targets": 0 },
                 { "width": "30%", "targets": 1 },
                 { "width": "40%", "targets": 2 },
                 { "width": "10%", "targets": 3 }
             ],
             ajax: "{{ route('admin.roles.api') }}",

             columns: [
               {data: 'name', name: 'name'},
               {data: 'description', name: 'description'},
               {data: 'modules', name: 'modules'},
               {data: 'action', name: 'action', orderable:false, searchable:false, printable:false},
             ],
             initComplete: function(settings, json) {$('.loader').fadeOut();}
         });
         $('#searchInput').on( 'keyup', function () {
             table.search( this.value ).draw();
         } );

     });

</script>
@endpush