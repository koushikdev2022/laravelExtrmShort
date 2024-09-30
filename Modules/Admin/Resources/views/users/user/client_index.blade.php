@extends('admin::layouts.main')

@section('page_css')

@endsection
@section('breadcrumb')
    <li>
        <span class="active">Users</span>
    </li>
@stop

@section('content')
    <div class="portlet box blue-hoki">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer"></i>
                Users
            </div>
            {{-- <div class="pull-right"><a href="{{route('admin-adduser')}}" class="btn btn-success"
                style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> --}}
        </div>
        <div class="portlet-body ">
            <div class="clearfix">
                <div class="table-scrollable" style="border: none;">
                    <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%"
                        id="user-management">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                               
                                <th class="bold"> Name </th>
                                <th class="bold"> Email </th>
                                <th class="bold"> Verified </th>
                                <th class="bold"> Status </th>
                                <th class="bold"> Registered Date </th>
                                 <th class="bold"> Last Login </th>
                                <th class="bold" width="23%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')

@stop
