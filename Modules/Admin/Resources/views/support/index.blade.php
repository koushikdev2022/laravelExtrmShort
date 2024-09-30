@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Support Request</li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-phone font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Support Request</span>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="javascript:;" onclick="$('#search_filter').toggle();"><i class="fa fa-search" aria-hidden="true"></i> Filter</a>&nbsp;
                    <a class="btn btn-info" href="?"><i class="glyphicon glyphicon-repeat"></i></i> Reset</a>
                </div>
            </div>
            <div class="portlet-body form" id="search_filter" style="display: {{ ($search_filter == 1) ? 'block;' : 'none;' }}">
                <form class="form-horizontal" action="" method="GET">
                    <input type="hidden" name="search_filter" value="1"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Ticket Id</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="ticket_id" placeholder="Ticket Id" value="{{ (isset($ticket_id) && $ticket_id != '') ? $ticket_id : '' }}">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ (isset($email) && $email != '') ? $email : '' }}">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3">From</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="from" placeholder="From" value="{{ (isset($from) && $from != '') ? $from : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3">To</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="to" placeholder="To" value="{{ (isset($to) && $to != '') ? $to : '' }}">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Transation Id</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="transation_id" placeholder="Phone" value="{{ (isset($transation_id) && $transation_id != '') ? $transation_id : '' }}">
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Status</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="status">
                                            <option value="">Select All</option>
                                            <option value="0" {{ (isset($status) && $status != '') ? (($status === '0') ? 'selected' : '') : '' }}>Not Replied</option>
                                            <option value="1" {{ (isset($status) && $status != '') ? (($status === '1') ? 'selected' : '') : '' }}>Replied</option>
                                        </select>
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
                                <th scope="col">No.</th>
                                <th scope="col">Ticket Id</th>
                                <th scope="col">Date</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($model) > 0)
                            @foreach ($model as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $val->ticket_id }} </td>
                                <td> {{date("jS M Y, g:i A", strtotime($val->created_at))}} </td>
                                <td> {{$val->subject}}</td>
                                <td>
                                    @if($val->status == '1')
                                    <span class="label label-sm label-warning"> Open </span>
                                    @elseif($val->status == '2')
                                    <span class="label label-sm label-success"> closed </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ Route('admin-viewsupport', ['id' => $val->id]) }}" style="text-decoration: none;" title="View Contact Details">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" style="text-align: center;">No Record Found!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ $model->links() }}
            </div>
        </div>
    </div>
</div>
@stop
