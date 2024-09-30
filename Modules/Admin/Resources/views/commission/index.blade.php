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
    <span class="active">Commission</span>
</li>
@stop

@section('content')

<div class="alert alert-danger" id='error'>
    <ul id='errordata'>
    </ul>
</div>
<div class="alert alert-success" id='success'>
    <ul id='successdata'>
    </ul>
</div>
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            Commission
        </div>
        <div class="pull-right"><a href="{{route('admin-addcommission')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="commission-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Percentile</th>
                           
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
    #error {
        display: none;
    }

    #success {
        display: none;
    }
</style>
@stop

@section('js')

<script>
    $(function() {
        $('#commission-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-commission-list-datatable") }}',
            order: [
                [4, "desc"]
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'percentile',
                    name: 'percentile'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Pending</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Success</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Fail</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    function deleteCommission(obj) {
        $.confirm({
            title: 'Delete Commission',
            content: 'Are you sure to delete this Commission?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: {
                    text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                    btnClass: 'btn-red',
                    action: function() {
                        window.location.href = $(obj).attr('data-href');
                    }
                },
                cancel: function() {}
            }
        });
    }
</script>
@stop