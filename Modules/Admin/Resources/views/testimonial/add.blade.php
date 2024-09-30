@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{route('admin-testimonial')}}">Testimonial Management</a></li>
@isset($parent_model)
<li>{{$parent_model->testimonial_name}}</li>
@endisset

@stop

@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Creating Testimonial</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-addtestimonial') }}"
                method="POST" enctype="multipart/form-data" id="add-attribute-form">
                @csrf
                <input type="hidden" name="is_new" value="1" />
                <div class="form-body">
                    <div class="row">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading containerof-1">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse{{1}}">
                                            <span
                                                class="glyphicon glyphicon-file"></span>En (en)</a>
                                    </h4>
                                </div>
                                <div id="collapse{{1}}"
                                    class="panel-collapse collapse {{1===1?'in':''}}">
                                    <div class="panel-body">
                                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label"> Testimonial Name <span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                                        name="name" value=""
                                                                        placeholder="Testimonial Name">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('subtitle') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label"> Subtitle <span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                                        name="subtitle" value=""
                                                                        placeholder="Subtitle">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label"> Location <span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                                        name="location" value=""
                                                                        placeholder="Location">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Description <span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <textarea class="form-control ckeditor" name="description" placeholder="Body"></textarea>
                                                <div class="help-block"></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group {{ $errors->has('over_all_rating') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Over all rating<span class="required">*</span></label>
                            <div class="col-md-8">
                                <select class="form-control" name="over_all_rating">
                                    <option value="5">*****</option>
                                    <option value="4">****</option>
                                    <option value="3">***</option>
                                    <option value="2">**</option>
                                    <option value="1">*</option>
                                </select>
                                    <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-4" style="display:block;">Image</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="" alt="">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select Image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg, .gif, .svg">
                                        </span>
                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Status <span class="required">*</span></label>
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
                            <div class="col-md-offset-5 col-md-6">
                                <button type="submit" class="btn green">Create</button>
                                <a href="{{route('admin-testimonial')}}" class="btn default">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
