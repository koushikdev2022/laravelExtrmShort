@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Orders</li>
@stop

@section('content')
<h3 class="page-title">Orders
    <small>Manage all the Orders of the site from here</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-suitcase font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Orders</span>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="javascript:;" onclick="$('#search_filter').toggle();"><i class="fa fa-search" aria-hidden="true"></i> Filter</a>&nbsp;
                    <a class="btn btn-info" href="{{ Route('admin-emails') }}"><i class="glyphicon glyphicon-repeat"></i></i> Reset</a>
                </div>
            </div>
            <div class="portlet-body form" id="search_filter" style="display: {{ ($search_filter == 1) ? 'block;' : 'none;' }}">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" action="" method="GET">
                    <input type="hidden" name="search_filter" value="1" />
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Status</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="status" placeholder="Status" value="{{ (isset($status) && $status != '') ? $status : '' }}">
                                    </div>
                                </div>
                            </div>
                           
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
                                <th class="bold"> Project </th>
                                <th class="bold"> User </th>
                                <th class="bold"> Status </th>
                                <th class="bold"> Last Updated </th>
                                <th class="bold"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($model as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ (isset($val->project_id) && $val->project_id != '') ? ucFirst(\Illuminate\Support\Str::limit($val->projects->title,20)) : "Not Given" }} </td>

                                <td> {{ (isset($val->user_id) && $val->user_id != '') ? ucFirst($val->user->name) : "Not Given" }} </td>
                                <td>  
                                    @if ($val->status == '1') 
                                    <span class="label label-sm label-warning">Pending</span>
                                    @elseif ($val->status == '2')
                                     <span class="label label-sm label-success">Success</span> 
                                     @elseif ($val->status == '3') 
                                     <span class="label label-sm label-danger">Fail</span>
                                    @endif
                                     </td>

                                     
                                <td> {{ (isset($val->updated_at) && $val->updated_at != '') ? date('jS M Y, g:i A', strtotime($val->updated_at)) : "Not Found" }} </td>
                                <td>
                                    <a href="{{ Route('admin-vieworder', ['id' => base64_encode($val->id)]) }}" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">No Record Found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $model->appends(request()->all())->render() }}
            </div>
        </div>
    </div>
</div>
@stop   