@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-user') }}">Users</a></li>
<li><a href="{{ Route('admin-user-subscription',['user_id' => $model->user->id]) }}">Transaction History</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing Plan Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Plan Name :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> <strong>{{ (isset($model->plan->name) && $model->plan->name != null) ? $model->plan->name : "Not Given" }} </strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Plan Price :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"><i class="fa fa-usd" aria-hidden="true"></i> {{ ($model->plan->amount != '') ? $model->plan->amount : 'Not Given' }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">User Name :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->user->name) && $model->user->name != null) ? $model->user->name : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">User Email :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->user->email) && $model->user->email != null) ? $model->user->email : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Amount Paid :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"><i class="fa fa-usd" aria-hidden="true"></i> {{ (isset($model->pay_amount) && $model->pay_amount != null) ? $model->pay_amount : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Discount Amount :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"><i class="fa fa-usd" aria-hidden="true"></i> {{ (isset($model->discount_amount) && $model->discount_amount != null) ? $model->discount_amount : "0" }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Payment Type :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> <strong> {{ ($model->payment_type == 'paypal') ? 'PayPal' : 'Credit Card' }} </strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Currency :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->currency) && $model->currency != null) ? $model->currency : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Plan Start Date :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->start_date) && $model->start_date != null) ? $model->start_date : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Plan End Date :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->end_date) && $model->end_date != null) ? $model->end_date : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label col-md-3">Plan Status:</label>
                    <div class="col-md-9">
                        <p class="form-control-static">
                        @if(isset($model->status) && $model->status != null)
                            @if($model->status == 'pending')
                               <strong>Pending</strong>
                            @elseif($model->status == 'precessing')
                               <strong>Processing</strong>
                            @elseif($model->status == 'completed')
                                <strong>Completed</strong> 
                            @else
                               <strong>Declined</strong>
                            @endif 
                        @else
                           <strong>N/A</strong>
                        @endif
                        </p>
                    </div>
                </div>
        </div>
        </div>
            <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <a href="{{ Route('admin-user-subscription',['user_id' => $model->user->id]) }}" class="btn default">Back</a>
                    </div>
            </div>
     </div>
    </div>
    </div>
@stop