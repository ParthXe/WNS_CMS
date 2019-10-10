@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Select Live Poll</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_live_polling',$live_pollings[0]->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ $live_pollings[0]->question }}" required autocomplete="name" autofocus>

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
                                <input id="optionA" type="text" class="form-control @error('optionA') is-invalid @enderror" name="optionA" value="{{ $live_pollings[0]->optionA }}" required autocomplete="name" autofocus>

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
                                <input id="optionB" type="text" class="form-control @error('optionB') is-invalid @enderror" name="optionB" value="{{ $live_pollings[0]->optionB }}" required autocomplete="name" autofocus>

                                @error('optionB')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="optionC" class="col-md-4 col-form-label text-md-right">{{ __('Option C') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="optionC" type="text" class="form-control @error('optionC') is-invalid @enderror" name="optionC" value="{{ $live_pollings[0]->optionC }}" autocomplete="name" autofocus>

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
                                <input id="optionD" type="text" class="form-control @error('optionD') is-invalid @enderror" name="optionD" value="{{ $live_pollings[0]->optionD }}"  autocomplete="name" autofocus>

                                @error('optionD')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="live_polling_active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <label class="container1">
                                <input type="checkbox" name="active" {{ ( $live_pollings[0]->active == 1 ) ? 'checked=checked' : '' }}>
                                <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                      {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
