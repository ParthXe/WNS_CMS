@extends('layouts.admin')


@section('content')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
       <!--  <h1>
          Blog
          <small>Add new post</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href=""><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="">Blog</a></li>
          <li class="active">Add new</li>
        </ol> -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row" style="width: 1000px;">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body ">
                    {!! Form::open(['url' => '/save_message','method'=>'post']) !!}
                   <div class="wrap-input100 {{ $errors->has('body') ? 'has-error' : '' }}">
                        
                              <select id="fetchval" class="fetchval btn dropdown-toggle input100" id="project_id" name="meeting_id">
                                <option value="">Choose Meeting</option>
                                @foreach ($meeting_list as $meeting)
                                        <option value="{{ $meeting->id }}">{{ $meeting->meeting_name }}</option>
                                @endforeach
                              </select>

                        @if($errors->has('meeting_name'))
                            <span class="help-block">{{ $errors->first('meeting_name') }}</span>
                        @endif
                    </div>
                    <div class="wrap-input100{{ $errors->has('title') ? 'has-error' : '' }}">
                        {!! Form::textarea('message', null, ['class' => 'input100', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
                        <span class="focus-input100" c data-placeholder="Message"></span>
                        @if($errors->has('message'))
                            <span class="help-block">{{ $errors->first('message') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {!! Form::label('Add Guest Name:') !!}
                        <div class="field_wrapper">
                          <div>
                        <input type="text" name="guest_name[]" value=""/>
                        <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ asset('dist/images/add-icon.png') }}"/></a>
                      </div>
                        @if($errors->has('guest_name'))
                            <span class="help-block">{{ $errors->first('guest_name') }}</span>
                        @endif
                    </div>

                    <br>

            					{!! Form::submit('create new message',['class'=>'btn sbm_btn']) !!}
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
        var fieldHTML = '<div style="margin-top:5px"><input type="text" name="guest_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src='+"{{ asset('dist/images/remove-icon.png') }}"+' ></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
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
