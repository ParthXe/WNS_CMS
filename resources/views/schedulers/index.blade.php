@extends('layouts.admin')
@section('content')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<style>
.content-wrapper {
  background: transparent!important;
}
</style>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            header: {
                left: 'prev,next,today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'agendaWeek',
            events : [
                @foreach($schedules as $schedule)
                {
                    title : '{{ $schedule->content }}',
                    start : '{{ $schedule->start_time }}',
                    @if ($schedule->finish_time)
                            end: '{{ $schedule->finish_time }}',
                    @endif
                },
                @endforeach
            ],
            eventClick: function(calEvent, jsEvent, view) {
                $('#start_time').val(moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss'));
                $('#finish_time').val(moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss'));
                $('#editModal').modal();
            }
        });
    });
</script>
<div class="content-wrapper" style="margin-left: 0px!important;">
  <div class="row" style="margin-left:7.5px!important;margin-right:7.5px!important;">
      <div class="box">
        <div class="box-header" style="margin-top: 1%;margin-bottom:4%;">
            <div class="pull-right">
                <a href="{{ route('create_vertical') }}" class="btn btn-success">Add New</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body ">
          <div id='calendar'></div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-body">
                      <h4>Edit Appointment</h4>

                      Start time:
                      <br />
                      <input type="text" class="form-control" name="start_time" id="start_time">

                      End time:
                      <br />
                      <input type="text" class="form-control" name="finish_time" id="finish_time">
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="button" class="btn btn-primary" id="appointment_update" value="Save">
                  </div>
              </div>
          </div>
        </div>
      </div>
</div>
</div>
</div>
@endsection
