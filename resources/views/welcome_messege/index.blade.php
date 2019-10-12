 
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
              <a href=""><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="">Blog</a></li>
          <li class="active">All Verticals</li>
        </ol> -->
      </section>

      <!-- Main content -->
      <section class="content" style="width: 1200px">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('create_message') }}" class="btn btn-success">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    @if(session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (! $welcome_messages_count)
                        <div class="alert alert-danger">
                            <strong>No record found</strong>
                        </div>
                    @else
                    <div style="visibility: hidden; margin-bottom: 50px;">{{ $i=1 }}</div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="80">Sr.</th>
                                    <th width="120">Welcome Message</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($welcome_messages as $welcome)

                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $welcome->welcome_message }}</td>

                                        <td>
                                            <a href="/edit_message/{{ $welcome->id }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/delete_message/{{ $welcome->id }}" class="btn btn-xs btn-danger">
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