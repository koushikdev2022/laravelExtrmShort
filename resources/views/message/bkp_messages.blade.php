@extends('layouts.main')
@section('css')
<style>

</style>
@stop
@section('content')
<!-- Header Start -->
<!-- Header End -->
<!-- Content Start -->
<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="message_bx">
            <div class="d-flex align-items-center flex-column justify-content-center height-class">
                <div class="row justify-content-center h-100 w-100">
                    <div class="col-lg-4 col-sm-5 px-0">
                        <div class="left_chatbx">
                            <h1 class="dash_heading">MESSAGES</h1>
                            <div class="top_bx">
                                <div class="input-group search w-100">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="icofont-search-1"></i></span>
                                    </div>
                                    <input type="text" id="filterReceipent" class="form-control" placeholder="Search"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                            </div>
                            <ul class="contact_list cust-scroll-table" id="contacts" tabindex="5000"
                                style="overflow: hidden; outline: none;">
                                @forelse($recipients as $i=>$sender)

                                @php
                                $user=App\Models\UserMaster::select('first_name','last_name','type_id','id','profile_picture')->where('id',$sender)->first();
                                if(!empty($user)):
                                $connection_id=$connection_arr[$i];
                                $project_title=$project_arr[$i];
                                $last_message=App\Models\Message::where(['connection_id'=>$connection_id])->latest('id')->first();

                                @endphp

                                @if(!empty($user))
                                <li class="contact recipient-box" data-id="{{$user->id??''}}"
                                    data-connection="{{$connection_id}}" data-bcode="{{$connection_bid_codes[$i]}}">

                                    <div class="post_grpbx ligrp_bx">

                                        <div class="meta media connection-img">
                                            <div class="img_cont">
                                                <img src="{{asset('public/uploads/frontend/profile_picture/thumb/'.$user->profile_picture)}}"
                                                    onerror="this.onerror=null;this.src='{{USER_IMG}}';"
                                                    alt="Profile Image" />
                                                <span class="pf-online contact_status{{$user->id??''}}"></span>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-0"><a
                                                        class="name user_info ml-0">{{$user->first_name.' '.$user->last_name}}
                                                        <br> ({{$project_title}})</a> <span
                                                        class="show-time">@if(!empty($last_message))
                                                        {{\Carbon\Carbon::parse($last_message->created_at)->format('h:i A ,M d, Y')}}
                                                        @endif</span></h5>
                                                @if(!empty($last_message))
                                                <p class="preview"
                                                    {{($last_message->from_user_id==$user->id && $last_message->is_read==='0')?'style=font-weight:700;':''}}>
                                                    @if(!empty($last_message))

                                                    @if($last_message->message_type ==='3')
                                                    {{Str::limit($last_message->message,25)}}
                                                    @else
                                                    Media file send.
                                                    @endif

                                                    @endif
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @php
                                endif;
                                @endphp
                                @endif

                                @empty
                                <div class="col-md-12">
                                    <div class="alert alert-info text-center" style="padding:10px 0px;" role="alert">
                                        Sorry! No Chat found.
                                    </div>
                                </div>
                                @endforelse
                            </ul>

                        </div>
                    </div>
                    <div class="col-sm-7 col-lg-8 chat px-0">
                        <div class="card">
                            <div class="card-header msg_head contact-profile d-none">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont active-chat-user-img">
                                            <img src="{{USER_IMG}}" class="rounded-circle user_img">
                                            <!--<span class="pf-online offline"></span>-->
                                        </div>
                                        <div class="user_info active-chat-user-name">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="block_rgt_bx d-none">
                                        <div class="rgt_bx d-flex align-items-center">
                                            <a href="javascript:void(0);"
                                                class="common-btn manageuserstatus blockuser"><i
                                                    class="icofont-ui-block"></i> Block</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="scroll_offset" id="scroll_offset" value="0">
                            <input type="hidden" name="scroll_total" id="scroll_total" value="0">
                            <input type="hidden" name="last_message_id" value="0">
                            <div class="card-body msg_card_body cust-scroll-table messages" id="chatBox" tabindex="5001"
                                style="overflow: hidden; outline: none;">

                            </div>

                            <div class="card-footer message-body-content d-none">
                                <form id="send-msg-form" method="post" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="receiver_id" id="send_receiver_id" value="" />
                                    <input type="hidden" name="connection_id" id="connection_id" value="" />
                                    <input type="hidden" name="last_message_as" value="0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text filesendtoopponent">
                                                <i class="icofont-clip"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="message" class="form-control change test-emoji"
                                            placeholder="Write message here" aria-label="Write message here">
                                        <div class="input-group-append ml-0" id="emoji-picker">
                                            <button class="btn" type="button"><i
                                                    class="icofont-simple-smile"></i></button>
                                        </div>
                                        <div class="input-group-append">
                                            <btn class="common-btn sendmsgbtn" onclick="sendMsg();"><i
                                                    class="icofont-paper-plane"></i> Send</btn>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="alert alert-primary text-center shwblkmsg d-none" role="alert"
                                style="background-color: #563d7c;color: #fff;">
                                <i><strong>Sorry !</strong> You can not conversation with opponent.</i>
                            </div>
                        </div>
                        @include('message.emoji')
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
<input type="hidden" id="getcode" value="{{$code}}" />
@stop

@section('js')
<script type="text/javascript" src="{{asset('public/frontend/js/jquery.nicescroll.js')}}"></script>
{!!script_version('/frontend/custom/js/chat.js') !!}
<script type="text/javascript">
$(document).ready(function() {
    $(document).on("click", "#emoji-picker", function(e) {
        e.stopPropagation();
        $('.intercom-composer-emoji-popover').toggleClass("active");
    });

    $(document).click(function(e) {
        if ($(e.target).attr('class') != '.intercom-composer-emoji-popover' && $(e.target).parents(
                ".intercom-composer-emoji-popover").length == 0) {
            $(".intercom-composer-emoji-popover").removeClass("active");
        }
    });

    $(document).on("click", ".intercom-emoji-picker-emoji", function(e) {
        var reviou = $(".test-emoji").val();
        $(".test-emoji").val(reviou + $(this).html());
    });

    $('.intercom-composer-popover-input').on('input', function() {
        var query = this.value;
        if (query != "") {
            $(".intercom-emoji-picker-emoji:not([title*='" + query + "'])").hide();
        } else {
            $(".intercom-emoji-picker-emoji").show();
        }
    });

    $('input[name="message"]').keypress(function(event) {
        if (event.which == 13) {
            sendMsg()
        }
    });
});

$(function() {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready(function() {
        $(':file').on('fileselect', function(event, numFiles, label) {
            $('.file-upload-wrapper').attr('data-text', label);
        });
    });

});
</script>
@stop