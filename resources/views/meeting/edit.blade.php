@extends('layouts.admin')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

   
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
                   <form method="POST" action="{{ route('update_meeting') }}" enctype="multipart/form-data">
                        @csrf

                    <div class="form-group {{ $errors->has('meeting_name') ? 'has-error' : '' }}">
                          <label for="userEditMobile">Meeting Name</label>
                          <input type="text" class="form-control @error('meeting_name') is-invalid @enderror" name="meeting_name" value="{{ $meeting_data[0]->meeting_name }}" required autocomplete="name">
                          <input id="projects_sl" type="hidden" class="form-control @error('meeting_name') is-invalid @enderror" name="id" value="{{ $meeting_data[0]->meetingId }}">

                        @if($errors->has('meeting_name'))
                            <span class="help-block">{{ $errors->first('meeting_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                      <label for="userEditMobile">Meeting Date</label>
                       <input type="text" class="form-control @error('meeting_time') is-invalid @enderror" name="meeting_time" value="{{ $meeting_data[0]->meeting_date }}" required autocomplete="name" id="datetimepicker4">

                        @if($errors->has('meeting_time'))
                            <span class="help-block">{{ $errors->first('meeting_time') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="userEditMobile">Meeting Created</label>
                        <input type="text" class="form-control" name="meeting_created" value="{{ $meeting_data[0]->meeting_created_by }}" readonly>
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                        {!! Form::label('Verticals:') !!}
                              <select id="fetchval" class="fetchval btn dropdown-toggle form-control" id="project_id" name="verticals">
                                 <option value="{{ $verticals_name[0]->verticals_id }}" {{ ( $verticals_name[0]->vertical_name == $verticals_name[0]->vertical_name ) ? 'selected' : '' }}>{{ $verticals_name[0]->vertical_name }}</option>
                                @foreach ($verticals_list as $vertical)
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
                         <option value="{{ $meeting_data[0]->sub_vertical_name }}" {{ ( $meeting_data[0]->sub_vertical_name == $meeting_data[0]->sub_vertical_name ) ? 'selected' : '' }}>{{ $meeting_data[0]->sub_vertical_name }}</option>       
                        </select>
                        
                    </div>
                    




                    <div id="bookForm">
                      
                      <div class="box box-solid">
                       <div style="visibility: hidden;">{{$i=1}}</div>
                      @foreach($meeting_assets as $key => $value)
                     
                      <div class="box-body">
                        <div class="form-group">
                          <label for="userEditMobile">Folder Name</label>
                          <input type="text" class="form-control" name="folder_name_{{$i}}" value="{{$value->folder_name}}" >
                          <input type="hidden" class="form-control" name="asset_id_{{$i}}" value="{{ $value->id }}">
                        </div>  
                        <div class="form-group">
                          <label for="userEditMobile">Meeting Assets</label>
                          <input type="file" class="form-control" name="files_{{$i}}[]" placeholder="Trends Title" value="" multiple>
                          <?php
                          $array = explode(',', $value->asset_data);
                          $path = URL::to('/').'/uploads/meeting/'.$value->folder_name.'/'; 
                          foreach($array as $asset)
                          {
                            $ext = pathinfo($asset, PATHINFO_EXTENSION);
                            if($ext=='jpg' || $ext=='jpeg')
                            {
                              echo '<img src="'.$path.$asset.'" width="200px" style="padding:10px; top="0px"><a href="#" onclick="imageRemove('."'".$asset."'".','."'".$value->id."'".')"><i class="fa fa-times" aria-hidden="true"></i></a>';
                            }
                            elseif ($ext=='pdf') {
                             echo '<b style="padding:10px">'.$asset.'</b><a href="#" onclick="imageRemove('."'".$asset."'".','."'".$value->id."'".')"><i class="fa fa-times" aria-hidden="true"></i></a>';
                            }
                            elseif ($ext=='mp4') {
                             echo '<video width="200" height="150" controls style="padding:10px">
                              <source src="'.$path.$asset.'" type="video/mp4">
                            </video><a href="#" onclick="imageRemove('."'".$asset."'".','."'".$value->id."'".')"><i class="fa fa-times" aria-hidden="true"></i></a>';
                            }

                            
                          }
                           ?>
                        </div>

                        <div class="form-group col-sm-12">
                          <button onClick="decrementValue()" type="button" class="btn btn-danger removeButton">Remove</button>
                        </div>
                      </div>
                      <div style="visibility: hidden;">{{$i++}}</div>
                      @endforeach
                      
                    </div>



                  <div class="form-group box box-default hide" id="bookTemplate">
                        <div class="box-header with-border">

                        </div>                
                    <div class="box box-solid">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="userEditMobile">Folder Name</label>
                          <input type="text" class="form-control" name="folder_name" value="" >
                        </div>  
                        <div class="form-group">
                          <label for="userEditMobile">Meeting Assets</label>
                          <input type="file" class="form-control" name="files[]" placeholder="Trends Title" value="" multiple>
                        </div>

                        <div class="form-group col-sm-12">
                          <button onClick="decrementValue()" type="button" class="btn btn-danger removeButton">Remove</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="button" class="btn btn-success addButton">Add Folder</button>
                    <input type="hidden" id="rowNumber" name="count" value="{{$asset_count}}"/>
                    <input type="hidden" id="rowNumber1" name="prevcount" value="{{$asset_count}}"/>
                  </div>
                </div>

                    <hr>

          {!! Form::submit('Update meeting',['class'=>'btn btn-primary']) !!}
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
