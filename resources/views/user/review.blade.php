@extends('layouts.master')

@section('content')
<div class="">
    <div class="clearfix">

        <div class="dash-bottom-part">
            <div class="bottom-part-2">
                <div class="col-sm-12">
                    <h2 class="dash_heading pl-0">Review</h2>
                    {{-- @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif --}}
                    <div class="white_contentbx customnw mb-3">
                        <h5 class="headingtop">work analytics</h5>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="left_boxz common_bx">
                                    <h1>{{ $total_bid }}</h1>
                                    <p>Total Bid Accepted</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="rightbxnw common_bx">
                                    <h1>{{ $total_project }}</h1>
                                    <p>Total Project completed</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="rightbxnw common_bx">
                                    <h1>
                                        @if(empty($total_review ))
                                        N/A
                                        @else
                                        {{ $total_review }}
                                        @endif
                                        
                                    </h1>
                                    <p>Total Review</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="text-right btn_bx mt-4">
                            <button type="button" id="open_ticket" class="common-btn green custloading">Open A New Ticket</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop

