
@extends('layouts.app')
@push('title') 
  EVENT DETAILS
@endpush

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')

<form action="/admin/event" method="post" enctype="multipart/form-data">
  @csrf
  @method('put')

  <div class="container" style="padding-top: 3%;">
    
    <div class="row">

        <div class="col-md-10 mx-auto">
        
          {{-- Event Details --}}
          <div class="card">
 
            <div class="card-header d-flex align-items-center">
              <div class="card-close">
              </div>
            </div>
            <div class="card-body">
              
              <div class="col-sm-12">
                <span class="btn-file">
                  <div class="preview_panel" id="preview_panel">
                    <h1 style="font-family: {{$event->title_font}}; font-size: {{$event->title_size}}px;">{{$event->title}}</h1>
                    <p style="font-family: {{$event->description_font}}; font-size: {{$event->description_size}}px;">{{$event->description}}</p>
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
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title_font" value="{{$event->title_font}}" name="title_font">
                    </div>
                    <div class="col-sm-3">
                      <input type="number" min="0" id="title_font_size" class="form-control" value="{{$event->title_size}}" name="title_size">
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
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="description_font" value="{{$event->description_font}}" name="description_font">
                      </div>
                      <div class="col-sm-3">
                        <input type="number" min="0" id="description_font_size" class="form-control" value="{{$event->description_size}}" name="description_size">
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
          $('#preview_panel > h1').css('font-size', size + 'px');  
        });

        $("#description_font_size").bind('keyup mouseup', function(){
          var size = $('#description_font_size').val();
          $('#preview_panel > p').css('font-size', size + 'px');
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
