@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-cms') }}">CMS</a></li>
<li> <a href="{{ Route('admin-viewcms', ['id' => base64_encode($model->id)]) }}">{{ $model->content_name }}</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="cms-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->content_name }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-updatecms', ['id' => base64_encode($model->id)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Slug</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="slug" value="{{ (old('slug') != "") ? old('slug') : $model->slug }}" placeholder="Slug" disabled>
                            @if ($errors->has('slug'))
                            <div class="help-block">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('page_name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Page Name <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="page_name" value="{{ (old('page_name') != "") ? old('page_name') : $model->page_name }}" placeholder="Page Name">
                            @if ($errors->has('page_name'))
                            <div class="help-block">{{ $errors->first('page_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content_name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Content Name <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="content_name" value="{{ (old('content_name') != "") ? old('content_name') : $model->content_name }}" placeholder="Content Name">
                            @if ($errors->has('content_name'))
                            <div class="help-block">{{ $errors->first('content_name') }}</div>
                            @endif
                        </div>
                    </div>
                    @if ($model->type == '2')
                    <div class="form-group {{ $errors->has('content_body') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Image </label>
                        <div class="col-md-9">
                            @if ($model->content_body != '')
                            <img class="img-responsive" style="width:200px; height:auto;" src="{{ URL::asset('storage/uploads/frontend/cms/pictures/preview/' . $model->content_body) }}" alt="{{ $model->content_body }}">
                            <br />
                            @endif
                            <input type="file" class="form-control" name="content_body">
                            @if ($errors->has('content_body'))
                            <div class="help-block">{{ $errors->first('content_body') }}</div>
                            @endif
                            @if ($model->instruction != '')
                            <h3><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="{{ $model->instruction }}"></i></h3>
                            @endif
                        </div>
                    </div>
                    
                    @else
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading containerof-en">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        <span class="glyphicon glyphicon-file"></span>En (en)</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse {{1===1?'in':''}}">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Content ( en )<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <textarea class="form-control ckeditor" name="content_body" placeholder="Content">{{ (old('content_body') != "") ? old('content_body') : $model->content_body }}</textarea>
                                            @if ($errors->has('content_body'))
                                            <div class="help-block">{{ $errors->first('content_body') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{ Route('admin-viewcms', ['id' => base64_encode($model->cms_id)]) }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop