@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-support') }}">View Support Request</a></li>
<li class="active">View Support Request</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View Support Request Details</span>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Subject:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->subject) && $model->subject != null) ? $model->subject : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">User Query:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->description) && $model->description != null) ? $model->description : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Admin Reply:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->admin_reply) && $model->admin_reply != null) ? $model->admin_reply : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Status:</label>
                    <div class="col-md-9">
                        <p class="form-control-static"> {{ ($model->reply_status == '0') ? 'Not replied' : 'Replied' }} </p>
                    </div>
                </div>
            </div>
        </div> --}}
        <br>
        <hr>
        <form class="form-horizontal form-row-seperated" action="{{ Route('send-support', ['id' => $model->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Request Status:</label>
                            <div class="col-md-5">
                                <textarea name="admin_reply" class="form-control"></textarea>
                                <div class="help-block" style="color: red;">{{ $errors->first('admin_reply') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Message Reply:</label>
                            <div class="col-md-5">
                                <select name="status" class="form-control">
                                    <option value="1" {{($model->status==1) ? 'selected' :''}}>Open</option>
                                    <option value="2" {{($model->status==2) ? 'selected' :''}}>Closed</option>
                                </select>
                                <div class="help-block" style="color: red;">{{ $errors->first('status') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <button type="submit" class="btn green">Save</button>
                        <a href="{{ Route('admin-support') }}" class="btn default">Back</a>
                    </div>
                </div>
        </form>
        <br>
    </div>
</div>
@stop