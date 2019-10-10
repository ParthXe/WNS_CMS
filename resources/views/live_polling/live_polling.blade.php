@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ __('Create Live Poll') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store_live_polling') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required autocomplete="name" autofocus>

                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="optionA" class="col-md-4 col-form-label text-md-right">{{ __('Option A') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="optionA" type="text" class="form-control @error('optionA') is-invalid @enderror" name="optionA" value="{{ old('optionA') }}" required autocomplete="name" autofocus>

                                @error('optionA')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="optionB" class="col-md-4 col-form-label text-md-right">{{ __('Option B') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="optionB" type="text" class="form-control @error('optionB') is-invalid @enderror" name="optionB" value="{{ old('optionB') }}" required autocomplete="name" autofocus>

                                @error('optionA')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="optionC" class="col-md-4 col-form-label text-md-right">{{ __('Option C') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="optionC" type="text" class="form-control @error('optionC') is-invalid @enderror" name="optionC" value="{{ old('optionC') }}" autocomplete="name" autofocus>

                                @error('optionC')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="optionD" class="col-md-4 col-form-label text-md-right">{{ __('Option D') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="optionD" type="text" class="form-control @error('optionD') is-invalid @enderror" name="optionD" value="{{ old('optionD') }}" autocomplete="name" autofocus>

                                @error('optionD')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

<!--                         <div class="form-group row">
                            <label for="optionE" class="col-md-4 col-form-label text-md-right">{{ __('Option E') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="optionE" type="text" class="form-control @error('optionE') is-invalid @enderror" name="optionE" value="{{ old('optionE') }}" autocomplete="name" autofocus>

                                @error('optionE')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        
<!--                          <div class="form-group row">
                            <label for="optionF" class="col-md-4 col-form-label text-md-right">{{ __('Option F') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="optionF" type="text" class="form-control @error('optionF') is-invalid @enderror" name="optionF" value="{{ old('optionF') }}" autocomplete="name" autofocus>

                                @error('optionF')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         -->
<!--                          <div class="form-group row">
                            <label for="poll_id" class="col-md-4 col-form-label text-md-right">{{ __('Poll Id') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="poll_id" type="text" class="form-control @error('poll_id') is-invalid @enderror" name="poll_id" value="{{ old('poll_id') }}" required autocomplete="name" autofocus>

                                @error('poll_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="event_active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <label class="container1">
                                <input type="checkbox" name="active" id="event_active">
                                <span class="checkmark"></span>
                                </label>
                            </div>
                              <input id="session_count" type="hidden" name="session_count" value="1">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    /*$('#datetimepicker').datetimepicker({
      inline: true,
      sideBySide: true,
      //theme:'dark'
    });*/

    /*$(document).ready(function(){
      $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        minTime: '10',
        maxTime: '6:00pm',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
      });
    });*/
    var max_fields = 9;
    var min_fields = 1;
    var count,m,n;
    var wrapper = $("#wrapper");
    var add_button = $(".add_form_field");
    var delete_button = $(".delete");

    var x = 1;

    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            var html=`<div class="col-md-12 event_session`+x+`" style="float:left;padding:0!important;margin-top: 2%;">
            <span style="font-weight:800;margin-right:2%;float:left;">`+x+`.</span>
            <select id="event_session`+x+`_from" class="" name="event_session`+x+`_from" style="width:38%;float:left;margin-right:4%;">
              <option value="00:00">00:00</option>
              <option value="00:30">00:30</option>
              <option value="01:00">01:00</option>
              <option value="01:30">01:30</option>
              <option value="02:00">02:00</option>
              <option value="02:30">02:30</option>
              <option value="03:00">03:00</option>
              <option value="03:30">03:30</option>
              <option value="04:00">04:00</option>
              <option value="04:30">04:30</option>
              <option value="05:00">05:00</option>
              <option value="05:30">05:30</option>
              <option value="06:00">06:00</option>
              <option value="06:30">06:30</option>
              <option value="07:00">07:00</option>
              <option value="07:30">07:30</option>
              <option selected value="08:00">08:00</option>
              <option value="08:30">08:30</option>
              <option value="09:00">09:00</option>
              <option value="09:30">09:30</option>
              <option value="10:00">10:00</option>
              <option value="10:30">10:30</option>
              <option value="11:00">11:00</option>
              <option value="11:30">11:30</option>
              <option value="12:00">12:00</option>
              <option value="12:30">12:30</option>
              <option value="13:00">13:00</option>
              <option value="13:30">13:30</option>
              <option value="14:00">14:00</option>
              <option value="14:30">14:30</option>
              <option value="15:00">15:00</option>
              <option value="15:30">15:30</option>
              <option value="16:00">16:00</option>
              <option value="16:30">16:30</option>
              <option value="17:00">17:00</option>
              <option value="17:30">17:30</option>
              <option value="18:00">18:00</option>
              <option value="18:30">18:30</option>
              <option value="19:00">19:00</option>
              <option value="19:30">19:30</option>
              <option value="20:00">20:00</option>
              <option value="20:30">20:30</option>
              <option value="21:00">21:00</option>
              <option value="21:30">21:30</option>
              <option value="22:00">22:00</option>
              <option value="22:30">22:30</option>
              <option value="23:00">23:00</option>
              <option value="23:30">23:30</option>
            </select>
            <select id="event_session`+x+`_to" class="" name="event_session`+x+`_to" style="width:38%;">
              <option value="00:00">00:00</option>
              <option value="00:30">00:30</option>
              <option value="01:00">01:00</option>
              <option value="01:30">01:30</option>
              <option value="02:00">02:00</option>
              <option value="02:30">02:30</option>
              <option value="03:00">03:00</option>
              <option value="03:30">03:30</option>
              <option value="04:00">04:00</option>
              <option value="04:30">04:30</option>
              <option value="05:00">05:00</option>
              <option value="05:30">05:30</option>
              <option value="06:00">06:00</option>
              <option value="06:30">06:30</option>
              <option value="07:00">07:00</option>
              <option value="07:30">07:30</option>
              <option selected value="08:00">08:00</option>
              <option value="08:30">08:30</option>
              <option value="09:00">09:00</option>
              <option value="09:30">09:30</option>
              <option value="10:00">10:00</option>
              <option value="10:30">10:30</option>
              <option value="11:00">11:00</option>
              <option value="11:30">11:30</option>
              <option value="12:00">12:00</option>
              <option value="12:30">12:30</option>
              <option value="13:00">13:00</option>
              <option value="13:30">13:30</option>
              <option value="14:00">14:00</option>
              <option value="14:30">14:30</option>
              <option value="15:00">15:00</option>
              <option value="15:30">15:30</option>
              <option value="16:00">16:00</option>
              <option value="16:30">16:30</option>
              <option value="17:00">17:00</option>
              <option value="17:30">17:30</option>
              <option value="18:00">18:00</option>
              <option value="18:30">18:30</option>
              <option value="19:00">19:00</option>
              <option value="19:30">19:30</option>
              <option value="20:00">20:00</option>
              <option value="20:30">20:30</option>
              <option value="21:00">21:00</option>
              <option value="21:30">21:30</option>
              <option value="22:00">22:00</option>
              <option value="22:30">22:30</option>
              <option value="23:00">23:00</option>
              <option value="23:30">23:30</option>
            </select>`;
            //console.log(html);
            $(wrapper).append(html); //add input box
            $('#session_count').val(x);
        }
        else
        {
            alert('You Reached the limits')
        }
    });

    $(delete_button).click(function(e) {
        e.preventDefault();
        var count=$('#session_count').val();
        x=count;
        if (x > min_fields)
        {
          n=x-1;
          $('.event_session'+x).remove();
          $('#session_count').val(n);
        }
        else{
          alert('Atleast One Session Needs to be scheduled')
        }
    });
</script>
@endsection
