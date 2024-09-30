@extends('admin::layouts.main')

@section('breadcrumb')
<li>
    <a href="{{ Route('admin-user') }}">Users</a>
</li>
<li>
    <a href="{{url('user-profile/'.base64_encode($model->user_id))}}">{{ $user->name() }}</a>
</li>
<li>
    <a href="{{ Route('user-documents.index') }}?uid={{base64_encode($user->id)}}">Documents</a>
</li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing document details of
                {{ $user->name() }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <table class="abmin-prof-tbl">
            <tr>
                <th>User </th>
                <td>
                    <a href="{{url('user-profile/'.base64_encode($model->user_id))}}" class="btn btn-primary"
                        target="_blank">
                        {{ $user->name() }}
                    </a>
                </td>
            </tr>
            <tr>
                <th>Docuemnt Type </th>
                <td>
                    {{isset($documents[$model->document_type]) ? $documents[$model->document_type] : ''}}
                </td>
            </tr>
            @if($model->document_type==='10')
            <tr>
                <th>Contact Name </th>
                <td>
                    {{$model->contact_name}}
                </td>
            </tr>
            <tr>
                <th>Contact Email </th>
                <td>
                    {{$model->contact_email}}
                </td>
            </tr>
            <tr>
                <th>Contact Phone </th>
                <td>
                    {{$model->contact_phone}}
                </td>
            </tr>
            <tr>
                <th>Address </th>
                <td>
                    {{$model->address??'N/A'}}
                </td>
            </tr>
            <tr>
                <th>Country </th>
                <td>
                    {{optional($model->countryDetail)->name}}
                </td>
            </tr>
            <tr>
                <th>
                    @if($model->status == '1')
                    Completed Date
                    @else
                    Schedule Date
                    @endif

                </th>
                <td>
                    {{ !empty($model->schedule_date)?date('d/m/Y',strtotime($model->schedule_date)):'N/A' }}
                </td>
            </tr>
            @else
            <tr>
                <th>File </th>
                <td>
                    @if (!empty($model->file_name))

                    @if (in_array($model->document_type,['6','8','9']))
                    <img src="{{asset('storage/frontend/images/file.png')}}" height="150" width="auto"
                        alt="{{$model->file_name}}" />
                    @else
                    <img src="{{asset('storage/uploads/frontend/documents/'.$model->file_name)}}" height="150"
                        width="auto" alt="{{$model->file_name}}" />
                    @endif
                    <div style="padding-top: 5px;">
                        <a href="{{ asset('storage/uploads/frontend/documents/'.$model->file_name) }}"
                            download="{{$model->file_name}}"><i class="fa fa-download"></i> {{$model->file_name}}</a>
                    </div>
                    @else
                    <p>Document file not found.</p>
                    @endif

                </td>
            </tr>
            @endif
            <tr>
                <th>Status </th>
                <td>
                    @if($model->document_type==='10')

                    @if($model->status == '0')
                    Not Audited
                    @elseif($model->status == '1')
                    Audit Completed
                    @else
                    Audit Canceled
                    @endif

                    @else
                    @if($model->status == '0')
                    Pending
                    @elseif($model->status == '1')
                    Approved
                    @else
                    Rejected
                    @endif
                    @endif
                </td>
            </tr>
            @if($model->status == '3' && $model->document_type!=='10')
            <tr>
                <th>Comment </th>
                <td>{{ $model->comments}}</td>
            </tr>
            @endif

        </table>
        <div class="form-actions text-center">
            @if($model->status == '0' && $model->document_type!=='10')
            <form id="descesion_form" action="{{route('user-documents.update',base64_encode($model->id))}}">
                @method('PUT')
                <div class="form-group">
                    <div class="makeDecession">
                        <input type="radio" name="status" value="1" checked> Approve
                        <input type="radio" name="status" value="3"> Reject
                    </div>
                    <div class="help-block"></div>
                </div>
                <div class="form-group col-md-6 reject-comment hide">
                    <label>Comment <span class="required">*</span></label>
                    <textarea name="comments" maxlength="255" class="form-control"></textarea>
                    <div class="help-block"></div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn green">Update</button>
                    <a href="{{ Route('user-documents.index') }}" class="btn default"> Back</a>
                </div>
            </form>
            @elseif($model->status !== '1' && $model->document_type==='10')
            <form id="descesion_form" action="{{route('user-documents.update',base64_encode($model->id))}}">
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Schedule Date <span class="required">*</span></label>
                            <div class="col-md-5">
                                <input type="date" class="form-control" name="schedule_date"
                                    value="{{$model->schedule_date}}" required />
                                <div class="help-block">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="makeDecession" style="display: flex;justify-content: center;">
                                <label class="control-label" style="padding-right: 15px;">
                                    <input type="radio" name="status" value="1"> Audit Completed
                                </label>
                                <label class="control-label" style="padding-right: 15px;">
                                    <input type="radio" name="status" value="0" checked> Audit Re-Scheduled
                                </label>
                                <label class="control-label">
                                    <input type="radio" name="status" value="3">
                                    Audit Cancled
                                </label>
                            </div>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn green">Update</button>
                        <a href="{{  Route('admin-viewuser', ['id' => base64_encode($user->id)]) }}"
                            class="btn default"> Back</a>
                    </div>
                </div>

            </form>
            @else
            <a href="{{ Route('user-documents.index') }}?uid={{base64_encode($user->id)}}" class="btn default"> Back</a>
            @endif

        </div>
        <!-- END FORM-->
    </div>
</div>
@stop