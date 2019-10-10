@extends('layouts.admin')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   
    $(document).ready(function()
                     {
        $("#fetchval").on('change',function()
        {
           
            var keyword = $(this).val();
            $.ajax(
            {

                url:"/fetch_vertical",
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
                    var name1 = data.sub_verticals[0]['sub_vertical_name'];
                    var fname = name1.split(",");
                    var len=fname.length;
                    //console.log(fname);
                    var div = document.getElementById('subverticals');
                    for(var i=0;i<len;i++)
                    {
                       name = fname[i];
                       div1 +='<option value="'+name+'">'+name+'</option>';
                       
                    } 
                    //console.log(div1);
                    div.innerHTML=div1;
                    //alert(temp[0]['project_name']);
                    //$("#table-container").html(data);
                   
                },
            });
        });

    var bookIndex = $('#rowNumber').val();
    $('#bookForm')

        // Add button click handler
        .on('click', '.addButton', function() {

          
            var curCount = $('#rowNumber').val();

            $('#rowNumber').val( parseInt(curCount) + 1);

              bookIndex++;
              var $template = $('#bookTemplate'),
                  $clone    = $template
                                  .clone()
                                  .removeClass('hide')
                                  .removeAttr('id')
                                  .attr('data-book-index', bookIndex)
                                  .insertBefore($template);

              // Update the name attributes
              $clone
                //.find('[name="userfile[]"]').attr('name', 'userfile_' + bookIndex + '[]').end()
                .find('[name="files[]"]').attr('name', 'files_' + bookIndex + '[]').end()
                .find('[name="folder_name"]').attr('name', 'folder_name_' + bookIndex + '').end()
                


        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');

            // Remove fields
            $('#bookTemplate')
  

            // Remove element containing the fields
            $row.remove();
        });


    });

        // Add varient count
function incrementValue() {
  var value = parseInt(document.getElementById('rowNumber').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('rowNumber').value = value;
}

function decrementValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value--;
  document.getElementById('number').value = value;
}
function imageRemove(img,id)
{
    $.ajax({
         type: "POST",
        url:"{{ route('remove_image') }}",
        data: {_token: CSRF_TOKEN, image_name:img, asset_id:id},
         success: function(data){
              alert(data);
                 location.reload();
              }
          });
}

</script>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <!-- <h1>
          Blog
          <small>Add new post</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href=""><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="">Blog</a></li>
          <li class="active">Add new</li> -->
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
                    {!! Form::open(['url' => '/save_data','method'=>'post','enctype'=>'multipart/form-data']) !!}

                    <div class="wrap-input100 {{ $errors->has('title') ? 'has-error' : '' }}">
                        {!! Form::text('meeting_name',null,['class' => 'input100']) !!}
                        <span class="focus-input100" c data-placeholder="Meeting Name"></span>
                        @if($errors->has('meeting_name'))
                            <span class="help-block">{{ $errors->first('meeting_name') }}</span>
                        @endif
                    </div>

                    <div class="wrap-input100 {{ $errors->has('slug') ? 'has-error' : '' }}">
                        
                        {!! Form::text('meeting_time',null,['class' => 'input100','id' => 'datetimepicker4']) !!}
                        <span class="focus-input100" c data-placeholder="Meeting Date"></span>
                        @if($errors->has('meeting_time'))
                            <span class="help-block">{{ $errors->first('meeting_time') }}</span>
                        @endif
                    </div>
                    <div class="wrap-input100">
                        {!! Form::label('Meeting Created By:') !!}
                        {!! Form::text('meeting_created',Auth::user()->name,['class' => 'input100','readonly'=>'true']) !!}
                    </div>
                    <div class="wrap-input100 {{ $errors->has('body') ? 'has-error' : '' }}">
                        
                              <select id="fetchval" class="fetchval btn dropdown-toggle input100" id="project_id" name="verticals">
                              	<option value="">Choose Vertical</option>
                                @foreach ($verticals_name as $vertical)
                                        <option value="{{ $vertical->id }}">{{ $vertical->vertical_name }}</option>
                                @endforeach
                              </select>

                        @if($errors->has('verticals'))
                            <span class="help-block">{{ $errors->first('verticals') }}</span>
                        @endif
                    </div>
                    <div class="wrap-input100 {{ $errors->has('published_at') ? 'has-error' : '' }}">
                        
                        <select id="subverticals" class="fetchval btn dropdown-toggle input100" id="project_id" name="subverticals">
                         <option value="">Subverticals</option>     	
                        </select>
                        
                    </div>
                               <div id="bookForm">
									
									<div class="form-group box box-default hide" id="bookTemplate">
								        <div class="box-header with-border">

								        </div>								
										<div class="box box-solid">
											<div class="box-body">
												<div class="wrap-input100">
													
													<input type="text" class="input100" name="folder_name" value="" >
                          <span class="focus-input100" c data-placeholder="Folder Name"></span>
												</div>	
												<div class="wrap-input100">
													
													<input type="file" class="input100" name="files[]" placeholder="Trends Title" value="" multiple>
												</div>

												<div class="form-group col-sm-12">
													<button onClick="decrementValue()" type="button" class="btn btn-danger removeButton">Remove</button>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<button type="button" onClick="incrementValue()" class="btn btn-success addButton">Add Folder</button>
										<input type="hidden" id="number" name="count" value="0"/>
									</div>
								</div>

                    <br>

					{!! Form::submit('create new meeting',['class'=>'btn sbm_btn']) !!}
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
