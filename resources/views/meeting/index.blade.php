 
@extends('layouts.admin')
<style type="text/css">
  table{
  color: #fff !important;
}

table th{
  background-color: #C11A2C !important;

}
</style>

@section('content')
 <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <!-- <h1>
          Blog
          <small>Display All blog posts</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="">Blog</a></li>
          <li class="active">All Meetings</li>
        </ol> -->
      </section>

      <!-- Main content -->
      <section class="content" style="width: 1200px">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('create') }}" class="btn btn-success">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    @if(session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (! $meeting_count)
                        <div class="alert alert-danger">
                            <strong>No record found</strong>
                        </div>
                    @else
                    <div style="visibility: hidden; margin-bottom: 50px;">{{ $i=1 }}</div>
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th width="80">Sr.</th>
                                    <th width="500">Meeting Name</th>
                                    <th width="300">Verticals</th>
                                    <th width="80">Date</th>
                                     <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($meeting_list as $meeting)

                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $meeting->meeting_name }}</td>
                                        <td>{{ $meeting->vertical_name }}</td>
                                        <td>{{ $meeting->meeting_date }}</td>

                                        <td>
                                            <a href="/edit/{{ $meeting->meetingId }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/delete/{{ $meeting->meetingId }}" class="btn btn-xs btn-danger">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        @endif
                </div>

              </div>
              <!-- /.box -->
            </div>
          </div>
        <!-- ./row -->
      </section>
      <!-- /.content -->
    </div>
    @endsection