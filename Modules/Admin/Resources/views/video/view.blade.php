@extends('admin::layouts.main')

@section('breadcrumb')
<li>
    <span class="active">Video Management</span>
</li>
@stop

@section('content')

<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            Video Management
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
        </div>

        <h2>{{ $data->title }}</h2>
        <p>{{ $data->description }}</p>
        <hr>
        <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-8">
                <video width="320" height="240" controls>
                    @if($data->video_extension == 'mp4')
                    <source src="{{ asset('public/uploads/frontend/project/video/' . $data->video) }}" type="video/mp4">
                    @elseif($data->video_extension == 'mov')
                    <source src="{{ asset('public/uploads/frontend/project/video/' . $data->video) }}" type="video/mov">
                    @elseif($data->video_extension == 'mkv')
                    <source src="{{ asset('public/uploads/frontend/project/video/' . $data->video) }}" type="video/mkv">
                    @endif
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        <div class="portlet-body form">
            <form action="{{ Route('admin-video_statusUpdate', [$data->id]) }}">

                <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}" >
                    <label class="col-md-3 control-label " style="text-align:end ;margin-right: 50px;margin-top: 20px;">Verify <span class="required">*</span></label>
                    <div class="col-md-8" style="margin-top: 20px;">
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" {{ old('status') != '' ? (old('status') == 1 ? 'checked' : '') : ($data->status == 1 ? 'checked' : '') }}>
                                Approve
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0" {{ old('status') != '' ? (old('status') == 0 ? 'checked' : '') : ($data->status == 0 ? 'checked' : '') }}>
                                Reject
                            </label>

                            @if ($errors->has('status'))
                            <div class="help-block">{{ $errors->first('status') }}</div>
                            @endif
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green">Submit</button>
                                <a href="{{ Route('admin-video') }}" class="btn default">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop