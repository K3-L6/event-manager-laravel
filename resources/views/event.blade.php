@extends('layouts.app')

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')
<ul class="breadcrumb">
  <div class="container-fluid">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active">Event</li>
    <form action="/event/entrance" method="get">
      <button class="btn btn-primary float-right" style="width: 300px; margin-left: 1%; margin-right: 1%;">START LOGGING</button>
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

<form action="/admin/event" method="post" enctype="multipart/form-data">
  @csrf
  @method('put')

  <div class="container" style="padding-top: 3%;">
    
    <div class="col-md-12 mx-auto">
    
      <div class="card">
        
        <div class="card-close">    
          
        </div>

        <div class="card-header d-flex align-items-center">
          <h2>EVENT DETAILS</h2>
        </div>
        
        <div class="card-body">
          
          <div class="col-sm-12">
            <span class="btn-file">
              <div class="preview_panel" id="preview_panel">
                <h1 style="font-family: {{$event->title_font}}; font-size: {{$event->title_size}}vmin; color: {{$event->title_color}};">{{$event->title}}</h1>
                <p style="font-family: {{$event->description_font}}; font-size: {{$event->description_size}}vmin; color: {{$event->description_color}};">{{$event->description}}</p>
              </div>    
              <img id="img_preview" src="{{ asset('img/event/' . $event->background) }}">
              <input type="file" name="img" id="img_upload">
            </span>  
          </div>
        
           <div class="form-group row" style="margin-top: 3%;">
            <label class="col-sm-12 form-control-label" name="title">Title</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="title_field" value="{{old('title', $event->title)}}" name="title">
              <div class="row preview_selection">
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="title_font" value="{{old('title_font', $event->title_font)}}" name="title_font">
                </div>
                <div class="col-sm-2">
                  <input type="number" min="0" id="title_font_size" class="form-control" value="{{old('title_size', $event->title_size)}}" name="title_size">
                </div>
                <div class="col-sm-2">
                  <input type="text" min="0" id="title_font_color" class="form-control" value="{{old('title_color', $event->title_color)}}" name="title_color">
                </div>
              </div>
              @if ($errors->has('title'))
                  <span class="help-block">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
              @endif
            </div>
           </div>


            <div class="form-group row">
              <label class="col-sm-12 form-control-label">Description</label>
              <div class="col-sm-12">
                <textarea class="form-control" rows="5" id="description_field" name="description">{{old('description', $event->description)}}</textarea>
                <div class="row preview_selection">
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="description_font" value="{{old('description_font', $event->description_font)}}" name="description_font">
                  </div>
                  <div class="col-sm-2">
                    <input type="number" min="0" id="description_font_size" class="form-control" value="{{old('description_size', $event->description_size)}}" name="description_size">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" min="0" id="description_font_color" class="form-control" value="{{old('description_color', $event->description_color)}}" name="description_color">
                  </div>
                </div>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
              </div>
            </div>


            <button type="submit" class="btn btn-primary btn-block">SAVE CHANGES</button>

        </div>
      </div>
    </div>

  </div>

</form>

@endsection

@push('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
        $(function(){
          $('#title_font').fontselect().change(function(){
            // replace + signs with spaces for css
            var font = $(this).val().replace(/\+/g, ' ');
            // split font into family and weight
            font = font.split(':');
            // set family on paragraphs
            $('#preview_panel > h1').css('font-family', font[0]);
          });
        });
        $(function(){
          $('#description_font').fontselect().change(function(){
            // replace + signs with spaces for css
            var font = $(this).val().replace(/\+/g, ' ');
            // split font into family and weight
            font = font.split(':');
            // set family on paragraphs
            $('#preview_panel > p').css('font-family', font[0]);
          });
        });
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#img_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }
        $("#img_upload").change(function() {
          readURL(this);
        });
        $("#title_field").keyup(function(){
          var title = $('#title_field').val();
          $('#preview_panel > h1').text(title);
        });
        $("#description_field").keyup(function(){
          var title = $('#description_field').val();
          $('#preview_panel > p').text(title);
        });
        $("#title_font_size").bind('keyup mouseup', function(){
          var size = $('#title_font_size').val();
          $('#preview_panel > h1').css('font-size', size + 'vmin');  
        });
        $("#description_font_size").bind('keyup mouseup', function(){
          var size = $('#description_font_size').val();
          $('#preview_panel > p').css('font-size', size + 'vmin');
        });
        $("#title_font_color").keyup(function(){
          var color = $('#title_font_color').val();
          $('#preview_panel > h1').css('color', color);  
        });
        $("#description_font_color").keyup(function(){
          var color = $('#description_font_color').val();
          $('#preview_panel > p').css('color', color);  
        });
    });
    // vanila javascripts
    var description_font_size = document.getElementById('description_font_size');
    description_font_size.onkeydown = function(e) {
        if(!((e.keyCode > 95 && e.keyCode < 106)
          || (e.keyCode > 47 && e.keyCode < 58) 
          || e.keyCode == 8)) {
            return false;
        }
    }
    var title_font_size = document.getElementById('title_font_size');
    title_font_size.onkeydown = function(e) {
        if(!((e.keyCode > 95 && e.keyCode < 106)
          || (e.keyCode > 47 && e.keyCode < 58) 
          || e.keyCode == 8)) {
            return false;
        }
    }
  </script>
@endpush
