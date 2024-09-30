@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Inappropriate Reports</li>
@stop

@section('content')
<h3 class="page-title">Inappropriate Reports
    <small>View all the Projects Inappropriate Reports</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-envelope font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Reports</span>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="javascript:;" onclick="$('#search_filter').toggle();"><i class="fa fa-search" aria-hidden="true"></i> Filter</a>&nbsp;
                    <a class="btn btn-info" href="?"><i class="glyphicon glyphicon-repeat"></i> Reset</a>
                </div>
            </div>
            {{-- {{ $data }} --}}
            <div class="portlet-body form" id="search_filter" style="display: none;">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" action="" method="GET">
                    <input type="hidden" name="search_filter" value="1">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Title</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="title" placeholder="Project Name" value="">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Subject</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject" value="">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn green">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>

                                <tr>
                                    <th class="bold"> # </th>
                                    <th class="bold"> Project Name </th>
                                    <th class="bold"> Project Status </th>
                                    <th class="bold"> Report Date </th>
                                    <th class="bold"> Message </th>
                                    <th class="bold"> Actions </th>
                                </tr>

                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$data)

                                <tr>
                                    <td> {{ $key+1 }} </td>
                                    <td> {{ $data->projectTitle }} </td>
                                    {{-- <td> User Registration </td> --}}
                                    <td data-label="Status"><span class="badge @if($data->projectStatus == 0) badge-warning @else {{ ($data->projectStatus == 1 ? 'badge-success' : 'badge-danger')  }} @endif  mb-0 even-larger-badge">@if($data->projectStatus == 0) Bloked @else {{ ($data->projectStatus == 1 ? 'Active' : 'Deleted')  }} @endif</span></td>

                                    <td> {{ $data->created_at }} </td>
                                    <td> {{ $data->message }} </td>
                                    <td>
                                        <a href="{{ url('/task_details', base64_encode($data->project_id)) }}" target="_blank" class="btn btn-outline btn-circle btn-sm blue">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>

                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@stop
