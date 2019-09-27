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
                       {!! Form::text('verticals',null,['class' => 'form-control']) !!}

                        @if($errors->has('verticals'))
                            <span class="help-block">{{ $errors->first('verticals') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                        {!! Form::label('Subverticals:') !!}
                        {!! Form::text('subverticals',null,['class' => 'form-control']) !!}

                        @if($errors->has('subverticals'))
                            <span class="help-block">{{ $errors->first('subverticals') }}</span>
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
		$(function() {
		  $('#datetimepicker4').datetimepicker();

		});
        </script>
@endsection
