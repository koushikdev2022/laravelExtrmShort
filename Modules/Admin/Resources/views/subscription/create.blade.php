@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-subscriptionplan') }}">Subscription Plan Mangement</a></li>
<li class="active">Create</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Create Subscription</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-addsunscriptionplan') }}" method="POST" >
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Plan Name </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="" placeholder="Plan name">
                                   @if ($errors->has('name'))
                                   <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Plan Amount <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="amount" value="" placeholder="Plan amount">
                                   @if ($errors->has('amount'))
                                   <div class="help-block">{{ $errors->first('amount') }}</div>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group {{ $errors->has('plan_id') ? ' has-error' : '' }}" {{ ($model->name != 'Verification') ? '' : 'hidden' }}>
                        <label class="col-md-3 control-label">Plan id <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="plan_id" value="{{ (old('plan_id') != '') ? old('plan_id') : $model->plan_id }}" placeholder="Plan id">
                                @if ($errors->has('plan_id'))
                                <div class="help-block">{{ $errors->first('plan_id') }}</div>
                                @endif
                        </div>
                    </div> --}}
                    <div class="form-group {{ $errors->has('currency') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Currency </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="currency" value="" placeholder="Currency" >
                                   @if ($errors->has('currency'))
                                   <div class="help-block">{{ $errors->first('currency') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('interval_day') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Interval Day</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="interval_day" value="" placeholder="Interval Day"> 
                            @if ($errors->has('interval_day'))
                                   <div class="help-block">{{ $errors->first('interval_day') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('duration') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Plan Interval </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="duration" value="" placeholder="duration"> 
                            @if ($errors->has('interval'))
                                   <div class="help-block">{{ $errors->first('duration') }}</div>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group {{ $errors->has('total_number') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Plan Users </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="total_number" value="{{ (old('total_number') != '') ? old('total_number') : $model->total_number }}" placeholder="Plan users" disabled="">
                                   @if ($errors->has('total_number'))
                                   <div class="help-block">{{ $errors->first('total_number') }}</div>
                            @endif
                        </div>
                    </div> --}}
                    <div class="form-group {{ $errors->has('plan_text') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Plan text <span class="required">*</span></label>
                        <div class="col-md-8">
                            <textarea class="form-control ckeditor" name="plan_text" placeholder="Plan text"></textarea>
                            @if ($errors->has('plan_text'))
                            <div class="help-block">{{ $errors->first('plan_text') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Save</button>
                            <a href="{{ Route('admin-subscriptionplan') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop