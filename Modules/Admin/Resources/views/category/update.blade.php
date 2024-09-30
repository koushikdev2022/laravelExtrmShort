@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-category') }}?pid={{$pid}}">Category Management</a></li>
@isset($parent_model)
<li>{{$parent_model->category_name}}</li>
@endisset
<li class="active">Update</li>
@stop


@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating {{ $model->category_name }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated"
                action="{{ Route('admin-category-edit', ['id' => base64_encode($model->id)]) }}?pid={{$pid}}"
                method="POST" enctype="multipart/form-data" id="add-category-form">
                <input type="hidden" name="id" value="{{$model->id}}" />
                <div class="form-body">
                    <div class="row">
                        <div class="panel-group" id="accordion">
                            @forelse($languages as $language)
                            <div class="panel panel-default">
                                <div class="panel-heading containerof-{{$language->lang_code}}">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse{{$loop->iteration}}">
                                            <span
                                                class="glyphicon glyphicon-file"></span>{{ucfirst($language->lang).' ('.$language->lang_code.')'}}</a>
                                    </h4>
                                </div>
                                <div id="collapse{{$loop->iteration}}"
                                    class="panel-collapse collapse {{$loop->iteration===1?'in':''}}">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Category Name <span
                                                    class="required">*</span></label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control"
                                                    name="{{$language->lang_code}}[category_name]"
                                                    value="{{isset($eventTrans[$language->lang_code]->category_name)?$eventTrans[$language->lang_code]->category_name:''}}"
                                                    placeholder="Category Name">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Photo <span class="required">*</span></label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="picture">
                                <div class="help-block"></div>
                            </div>
                            @if(!empty($model->getRawOriginal('image')))
                            <div class="col-md-3">
                            <img src="{{ $model->image != '' ? asset('public/uploads/frontend/category/' . $model->image) : asset('public/frontend/images/profile_user.png') }}" height="60" />
                                <!-- <img src="{{ URL::asset('public/uploads/frontend/category/'.$model->image) }}" height="60" /> -->
                            </div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 ">Status <span class="required">*</span></label>
                            <div class="radio-list col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{($model->status==='0')?'checked':''}}>
                                    Inactive
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{($model->status==='1')?'checked':''}}>
                                    Active
                                </label>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{route('admin-category')}}?pid={{$pid}}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
