@extends('admin::layouts.main')

@section('breadcrumb')
    <li> <a href="{{ Route('admin-requested-amount') }}">{{ $model->user->name }}</a></li>
    <li class="active">Update</li>
@stop

@section('content')
    <div class="users-update">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->user->first_name }}
                        {{ $model->user->last_name }}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-row-seperated"
                    action="{{ Route('admin-requested-amount-update', ['id' => $model->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                      
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') != '' ? old('name') : $model->user->name }}" placeholder="Name">
                                @if ($errors->has('name'))
                                    <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Amount <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="amount"
                                    value="{{ old('amount') != '' ? old('amount') : $model->amount }}" placeholder="Amount">
                                @if ($errors->has('amount'))
                                    <div class="help-block">{{ $errors->first('amount') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('total_amount') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Total Amount Left <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="total_amount"
                                    value="{{ old('total_amount') != '' ? old('total_amount') : $model->total_amount }}" placeholder="Total Amount">
                                @if ($errors->has('total_amount'))
                                    <div class="help-block">{{ $errors->first('total_amount') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('holder_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Account Holder Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="holder_name"
                                    value="{{ old('holder_name') != '' ? old('holder_name') : $bank->holder_name }}" placeholder="Account Holder Name">
                                @if ($errors->has('holder_name'))
                                    <div class="help-block">{{ $errors->first('holder_name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Bank Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="bank_name"
                                    value="{{ old('bank_name') != '' ? old('bank_name') : $bank->bank_name }}" placeholder="Bank Name">
                                @if ($errors->has('bank_name'))
                                    <div class="help-block">{{ $errors->first('bank_name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('branch_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Branch Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="branch_name"
                                    value="{{ old('branch_name') != '' ? old('branch_name') : $bank->branch_name }}" placeholder="Branch Name">
                                @if ($errors->has('branch_name'))
                                    <div class="help-block">{{ $errors->first('branch_name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('account_number') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Account Number <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="account_number"
                                    value="{{ old('account_number') != '' ? old('account_number') : $bank->account_number }}" placeholder="Account Number">
                                @if ($errors->has('account_number'))
                                    <div class="help-block">{{ $errors->first('account_number') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') != '' ? old('name') : $model->user->name }}" placeholder="Name">
                                @if ($errors->has('name'))
                                    <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                            <div class="col-md-8">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0"
                                            {{ old('status') != '' ? (old('status') == 0 ? 'checked' : '') : ($model->status == 0 ? 'checked' : '') }}>
                                        In Escrow
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2"
                                            {{ old('status') != '' ? (old('status') == 2 ? 'checked' : '') : ($model->status == 2 ? 'checked' : '') }}>
                                        Hold
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"
                                            {{ old('status') != '' ? (old('status') == 1 ? 'checked' : '') : ($model->status == 1 ? 'checked' : '') }}>
                                        Release
                                    </label>

                                    @if ($errors->has('status'))
                                        <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green">Update</button>
                                <a href="{{ Route('admin-requested-amount') }}" class="btn default">Back</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
