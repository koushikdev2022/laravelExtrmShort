@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-keyword') }}">Keyword </a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Update Keyword</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-editkeyword',$model->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Name <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ (old('name') != "") ? old('name') : $model->name }}" placeholder="name">
                            @if ($errors->has('name'))
                            <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }} locationerr">
                        <label class="col-md-3 control-label">Category <span class="required">*</span></label>
                        <div class="col-md-8">
                            <select class="form-control " name="category">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                @if(empty($category->parent_id))
                                <option value="{{$category->id}}" {{ ($category->id == $model->category) ? "selected" : "" }}>{{ !empty($category->translation_cat->category_name) ? $category->translation_cat->category_name : ''}}</option>
                                @endif
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                            <div class="help-block">{{ $errors->first('category') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ old('status') != '' ? (old('status') == 1 ? 'checked' : '') : ($model->status == 1 ? 'checked' : '') }}>
                                    Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ old('status') != '' ? (old('status') == 0 ? 'checked' : '') : ($model->status == 0 ? 'checked' : '') }}>
                                    Inactive
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
                            <a href="{{ Route('admin-keyword') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop