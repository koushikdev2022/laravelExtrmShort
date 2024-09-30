@extends('layouts.master')

@section('content')

    <div class="clearfix">

        <div class="dash-bottom-part">
            <div class="bottom-part-2">
                <div class="col-sm-12">
                    <h2 class="dash_heading pl-0">Support Tickets</h2>
                    <div class="white_contentbx customnw mb-3">
                        <h5 class="headingtop">Support Ticket Reply By Admin</h5>

                        <div class="ticketsBox mt-4">
                            <div class="row">
                                <div class="col-md-3"><p><b>Subject</b></p></div>
                                <div class="col-md-9"><p>: {{$support->subject}}</p></div>

                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div><img src="{{!empty($support->user->profile_picture) && ($support->user->profile_picture != '') ? asset('storage/uploads/frontend/profile_picture/original/'.$support->user->profile_picture) : asset('storage/frontend/images/profile/dummyProfile.jpg')}}" onerror="this.onerror=null;this.src='{{asset("storage/frontend/images/profile/dummyProfile.jpg")}}';" alt=""></div>
                                        <div><b>{{$support->user->name}}</b></div>
                                    </div>
                                </div>
                                <div class="col-md-9"><p>: {{$support->description}}</p></div>

                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div><img src="{{asset('storage/frontend/images/profile/dummyProfile.jpg')}}" alt=""></div>
                                        <div><b>Admin</b></div>
                                    </div>
                                </div>
                                <div class="col-md-9"><p>: {{$support->admin_reply}}</p></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    @stop
