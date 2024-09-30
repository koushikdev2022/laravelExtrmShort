@extends('admin::layouts.main')

@section('page_css')
<style>
    .table>thead:first-child>tr:first-child>th {
        vertical-align: middle;
        text-align: center;
    }
    .table>tbody>tr>td {
        vertical-align: middle;
        text-align: center;
    }
    .dataTables_filter input {
        height: 34px;
        padding: 6px 12px;
        border: 1px solid #c2cad8;
    }
</style>
@endsection
@section('breadcrumb')
<li>
    <span class="active">User Follower</span>
</li>
@stop

@section('content')

<div class = "alert alert-danger" id='error'>
    <ul id='errordata'>
    </ul>
</div>
<div class = "alert alert-success" id='success'>
    <ul id='successdata'>
    </ul>
</div>
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            User Follower
        </div>
        <!-- <div class="pull-right"><a href="{{route('admin-adduser')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> -->
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="user-follower">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile Picture</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            {{-- <th>Status</th>
                            <th>Registered On</th>
                            <th>Last Login</th>
                            <th style="width: 100px;">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="{{$id}}" id="hidden-user-id">
<style>
#error{
    display:none;
}
#success{
    display:none;
}
</style>
@stop

@section('js')

<script>
    $(function () {
        var user_id = $('#hidden-user-id').val();
        $('#user-follower').DataTable({
            processing: false,
            serverSide: true,
            order: [[2, "desc"]],
            ajax: {
                "url":'{{ Route("admin-user-follower-list-datatable") }}',
                "data":{
                    id:user_id
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'image', name: 'image'},
                {data: 'username', name: 'username'},
                {data: 'name', name: 'name'},
                // {data: 'first_name', name: 'first_name'},
                // {data: 'last_name' , name: 'last_name'},
                
                // {data: 'status', name: 'status', render: function (data, type, row) {
                //         if (data == '0') {
                //             return '<span class="label label-sm label-warning">Inactive</span>';
                //         } else if (data == '1') {
                //             return '<span class="label label-sm label-success">Active</span>';
                //         } else if (data == '3') {
                //             return '<span class="label label-sm label-danger">Delete</span>';
                //         } else {
                //             return '';
                //         }
                //     }
                // },
                // {data: 'created_at', name: 'created_at'},
                // {data: 'last_login', name: 'last_login'},
                // {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    function deleteUser(obj) {
        $.confirm({
            title: 'Delete User',
            content: 'Are you sure to delete this user?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: {
                    text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                    btnClass: 'btn-red',
                    action: function () {
                        window.location.href = $(obj).attr('data-href');
                    }
                },
                cancel: function () {}
            }
        });
    }
    
</script>
@stop