@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-user') }}">Users</a></li>
<li class="active">Create</li>
@stop

@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Creating User</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-adduser') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type_id" value="2">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label>Type <span class="required">*</span></label>
                                <div>
                                    <input type="radio" name="type_id" value="2" {{old('type_id')==="2"?"checked":""}}>
                                    Client
                                    <input type="radio" name="type_id" value="3" {{old('type_id')==='3'?"checked":""}}>
                                    Professional
                                    @if ($errors->has('type_id'))
                                    <div class="help-block">{{ $errors->first('type_id') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label>First Name <span class="required">*</span></label>
                                <div>
                                    <input type="text" name="first_name" class="form-control"
                                        placeholder="Individual First Name"
                                        value="{{ (old('first_name') != '') ? old('first_name') : '' }}">
                                </div>
                                @if ($errors->has('first_name'))
                                <div class="help-block">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label>Last Name <span class="required">*</span></label>
                                <input type="text" name="last_name" class="form-control"
                                    placeholder="Individual Last Name"
                                    value="{{ (old('last_name') != '') ? old('last_name') : '' }}">
                                @if ($errors->has('last_name'))
                                <div class="help-block">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Email <span class="required">*</span></label>
                                <div>
                                    <input type="text" name="email" class="form-control" placeholder="Individual Email"
                                        value="{{ (old('email') != '') ? old('email') : '' }}">
                                </div>
                                @if ($errors->has('email'))
                                <div class="help-block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>Password <span class="required">*</span></label>
                                <div>
                                    <input type="password" name="password" class="form-control" placeholder="********"
                                        value="{{ (old('password') != '') ? old('password') : '' }}">
                                </div>
                                @if ($errors->has('password'))
                                <div class="help-block">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green">Create</button>
                                <a href="{{ Route('admin-user') }}" class="btn default">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')

@stop