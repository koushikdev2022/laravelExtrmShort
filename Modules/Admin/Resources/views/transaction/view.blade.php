@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-transaction') }}">Transaction Detail</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->first_name }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" onsubmit="return false;">
                @csrf
                <div class="form-body">
                    
                    <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">First name :</label>
                        <div class="col-md-8">
                            <p class="btn btn-secondary">{{ $model->first_name }}</p>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Last Name :</label>
                        <div class="col-md-8">
                            <p class="btn btn-secondary">{{ $model->last_name }}</p>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Email :</label>
                        <div class="col-md-8">
                            <p class="btn btn-secondary">{{ $model->email }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('transaction_id') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Transaction ID :</label>
                        <div class="col-md-8">
                            <p class="btn btn-secondary">{{ $model->transaction_id }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('payment_gateway') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Payment Gateway :</label>
                        <div class="col-md-8">
                            <p class="btn btn-secondary">{{ $model->payment_gateway }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Amount :</label>
                        <div class="col-md-8">
                            <p class="btn btn-secondary">${{ $model->amount }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status :</label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                @if($model->status=='approved')
                                    <p class="btn btn-success">Success</p> 
                                @elseif($model->status==3)
                                    <p class="btn btn-danger">Fail</p> 
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('created_at') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Created On :</label>
                        <div class="col-md-8">
                            <p class="btn btn-secondary">{{ date("jS M Y, g:i A", strtotime($model->created_at)) }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <a href="{{ Route('admin-transaction')}}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop