@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-commission') }}">Commission</a></li>
<li class="active">Add</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Add Commission</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-addcommission') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Name<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control"  value="{{ (old('name') != "") ? old('name') : '' }}" placeholder="Name">
                            @if ($errors->has('name'))
                            <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('percentile') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Percentile <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="percentile" value="{{ (old('percentile') != "") ? old('percentile') : '' }}" placeholder="Percentile">
                            @if ($errors->has('percentile'))
                            <div class="help-block">{{ $errors->first('percentile') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ (old('status') != "" && old('status')=='1') ? 'checked' : '' }}> Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ (old('status') != "" && old('status')=='0') ? 'checked' : '' }}> Inactive
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
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{ Route('admin-commission') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop