@extends('layouts.admin')

@section('content')
<div class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;">
    <a class="btn" style="background: #0071b9;color: #fff;" href="{{ route('create_live_polling') }}"> Create New Live Poll</a>
</div>
    <div id="table-container" class="" style="padding: 45px 23px;">
    <div class="card-header"><b>{{ __('List of Live Polls') }}</b></div>
    <div class="table-responsive">          
    <table class="table table-bordered">
        <tr>
            <!--th>Id</th-->
            <th>Question</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Option D</th>
            <th width="175px">Action</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($live_pollings as $live_polling)
        <tr>
            <!--td>{{ $i++}}</td-->
            <td>{{ $live_polling->question}}</td>
            <td>{{ $live_polling->optionA }}</td>
            <td>{{ $live_polling->optionB }}</td>
            <td>{{ $live_polling->optionC }}</td>
            <td>{{ $live_polling->optionD }}</td>
            <td>
                <form action="" method="POST">

                    <!--a class="btn" style="background:#009472;color:#fff" href="#">Show</a-->



                    <a class="btn btn-primary" href="{{ route('edit_live_polling',$live_polling->id) }}">Edit</a>



                    <a class="btn btn-danger" href="{{ route('delete_live_polling',$live_polling->id) }}">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  </div>
 </div>

@endsection
