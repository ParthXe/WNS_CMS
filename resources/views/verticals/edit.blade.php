@extends('layouts.admin')


@section('content')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Blog
          <small>Add new post</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href=""><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="">Blog</a></li>
          <li class="active">Add new</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row" style="width: 1000px;">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body ">
                    {!! Form::open(['url' => '/update_vertical','method'=>'post']) !!}

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                         <label for="userEditMobile">Vertical Name</label>
                          <input type="text" class="form-control @error('vertical_name') is-invalid @enderror" name="vertical_name" value="{{ $vertical_data[0]->vertical_name }}" required autocomplete="name">
                          <input id="projects_sl" type="hidden" class="form-control @error('vertical_name') is-invalid @enderror" name="id" value="{{ $vertical_data[0]->vId }}">

                        @if($errors->has('vertical_name'))
                            <span class="help-block">{{ $errors->first('vertical_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {!! Form::label('Sub varticals:') !!}
                        
                          
                       <div class="field_wrapper">
                        <div style="visibility: hidden;">{{ $i=1 }}</div> 
                        @foreach($vertical_data as $key => $value)
                        
                          <div>
                        <input type="text" name="sub_verticals_name[]" value="{{ $value->sub_vertical_name }}"/><a href="javascript:void(0);" class="remove_button">
                          <input type="hidden" class="form-control" name="sid_{{$i}}" value="{{ $vertical_data[0]->sId }}">
                          <img src="http://192.168.0.111:8000/dist/images/remove-icon.png"></a><br>
                        </div>
                         <div style="visibility: hidden;">{{ $i++ }}</div>
                        @endforeach
                        </div>
                        <input id="rowNumber" type="hidden" class="form-control @error('vertical_name') is-invalid @enderror" name="curCount" value="{{ $vertical_count }}">
                        <input id="rowNumber1" type="hidden" class="form-control @error('vertical_name') is-invalid @enderror" name="prev" value="{{ $vertical_count }}">
                        <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ asset('dist/images/add-icon.png') }}"/></a>
                      
                        @if($errors->has('sub_verticals_name'))
                            <span class="help-block">{{ $errors->first('sub_verticals_name') }}</span>
                        @endif
                    </div>

                    <hr>

            					{!! Form::submit('create new meeting',['class'=>'btn btn-primary']) !!}
            					{!! Form::close() !!}
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        <!-- ./row -->
      </section>
      <!-- /.content -->
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="sub_verticals_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src='+"{{ asset('dist/images/remove-icon.png') }}"+' ></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
         var curCount = $('#rowNumber').val();
         console.log(curCount);
        //Once add button is clicked
        $(addButton).click(function(){
          var curCount = $('#rowNumber').val();

          $('#rowNumber').val( parseInt(curCount) + 1);
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>
@endsection
