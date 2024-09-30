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
<li> <a href="{{ Route('admin-user') }}">Users</a></li>
<li class="active">Transaction History</li>
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
            Transaction History Of {{$user->name}}
        </div>
        <!-- <div class="pull-right"><a href="{{route('admin-adduser')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> -->
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="user-subscription-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Plan Name</th>
                            <th>Amount Paid</th>
                            <th>Payment Type</th>
                            <th>Currency</th>
                            <th>Status</th>
                            <th>Subscribed On</th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
        $('#user-subscription-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-user-subscription-list-datatable",["user_id" => $user_id]) }}',
            order: [[6, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'plan.name'},
                {data: 'pay_amount', name: 'pay_amount'},
                {data: 'payment_type', name: 'payment_type', render: function (data, type, row) {
                        if (data == 'paypal') {
                            return '<span class="label label-sm label-warning">PayPal</span>';
                        }else {
                            return '<span class="label label-sm label-success">Credit Card</span>';
                        }
                    }
                },
                {data: 'currency', name: 'currency'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == 'pending') {
                            return '<span class="label label-sm label-danger">Pending</span>';
                        } else if (data == 'processing') {
                            return '<span class="label label-sm label-warning">Processing</span>';
                        } else if (data == 'completed') {
                            return '<span class="label label-sm label-success">Completed</span>';
                        } else {
                            return '<span class="label label-sm label-danger">Decline</span>';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
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