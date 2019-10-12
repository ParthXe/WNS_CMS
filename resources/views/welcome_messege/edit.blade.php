@extends('layouts.admin')


@section('content')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <!--   <h1>
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
                    {!! Form::open(['url' => '/update_message','method'=>'post']) !!}
                      <input id="projects_sl" type="hidden" class="input100 @error('meeting_name') is-invalid @enderror" name="id" value="{{ $message[0]->wid }}">
                    <div class="wrap-input100 {{ $errors->has('body') ? 'has-error' : '' }}">

                      <select id="fetchval" class="fetchval btn dropdown-toggle input100" name="meeting_id">
                     <option value="{{ $message[0]->meeting_id }}" {{ ( $message[0]->meeting_name == $message[0]->meeting_name ) ? 'selected' : '' }}>{{ $message[0]->meeting_name }}</option>
                      @foreach ($meeting_list as $meeting)
                      <option value="{{ $meeting->id }}">{{ $meeting->meeting_name }}</option>
                      @endforeach
                      </select>

                      @if($errors->has('meeting_id'))
                      <span class="help-block">{{ $errors->first('meeting_id') }}</span>
                      @endif
                    </div>
                    <div class="wrap-input100 {{ $errors->has('title') ? 'has-error' : '' }}">

                        
                          <input type="text" class="input100 @error('welcome_message') is-invalid @enderror" name="message" value="{{ $message[0]->welcome_message }}" required autocomplete="name" placeholder="welcome_message">

                        @if($errors->has('welcome_message'))
                            <span class="help-block">{{ $errors->first('welcome_message') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {!! Form::label('Guest List:') !!}
                        
                          
                       <div class="field_wrapper">
                        <div style="visibility: hidden;">{{ $i=1 }}</div> 
                        <?php $guest_name = explode(',', $message[0]->guest_name); ?>
                        @foreach($guest_name as $guest)
                        
                          <div>
                        <input type="text" name="guest_name[]" value="{{ $guest }}"/><a href="javascript:void(0);" class="remove_button">
                          
                          <img src="http://192.168.0.111:8000/dist/images/remove-icon.png"></a><br>
                        </div>
                         <div style="visibility: hidden;">{{ $i++ }}</div>
                        @endforeach
                        </div>
                         <input id="rowNumber" type="hidden" class="form-control @error('vertical_name') is-invalid @enderror" name="curCount" value="{{ $message_count }}">
                        <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ asset('dist/images/add-icon.png') }}"/></a>
                      
                        @if($errors->has('guest_name'))
                            <span class="help-block">{{ $errors->first('guest_name') }}</span>
                        @endif
                    </div>

                    <br>

            					{!! Form::submit('update message',['class'=>'btn sbm_btn']) !!}
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
        var fieldHTML = '<div><input type="text" name="guest_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src='+"{{ asset('dist/images/remove-icon.png') }}"+' ></a></div>'; //New input field html 
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
