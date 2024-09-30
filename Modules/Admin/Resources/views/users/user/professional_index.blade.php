@extends('admin::layouts.main')

@section('page_css')

@endsection
@section('breadcrumb')
<li>
    <span class="active">Contractors</span>
</li>
@stop

@section('content')
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            Contractors
        </div>
        {{-- <div class="pull-right"><a href="{{route('admin-adduser')}}" class="btn btn-success"
                style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> --}}
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%"
                    id="professional-management">
                    <thead>
                        <tr>
                            <th class="bold"> # </th>
                            {{-- <th class="bold"> Type </th> --}}
                            <th class="bold"> Name </th>
                            {{-- <th class="bold"> Last Name </th> --}}
                            <th class="bold"> Phone </th>
                            <th class="bold"> City </th>
                            <th class="bold"> Active </th>
                            <th class="bold"> Verified </th>
                            <th class="bold"> Registered Date </th>
                            <th class="bold"> Expire Date </th>
                            <th class="bold"> Subscription Payments </th>
                            <th class="bold"> Tasks </th>
                            <th class="bold"> Accepted </th>
                            <th class="bold"> Reviews </th>
                            <th class="bold"> Total Paid </th>
                            <th class="bold"> Paid/Unpaid </th>
                            {{-- <th class="bold"> Deactivate </th> --}}
                            <th class="bold" width="23%"> Actions </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="extend_plan_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Extend Expire Date</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
          </button>
        </div>
        <form action="{{route('extend-expire-date')}}" id="extend-expire-date" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label>Payment Amount</label>
                <input type="hidden" name="user_id" id="user_id">
                <input type="hidden" name="subscription_id" id="subscription_id">
                <input type="text" name="amount" class="form-control">
                <span class="help-block"></span>
            </div>
            {{-- <div class="form-group">
                <label>Extended Date</label>
                <input type="date" name="end_date" class="form-control">
                <span class="help-block"></span>
            </div> --}}
                {{-- <select name="subscription_id" class="form-control">
                    <option value="">Select subscription plan</option>
                    @foreach ($subscriptions as $subscription)
                    <option value="{{$subscription->id}}">{{$subscription->name}} (${{$subscription->amount}})</option>
                    @endforeach
                </select> --}}
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
</div>
@stop

@section('js')

@stop