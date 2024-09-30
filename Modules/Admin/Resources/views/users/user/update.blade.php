@extends('admin::layouts.main')

@section('breadcrumb')
    <li> <a href="{{ Route('admin-user') }}">{{ $model->first_name }}</a></li>
    <li class="active">Update</li>
@stop

@section('content')
    <div class="users-update">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->first_name }}
                        {{ $model->last_name }}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-row-seperated"
                    action="{{ Route('admin-updateuser', ['id' => $model->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('profile_picture') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Profile Picture <span class="required">*</span></label>
                            <div class="col-md-8">
                                <img src="{{ $model->profile_picture != '' ? asset('public/uploads/frontend/profile_picture/preview/' . $model->profile_picture) : asset('public/frontend/images/profile_user.png') }}"
                                    alt="" style="width:150px;height:150px;" class="form-control">
                                <input type="file" name="profile_picture" placeholder="Choose Profile Picture"
                                    value="{{ $model->profile_picture != '' ? $model->profile_picture : '' }}">
                                @if ($errors->has('profile_picture'))
                                    <div class="help-block">{{ $errors->first('profile_picture') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') != '' ? old('name') : $model->name }}" placeholder="Name">
                                @if ($errors->has('name'))
                                    <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email"
                                    value="{{ old('email') != '' ? old('email') : $model->email }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <div class="help-block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Username <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="username"
                                    value="{{ old('username') != '' ? old('username') : $model->username }}"
                                    placeholder="Username">
                                @if ($errors->has('username'))
                                    <div class="help-block">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                        </div>


                        <!-- <div class="form-group {{ $errors->has('language') ? ' has-error' : '' }}">
                                                                                                <label class="col-md-3 control-label">Language <span class="required">*</span></label>
                                                                                                <div class="col-md-8">
                                                                                                    <select name="language" class="form-control">
                                                                                                            <option value="">Select Language</option>
                                                                                                            @foreach ($languages as $language)
    <option value="{{ $language->id }}" {{ $model->language == $language->id ? 'selected' : '' }}>{{ $language->Language }}</option>
    @endforeach
                                                                                                    </select>
                                                                                                     @if ($errors->has('language'))
    <div class="help-block">{{ $errors->first('language') }}</div>
    @endif
                                                                                                </div>
                                                                                            </div> -->

                        <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Country <span class="required">*</span></label>
                            <div class="col-md-8">
                                <select name="country" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ $model->country == $country->id ? 'selected' : '' }}>
                                            {{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <div class="help-block">{{ $errors->first('country') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                            <div class="col-md-8">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"
                                            {{ old('status') != '' ? (old('status') == 1 ? 'checked' : '') : ($model->status == 1 ? 'checked' : '') }}>
                                        Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0"
                                            {{ old('status') != '' ? (old('status') == 0 ? 'checked' : '') : ($model->status == 0 ? 'checked' : '') }}>
                                        Inactive
                                    </label>

                                    @if ($errors->has('status'))
                                        <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('user_verifications') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Verify <span class="required">*</span></label>
                            <div class="col-md-8">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="user_verifications" value="1"
                                            {{ old('user_verifications') != '' ? (old('user_verifications') == 1 ? 'checked' : '') : ($model->user_verifications == 1 ? 'checked' : '') }}>
                                        Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="user_verifications" value="0"
                                            {{ old('user_verifications') != '' ? (old('user_verifications') == 0 ? 'checked' : '') : ($model->user_verifications == 0 ? 'checked' : '') }}>
                                        Inactive
                                    </label>

                                    @if ($errors->has('user_verifications'))
                                        <div class="help-block">{{ $errors->first('user_verifications') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green">Update</button>
                                <a href="{{ Route('admin-user') }}" class="btn default">Back</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
