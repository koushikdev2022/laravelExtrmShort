@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-blog') }}">Blog</a></li>
<li class="active">Add</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Add Blog</span>
            </div>
        </div>
        <div class="portlet-body form">
            <div id="err_msgs"></div>
            <form id="blogRequest" class="form-horizontal form-row-seperated" action="{{ Route('admin-add-blog') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">

                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Title <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="title" class="form-control" placeholder="Title">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <!-- <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Slug <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="slug" class="form-control" placeholder="Slug">
                            <div class="help-block"></div>
                        </div>
                    </div> -->
                    <!-- <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Email<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                            <div class="help-block"></div>
                        </div>
                    </div> -->
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Descriptive Text <span class="required">*</span></label>
                        <div class="col-md-8">
                            <textarea class="form-control ckeditor" name="description" placeholder="Descriptive Text"></textarea>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label class="control-label col-md-3" style="display:block;">Company Logo <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="" alt="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select Company Logo </span>
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
                                <option value="{{ $c->category_name }}">{{ $c->category_name }}</option>
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
                            <input type="text" name="written_by" class="form-control"  placeholder="Written By">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" > Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" > Inactive
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="4"> Draft
                                </label>
                                <div class="help-block"></div>
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

    $("#blogRequest").on("submit", function(e) {
        e.preventDefault();
        ajaxindicatorstart();
        var csrf_token = $("input[name=_token]").val();
        let formdata = new FormData($("#blogRequest")[0]);
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

                $("#blogRequest")[0].reset();
                setTimeout(window.location.reload(), 5000);
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $("#blogRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                    $("#blogRequest")
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