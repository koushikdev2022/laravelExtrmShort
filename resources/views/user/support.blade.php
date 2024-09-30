@extends('layouts.master')

@section('content')
<div class="">
    <div class="clearfix">

        <div class="dash-bottom-part">
            <div class="bottom-part-2">
                <div class="col-sm-12">
                    <h2 class="dash_heading pl-0">Support Tickets</h2>
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="white_contentbx customnw mb-3">
                        <h5 class="headingtop">Support Ticket List</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="left_boxz common_bx">
                                    <h1>{{ $open_tickets }}</h1>
                                    <p>ACTIVE TICKETS</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="rightbxnw common_bx">
                                    <h1>{{ $close_tickets }}</h1>
                                    <p>RESOLVED TICKETS</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-right btn_bx mt-4">
                            <button type="button" id="open_ticket" class="common-btn green custloading">Open A New Ticket</button>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{  route('user.support-store') }}" method="POST" id="support-ticket-form">
                @csrf
                <div class="bottom-part-2" id="ticket_form" style="display: none;">
                    <div class="col-sm-12">
                        <div class="white_contentbx customnwopen_thd mb-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="headingarea">Open A Ticket</h5>
                                    <div class="mt-3 mb-3 form-group">
                                        <label class="font-weight-bold">Subject</label>
                                        <input type="text" name="subject" class="form-control" placeholder="">
                                        <span class="help-block"></span>
                                    </div>

                                    <div class=" pahi d-block mb-3 form-group">
                                        <label class="font-weight-bold">How can we help you? </label>
                                        <textarea class="form-control new_design pt-0" name="description"></textarea>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="text-right btn_bx mt-3">
                                        <button type="submit" class="common-btn green custloading">Submit</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </form>
            @if($support_tickets===0)
            <div class="bottom-part-2">
                <div class="col-sm-12">
                    <div class="white_contentbx customnw mb-3 border-left border-4 border-danger">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert_bx">
                                    <p class="m-0">You have no active support tickets.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="bottom-part-2">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table_bx nw_table support_area datatable">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="support_management">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Ticket Id</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($supports as $key=>$support)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$support->ticket_id}}</td>
                                                <td>{{date("jS M Y, g:i A", strtotime($support->created_at))}}</td>
                                                <td>{{$support->subject}}</td>
                                                <td>
                                                    @if($support->status==1)
                                                    <span class="label label-sm label-warning">Open</span>
                                                    @elseif($support->status==2)
                                                    <span class="label label-sm label-success">Closed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{Route('user.show-Tickets', ['id' => base64_encode($support->id)])}}" class="btn mb-0" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
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
            </div>
            @endif
        </div>

    </div>
</div>
@stop
@section('js')
<script>
   $("#open_ticket").click(function() {
    $("#ticket_form").toggle();
   });
</script>
@stop
