@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Producing With Us</li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-phone font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Producing With Us</span>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="{{ Route('admin-addproducing_with_us') }}" ><i class="fa fa-plus" aria-hidden="true"></i> Add</a>&nbsp;
                </div>
            </div>
           
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Image </th>
                                
                                <th class="bold"> Added Date </th>
                                <th class="bold"> Status </th>
                                <th class="bold" width="10%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($model) > 0)
                            @foreach ($model as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> <img src="{{ URL::asset('public/uploads/admin/producing_image/' . $val->image ) }}" alt="" style="height:50px;"> </td>
                                <td> {{ (isset($val->created_at) && $val->created_at != '') ? date('jS F Y', strtotime($val->created_at)) : "Not Found" }} </td>

                                <td>
                                    @if($val->status == '0')
                                    <span class="label label-sm label-warning"> Inactive </span>
                                    @else
                                    <span class="label label-sm label-success"> Active </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ Route('admin-editproducing_with_us', ['id' => base64_encode($val->id)]) }}" style="text-decoration: none;" title="Edit  Details">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ Route('admin-deleteproducing_with_us', ['id' => base64_encode($val->id)]) }}" style="text-decoration: none;" title="Delete Details">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
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