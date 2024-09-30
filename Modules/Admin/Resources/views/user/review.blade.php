

@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Review</li>
@stop

@section('content')
<h3 class="page-title">Review
    <small>View all the Clients Reviews</small>
</h3>

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
            <div class="caption">
                    <i class="icon-envelope font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Reviews</span>
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>

                                <tr>
                                    <th class="bold"> # </th>
                                    <th class="bold"> User Name </th>
                                    <th class="bold"> Client Name </th>
                                    <th class="bold"> Rating </th>
                                    <th class="bold"> Review Date </th>
                                    <th class="bold"> Message </th>
                                    <th class="bold"> Status </th>
                                    <th class="bold"> Actions </th>
                                </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $key=>$data)
                                <tr>
                                    <td> {{ $key+1 }} </td>
                                    <td> {{ $data->user_name }} </td>
                                    <td> {{ $data->client_name }} </td>

                                    <td> {{ $data->score }} </td>
                                    <td> {{ $data->created_at }} </td>
                                    <td> {{ $data->message }} </td>
                                    <td data-label="Status"><span class="badge @if($data->status == 0) badge-warning @else {{ ($data->status == 1 ? 'badge-success' : 'badge-danger')  }} @endif  mb-0 even-larger-badge">@if($data->status == 0) Panding @else {{ ($data->status == 1 ? 'Approved' : 'Rejected')  }} @endif</span></td>
                                    <td>
                                        <a href="ReviewstatusUpdate/{{ base64_encode($data->id) }}?status=1" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Approve"><i class="fa fa-check"></i></a>
                                        <a href="ReviewstatusUpdate/{{ base64_encode($data->id) }}?status=3" class="btn btn-outline btn-circle btn-sm red" data-toggle="tooltip" title="Reject"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@stop
