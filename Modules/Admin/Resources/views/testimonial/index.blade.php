@extends('admin::layouts.main')

@section('css')
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
    .dataTables_wrapper .dataTables_info {
        padding-top: 0em !important;
    }
    .dataTables_wrapper .bottom {
        padding-top: 10px !important;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding-bottom: 10px;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: start;
    }
    .dataTables_wrapper .dataTables_paginate {
        margin-left: auto;
    }
    .dataTables_wrapper .dataTables_length {
        margin-left: 25px;
    }
    .dataTables_wrapper .dataTables_length label{
        margin-bottom:0px;
    }
</style>
@endsection
@section('breadcrumb')
<li>
    <span class="active">Testimonials</span>
</li>
@stop

@section('content')


<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-server" aria-hidden="true"></i>
            Testimonials
        </div>
    <div class="pull-right"><a href="{{route('admin-addtestimonial')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="testimonial-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Over all rating</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th style="width: 100px;">Actions</th>
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

<script>
    $(function () {
        $('#testimonial-management').DataTable({
            dom: '<"top"f>rt<"bottom"i lp><"clear">',
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-testimonial-list-datatable") }}',
            order: [[4, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'name'},
                {data: 'over_all_rating', name: 'over_all_rating'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else if (data == '4') {
                            return '<span class="label label-sm label-info">Draft</span>';
                        }else {
                            return '';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });
    });

    function deleteTestimonial(obj) {
        $.confirm({
            title: 'Delete Testimonial',
            content: 'Are you sure to delete this Testimonial?',
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
