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
    <span class="active">Orders</span>
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
            Orders
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="order-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Project</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Created On</th>
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
        $('#order-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-order-list-datatable") }}',
            order: [[4, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'order_id', name: 'order_id'},
                {data: 'project_id', name: 'project_id'},
                {data: 'user_id', name: 'user_id'},
                {data: 'amount', name: 'amount'},
                {data: 'total', name: 'total'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '1') {
                            return '<span class="label label-sm label-warning">Pending</span>';
                        } else if (data == '2') {
                            return '<span class="label label-sm label-success">Success</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Fail</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    function deleteOrder(obj) {
        $.confirm({
            title: 'Delete Order',
            content: 'Are you sure to delete this Order?',
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