@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-blog') }}">Blog</a></li>
<li class="active">Edit</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Edit Blog</span>
            </div>
        </div>
        <div class="portlet-body form">
        <div id="err_msgs"></div>

            <form id="updateBlogRequest" class="form-horizontal form-row-seperated" action="{{ Route('admin-editblog',$model->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">

                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Title <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="title" class="form-control" value="{{  $model->title }}" placeholder="Title">
                            @if ($errors->has('title'))
                            <div class="help-block">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Slug <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="slug" class="form-control" value="{{ $model->slug }}" placeholder="Slug">
                            <div class="help-block"></div>
                        </div>
                    </div> -->
                    <!-- <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Email<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="email" class="form-control" value="{{$model->email }}" placeholder="Email">
                            <div class="help-block"></div>
                        </div>
                    </div> -->
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Descriptive Text <span class="required">*</span></label>
                        <div class="col-md-8">
                            <textarea class="form-control ckeditor" id="description" name="description" placeholder="Descriptive Text">{{ $model->description }}</textarea>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label class="control-label col-md-3" style="display:block;">Image <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ URL::asset('public/uploads/frontend/Blog/preview/'.$model->image) }}" alt="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select Image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="image" onchange="showPreview('c_logo',event);">
                                    </span>
                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>

                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Category <span class="required">*</span></label>
                        <div class="col-md-8">
                            <select class="form-control js-example-basic-frequency" name="category">
                                <option value="">Select Category</option>
                                @forelse($categories as $c)
                                <option value="{{ $c->category_name }}" {{ ($model->category == $c->category_name ) ? 'selected' : '' }}>{{ $c->category_name }}</option>
                                @empty
                                @endforelse

                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('post_date') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Published Date </label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="post_date" value="<?php echo date("Y-m-d") ?>">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('written_by') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Written By<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="written_by" class="form-control" value="{{ $model->written_by }}" placeholder="Written By">
                            @if ($errors->has('written_by'))
                            <div class="help-block">{{ $errors->first('written_by') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ $model->status == '1'  ? 'checked' : '' }}> Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ $model->status == '0'  ? 'checked' : '' }}> Inactive
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="4" {{ $model->status == '4'  ? 'checked' : '' }}> Draft
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
                            <a href="{{ Route('admin-blog') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    function showPreview(id, event) {
        console.log(event);
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById(id);
            preview.src = src;
        }
    }

    $("#updateBlogRequest").on("submit", function(e) {
        e.preventDefault();
        ajaxindicatorstart();
        var csrf_token = $("input[name=_token]").val();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        let formdata = new FormData($("#updateBlogRequest")[0]);
        $.ajax({
            url: $(this).attr("action"),
            data: formdata,
            type: $(this).attr("method"),
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#err_msgs').html('<div class="alert alert-success text-center" role="alert" id="err_msgs">' + result.message + '</div>');

                $("#updateBlogRequest")[0].reset();
                // setTimeout(window.location.reload(), 5000);
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $("#updateBlogRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                    $("#updateBlogRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .addClass("has-error");
                });
                ajaxindicatorstop();
            },
        });
    });
</script>
@stop