
@extends('layouts.app')
@push('title') 
  SUBEVENT LIST
@endpush

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
              <a href="/admin/filemaintenance/product/create" class="btn btn-sm btn-primary" style="margin:0px !important;">Create New <i class="fa fa-plus" aria-hidden="true"></i></a>
              
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Product Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="product_table" class="table" cellspacing="0" width="100%">
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