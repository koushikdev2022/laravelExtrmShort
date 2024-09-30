@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-user') }}">Users</a></li>
<li> <a href="{{url('user-profile/'.base64_encode($user->id))}}">{{ $user->name() }}</a>
</li>
<li class="active">Document Management</li>
@stop


@section('content')
<h3 class="page-title">{{ $user->name() }} Document Management
    <small>Manage all the {{ $user->name() }} Document of the site from here</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">{{ $user->name() }} Documents</span>
                </div>
                <div class="pull-right">

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover datatable" width="100%"
                        id="user-document-table" data-user="{{base64_encode($user->id)}}">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Document </th>
                                <th class="bold"> Status </th>
                                <th class="bold"> Created On </th>
                                <th class="bold" width="23%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop