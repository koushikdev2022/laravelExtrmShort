@extends('admin::layouts.main')

@section('page_css')

@endsection
@section('breadcrumb')
    <li>
        <span class="active">Requested Amount</span>
    </li>
@stop

@section('content')
    <div class="portlet box blue-hoki">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer"></i>
                Requested Amount
            </div>
           
        </div>
        <div class="portlet-body ">
            <div class="clearfix">
                <div class="table-scrollable" style="border: none;">
                    <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%"
                        id="requested-fund-management">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                               
                                <th class="bold"> User </th>
                                <th class="bold"> Amount </th>
                                <th class="bold"> Total </th>
                                <th class="bold"> Status </th>
                                <th class="bold"> Registered Date </th>
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

<script>
    $(function () {
        $('#requested-fund-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-requested-amount-list-datatable") }}',
            order: [[4, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'user_id', name: 'user_id'},
                {data: 'amount', name: 'amount'},
                {data: 'total_amount', name: 'total_amount'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                       if (data == '0') {
                            return '<span class="label label-sm label-success">In Escrow</span>';
                        } else if (data == '2') {
                            return '<span class="label label-sm label-danger">Hold</span>';
                        }else if (data == '1') {
                            return '<span class="label label-sm label-danger">Release</span>';
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
</script>
@stop
