
@if (count($errors)) 
        {{-- @foreach($errors->all() as $error)
        	<div class="alert alert-danger" style="margin: 0px !important; text-align: center;">
        		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            	{!! $error !!}
        	</div> 
        @endforeach --}} 
        <div class="alert alert-danger" style="margin: 0px !important; text-align: center;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! $errors->first() !!}
        </div> 
@endif

@if(session('success'))
   <div class="alert alert-success" style="margin: 0px !important; text-align: center;">
   		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!!session('success')!!}
   </div>
@endif

@if(session('error'))
   <div class="alert alert-danger" style="margin: 0px !important; text-align: center;">
   		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!!session('error')!!}
   </div>
@endif

