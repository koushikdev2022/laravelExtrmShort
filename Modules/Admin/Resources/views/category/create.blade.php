@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{route('admin-category')}}?pid={{$pid}}">Category Management</a></li>
@isset($parent_model)
<li>{{$parent_model->category_name}}</li>
@endisset

<li class="active">Create</li>
@stop

@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Creating Category</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{route('admin-category-create')}}?pid={{$pid}}"
                method="POST" enctype="multipart/form-data" id="add-category-form">
                @csrf
                <input type="hidden" name="is_new" value="1" />
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
                                                    name="{{$language->lang_code}}[category_name]" value=""
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
                        </div>
                      

                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-6">
                                <button type="submit" class="btn green">Create</button>
                                <a href="{{route('admin-category')}}?pid={{$pid}}" class="btn default">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
