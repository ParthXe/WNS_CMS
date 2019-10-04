 
@extends('layouts.admin')


@section('content')
 <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Blog
          <small>Display All blog posts</small>
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href=""><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="">Blog</a></li>
          <li class="active">All Verticals</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{ route('create_vertical') }}" class="btn btn-success">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    @if(session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (! $verticals_count)
                        <div class="alert alert-danger">
                            <strong>No record found</strong>
                        </div>
                    @else
                    <div style="display: none;">{{ $i=1 }}</div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="80">Sr.</th>
                                    <th width="120">Vertical Name</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($verticals_name as $vertical)

                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $vertical->vertical_name }}</td>

                                        <td>
                                            <a href="/edit_vertical/{{ $vertical->id }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/delete/{{ $vertical->id }}" class="btn btn-xs btn-danger">
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