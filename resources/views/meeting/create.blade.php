@extends('layouts.admin')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
 <script>
    $(document).ready(function()
                     {
        $("#fetchval").on('change',function()
        {
           	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var keyword = $(this).val();
            $.ajax(
            {

                url:"{{ route('fetch_sub_vertical') }}",
                type:'POST',
                //data:'test='+keyword,
                //dataType: 'JSON',
                data: {_token: CSRF_TOKEN, message:$(".fetchval").val()},
                // beforeSend:function()
                // {

                //     $("#table-container").html('Working...');

                // },
                success:function(data)
                {
                	var div1,name,sid;
                    //console.log(data);
                   	var len=data.sub_verticals.length;
                   	//console.log(len);
                   	var div = document.getElementById('subverticals');
                   	for(var i=0;i<len;i++)
                    {
                    	 name = data.sub_verticals[i].sub_vertical_name;
                    	 sid = data.sub_verticals[i].id;
                    	 div1 +='<option value="'+sid+'">'+name+'</option>';
                    	 
                    } 
                    //console.log(div1);
                    div.innerHTML=div1;
                    //alert(temp[0]['project_name']);
                    //$("#table-container").html(data);
                   
                },
            });
        });
    });

</script>
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
	                	 <!-- /.box-header -->
	        <div class="box-body ">
	            @if(session('message'))
	                <div class="alert alert-info btn btn-success">
	                    {{ session('message') }}
	                </div>
	            @endif
	        </div>
        </ol>

      </section>

      <!-- Main content -->
      <section class="content">	
          <div class="row" style="width: 1000px;">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-body ">
                    {!! Form::open(['url' => '/save_data','method'=>'post']) !!}

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        {!! Form::label('Meeting Name:') !!}
                        {!! Form::text('meeting_name',null,['class' => 'form-control']) !!}

                        @if($errors->has('meeting_name'))
                            <span class="help-block">{{ $errors->first('meeting_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {!! Form::label('Meeting Date:') !!}
                        {!! Form::text('meeting_time',null,['class' => 'form-control','id' => 'datetimepicker4']) !!}

                        @if($errors->has('meeting_time'))
                            <span class="help-block">{{ $errors->first('meeting_time') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Meeting Created By:') !!}
                        {!! Form::text('meeting_created',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                        {!! Form::label('Verticals:') !!}
                              <select id="fetchval" class="fetchval btn dropdown-toggle form-control" id="project_id" name="verticals">
                              	<option value="">Choose Vertical</option>
                                @foreach ($verticals_name as $vertical)
                                        <option value="{{ $vertical->id }}">{{ $vertical->vertical_name }}</option>
                                @endforeach
                              </select>

                        @if($errors->has('verticals'))
                            <span class="help-block">{{ $errors->first('verticals') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                        {!! Form::label('Subverticals:') !!}
                        <select id="subverticals" class="fetchval btn dropdown-toggle form-control" id="project_id" name="subverticals">
                              	
                        </select>

                        
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
		$(function() {
		  $('#datetimepicker4').datetimepicker();

		});
        </script>
@endsection
