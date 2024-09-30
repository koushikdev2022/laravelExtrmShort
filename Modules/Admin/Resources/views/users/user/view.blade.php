@extends('admin::layouts.main')

@section('breadcrumb')
<li>
    @if($model->type_id==2)
    <a href="{{ Route('admin-user') }}">Users</a>
    @elseif($model->type_id==3)
    <a href="{{ Route('admin-professional') }}">Contractor</a>
    @endif
</li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of
                {{ $model->first_name.' '.$model->last_name }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal form-row-seperated" onsubmit="return false;">
            @csrf
            <div class="form-body">

                <div class="form-group {{ $errors->has('profile_picture') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Profile Picture :</label>
                    <div class="col-md-8">
                        <img src="{{ ($model->profile_picture != '') ? URL::asset('public/uploads/frontend/profile_picture/thumb/' . $model->profile_picture) : URL::asset('public/frontend/user/images/user.jpg') }}" alt="" style="width:150px;height:150px;" class="form-control">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Name :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->name }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Email :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->email }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">First Name :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->first_name }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Last Name :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->last_name }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Phone :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->phone }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('address_line1') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Physical Address :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->address_line1 }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">City :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->city }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">State :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->state }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('zipcode') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Zip Code :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->zipcode }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('bio') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Bio :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->bio }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('about_me') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">About Me :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->about_me }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('twitter') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Twitter :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->twitter }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('intragram') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Instagram :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->intragram }}</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Website :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ $model->website }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Status :</label>
                    <div class="col-md-8">
                        <div class="radio-list">
                            @if($model->status==1)
                            <p class="btn btn-secondary">Active</p>
                            @elseif($model->status==2)
                            <p class="btn btn-secondary">Banned</p>
                            @elseif($model->status==3)
                            <p class="btn btn-secondary">Deleted</p>
                            @else
                            <p class="btn btn-secondary">Inactive</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('created_at') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Registered On :</label>
                    <div class="col-md-8">
                        <p class="btn btn-secondary">{{ date("jS M Y, g:i A", strtotime($model->created_at)) }}</p>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <a href="{{ Route('admin-updateuser', ['id' => base64_encode($model->id)]) }}" class="btn green">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a href="{{ Route('admin-updateverify', ['id' => base64_encode($model->id)]) }}" class="btn yellow">
                            {{(!empty($profile_verify) && $profile_verify->profile==0) ? 'Verify':'Unverify'}}
                        </a>
                        <a href="{{ Route('admin-user') }}" class="btn default"> Back</a>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <form class="form-horizontal">

    </form>
    <!-- END FORM-->
</div>

<div class="dashtab_area">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">User identity DOCUMENTS</span>
        </div>
    </div>
    <div class="table_bx">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID DOCUMENT</th>
                        <th scope="col">COUNTRY</th>
                        <th scope="col">UPLOADED Date</th>
                        <th scope="col">MANAGEMENT</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($identity_documents as $identity_document)
                    <tr>
                        <td data-label="ID DOCUMENT">
                            {{ ucfirst($identity_document->which_document) }}
                        </td>
                        <td data-label="COUNTRY">
                            {{ $country_name }}
                        </td>
                        <td data-label="UPLOADED Date">
                            {{ $identity_document->created_at->format('jS M Y, g:i A') }}
                        </td>
                        <td data-label="MANAGEMENT">
                            <a href="#" class="btn green" data-toggle="modal" data-target="#viewmodal_{{$identity_document->id}}">View</a>
                            <a href="{{asset('storage/uploads/frontend/documents/'.$identity_document->file_name)}}" download="{{ $identity_document->file_name }}" class="btn green">Download
                            </a>
                            @include('admin::users.document.modalview',['identity_document'=>$identity_document,'showphoto'=>true])

                            <!-- <a href="#" class="btn green">Delete</a> -->
                            @if ($identity_document->status==='0')
                            <a href="#" onclick="confirmApproveOrReject(this);" data-title="Approve Identity Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($identity_document->id),'type'=>'approve'])}}" class="btn green">Approve</a>
                            <a href="#" onclick="confirmApproveOrReject(this);" data-title="Reject Identity Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($identity_document->id),'type'=>'reject'])}}" class="btn green">Reject</a>
                            @endif
                        </td>
                        <td data-label="STATUS">
                            @if ($identity_document->status==='0')
                            <span class="badge badge-primary"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                Pending
                            </span>
                            @elseif ($identity_document->status==='1')
                            <span class="badge badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                Approved
                            </span>
                            @else
                            <span class="badge badge-danger"><i class="fa fa-exclamation" aria-hidden="true"></i>
                                Rejected
                            </span>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No identity documents uploaded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="dashtab_area">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">DOCUMENTS</span>
        </div>
    </div>
    <div class="table_bx">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">DOCUMENT</th>
                        <th scope="col">COUNTRY</th>
                        <th scope="col">UPLOADED Date</th>
                        <th scope="col">MANAGEMENT</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                    <tr>
                        <td data-label="ID DOCUMENT">
                            {{ ucfirst($document->which_document) }}
                        </td>
                        <td data-label="COUNTRY">
                            {{ $country_name }}
                        </td>
                        <td data-label="UPLOADED Date">
                            {{ $document->created_at->format('jS M Y, g:i A') }}
                        </td>
                        <td data-label="MANAGEMENT">

                            <a href="{{asset('storage/uploads/frontend/documents/'.$document->file_name)}}" class="btn green" target="_blank">View</a>
                            <a href="{{asset('storage/uploads/frontend/documents/'.$document->file_name)}}" download="{{ $document->file_name }}" class="btn green">Download
                            </a>
                            @include('admin::users.document.modalview',['document'=>$document,'showphoto'=>true])


                            @if ($document->status==='0')
                            <a href="#" onclick="confirmApproveOrReject(this);" data-title="Approve Identity Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($document->id),'type'=>'approve'])}}" class="btn green">Approve</a>
                            <a href="#" onclick="confirmApproveOrReject(this);" data-title="Reject Identity Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($document->id),'type'=>'reject'])}}" class="btn green">Reject</a>
                            @endif
                        </td>
                        <td data-label="STATUS">
                            @if ($document->status==='0')
                            <span class="badge badge-primary"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                Pending
                            </span>
                            @elseif ($document->status==='1')
                            <span class="badge badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                Approved
                            </span>
                            @else
                            <span class="badge badge-danger"><i class="fa fa-exclamation" aria-hidden="true"></i>
                                Rejected
                            </span>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No documents uploaded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <div class="dashtab_area">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-eye font-green-haze"></i>
                            <span class="caption-subject font-green-haze bold uppercase">Business identity DOCUMENTS</span>
                        </div>
                    </div>
                    <div class="table_bx">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">DOCUMENT</th>
                                        <th scope="col">DOCUMENT TYPE</th>
                                        <th scope="col">UPLOADED Date</th>
                                        <th scope="col">MANAGEMENT</th>
                                        <th scope="col">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($business_documents as $identity_document)
                                    @php
                                    $document_type = 'Business Registration';
                                    if ($identity_document->document_type === '7') {
                                    $document_type = 'Premises Photo';
                                    } elseif ($identity_document->document_type === '8') {
                                    $document_type = 'Internet Speed';
                                    }
                                    @endphp
                                    <tr>
                                        <td data-label="DOCUMENT">
                                            {{ $identity_document->file_name }}
</td>
<td data-label="DOCUMENT TYPE">
    {{ $document_type }}
</td>
<td data-label="UPLOADED Date">
    {{ $identity_document->created_at->format('jS M Y, g:i A') }}
</td>
<td data-label="MANAGEMENT">
    <a href="#" class="btn green" data-toggle="modal" data-target="#viewmodal_{{$identity_document->id}}">View</a>
    <a href="{{asset('storage/uploads/frontend/documents/'.$identity_document->file_name)}}" download="{{ $identity_document->file_name }}" class="btn green">Download
    </a>
    @include('admin::users.document.modalview',['identity_document'=>$identity_document,'showphoto'=>false])
    <!-- <a href="#" class="btn green">Delete</a> -->
    @if ($identity_document->status==='0')
    <a href="#" onclick="confirmApproveOrReject(this);" data-title="Approve {{$document_type}} Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($identity_document->id),'type'=>'approve'])}}" class="btn green">Approve</a>
    <a href="#" onclick="confirmApproveOrReject(this);" data-title="Reject Identity Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($identity_document->id),'type'=>'reject'])}}" class="btn green">Reject</a>
    @endif
</td>
<td data-label="STATUS">
    @if ($identity_document->status==='0')
    <span class="badge badge-primary"><i class="fa fa-check-circle" aria-hidden="true"></i>
        Pending
    </span>
    @elseif ($identity_document->status==='1')
    <span class="badge badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
        Approved
    </span>
    @else
    <span class="badge badge-danger"><i class="fa fa-exclamation" aria-hidden="true"></i>
        Rejected
    </span>
    @endif

</td>
</tr>
@empty
<tr>
    <td colspan="5">No Business identity documents uploaded yet.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div> --}}

{{-- <div class="dashtab_area">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-eye font-green-haze"></i>
                <span class="caption-subject font-green-haze bold uppercase">DOCUMENTS</span>
            </div>
        </div>
        <div class="table_bx">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">FILE</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">UPLOADED Date</th>
                            <th scope="col">MANAGEMENT</th>
                            <th scope="col">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($certificates as $identity_document)
                        <tr>
                            <td data-label="FILE">
                                {{ $identity_document->file_name }}
</td>
<td data-label="TITLE">
    {{ $identity_document->document_title }}
</td>
<td data-label="UPLOADED Date">
    {{ $identity_document->created_at->format('jS M Y, g:i A') }}
</td>
<td data-label="MANAGEMENT">
    <a href="#" class="btn green" data-toggle="modal" data-target="#viewmodal_{{$identity_document->id}}">View</a>
    <a href="{{asset('storage/uploads/frontend/documents/'.$identity_document->file_name)}}" download="{{ $identity_document->file_name }}" class="btn green">Download
    </a>
    @include('admin::users.document.modalview',['identity_document'=>$identity_document,'showphoto'=>false])

    <!-- <a href="#" class="btn green">Delete</a> -->
    @if ($identity_document->status==='0')
    <a href="#" onclick="confirmApproveOrReject(this);" data-title="Approve Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($identity_document->id),'type'=>'approve'])}}" class="btn green">Approve</a>
    <a href="#" onclick="confirmApproveOrReject(this);" data-title="Reject Document" data-href="{{route('updatedocument.response',['id'=>base64_encode($identity_document->id),'type'=>'reject'])}}" class="btn green">Reject</a>
    @endif
</td>
<td data-label="STATUS">
    @if ($identity_document->status==='0')
    <span class="badge badge-primary"><i class="fa fa-check-circle" aria-hidden="true"></i>
        Pending
    </span>
    @elseif ($identity_document->status==='1')
    <span class="badge badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
        Approved
    </span>
    @else
    <span class="badge badge-danger"><i class="fa fa-exclamation" aria-hidden="true"></i>
        Rejected
    </span>
    @endif

</td>
</tr>
@empty
<tr>
    <td colspan="5">No Document uploaded yet.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div> --}}

{{-- <div class="dashtab_area">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-eye font-green-haze"></i>
                <span class="caption-subject font-green-haze bold uppercase">Business Audit</span>
            </div>
        </div>
        <div class="table_bx">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">CONTACT EMAIL</th>
                            <th scope="col">PHONE NUMBER</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">AUDIT DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($business_audit))
                        <tr>
                            <td data-label="NAME">
                                {{ $business_audit->contact_name }}
</td>
<td data-label="ADDRESS">
    {{ $business_audit->address }},
    {{ optional($business_audit->countryDetail)->name }}
</td>
<td data-label="CONTACT EMAIL">
    {{ $business_audit->contact_email }}
</td>
<td data-label="PHONE NUMBER">
    {{ $business_audit->contact_phone }}
</td>
<td data-label="STATUS">
    @if ($business_audit->status==='0')
    <span class="badge badge-primary"><i class="fa fa-check-circle" aria-hidden="true"></i>
        Submitted
    </span>

    @elseif ($business_audit->status==='1')
    <span class="badge badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
        Completed
    </span>
    @else
    <span class="badge badge-danger"><i class="fa fa-exclamation" aria-hidden="true"></i>
        Canceled
    </span>
    @endif

</td>
<td data-label="AUDIT DATE">
    {{!empty($business_audit->schedule_date)? \Carbon\Carbon::parse($business_audit->schedule_date)->format('jS M Y'):'' }}
    @if ($business_audit->status==='0')
    <br>
    <a href="{{ route('user-documents.show',base64_encode($business_audit->id)) }}" class="btn green">Schedule
    </a>
    @endif
</td>
</tr>
@else
<tr>
    <td colspan="6">No Certificate uploaded yet.</td>
</tr>
@endif
</tbody>
</table>
</div>
</div>
</div> --}}
</div>
@stop