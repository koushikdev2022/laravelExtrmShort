@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-user') }}">Users</a></li>
<li class="active">Add</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Add User</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-adduser') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">

                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label">First Name <span class="required">*</span></label>
                <div class="col-md-8">
                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ (old('first_name') != "") ? old('first_name') : '' }}" placeholder="First Name">
                @if ($errors->has('first_name'))
                <div class="help-block">{{ $errors->first('first_name') }}</div>
                @endif
                </div>
                </div>

                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
               <label class="col-md-3 control-label">Last Name <span class="required">*</span></label>
               <div class="col-md-8">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ (old('last_name') != "") ? old('last_name') : '' }}" placeholder="Last Name">
                @if ($errors->has('last_name'))
                <div class="help-block">{{ $errors->first('last_name') }}</div>
                        @endif
                </div>
                </div>
                    
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ (old('email') != "") ? old('email') : '' }}" placeholder="Email">
                                   @if ($errors->has('email'))
                                   <div class="help-block">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>

      <!--              <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Phone <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone" placeholder="Phone No.">
                                   @if ($errors->has('phone'))
                                   <div class="help-block">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                    </div> -->
              
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status"}} value="1" {{ (old('status') != "" && old('status')=='1') ? 'checked' : '' }}> Active
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
                            <a href="{{ Route('admin-user') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop