@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Dashboard</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_user}}">{{$total_user}}</span>
                        {{-- <span data-counter="counterup" data-value="0">0</span> --}}
                    </h3>
                    <small>TOTAL USERS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> users </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_active_user}}">{{$total_active_user}}</span>
                        {{-- <span data-counter="counterup" data-value="0">0</span> --}}
                    </h3>
                    <small>TOTAL ACTIVE USERS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> active users </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_inactive_user}}">{{$total_inactive_user}}</span>
                        {{-- <span data-counter="counterup" data-value="0">0</span> --}}
                    </h3>
                    <small>TOTAL INACTIVE USERS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-user-times" aria-hidden="true"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> inactive users </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>

@stop
@section('js')
@stop