@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('storage/frontend/custom/uploader/jquery.growl.css')}}" />
<link rel="stylesheet" href="{{asset('storage/frontend/custom/uploader/src/fileup.css')}}" />
<style>
    .intercom-composer-popover-input{
        font-size-adjust: none;
        font-size: 100%;
        font-style: normal;
        letter-spacing: normal;
        font-stretch: normal;
        font-variant: normal;
        font-weight: 400;
        font: normal normal 100% "intercom-font", "Helvetica Neue", Helvetica, Arial, sans-serif;
        text-align: left;
        text-align-last: auto;
        text-decoration: none;
        -webkit-text-emphasis: none;
        text-emphasis: none;
        text-height: auto;
        text-indent: 0;
        text-justify: auto;
        text-outline: none;
        text-shadow: none;
        text-transform: none;
        text-wrap: normal;
        alignment-adjust: auto;
        alignment-baseline: baseline;
        -webkit-animation: none 0 ease 0 1 normal;
        animation: none 0 ease 0 1 normal;
        -webkit-animation-play-state: running;
        animation-play-state: running;
        -webkit-appearance: normal;
        -moz-appearance: normal;
        appearance: normal;
        azimuth: center;
        -webkit-backface-visibility: visible;
        backface-visibility: visible;
        background: none 0 0 auto repeat scroll padding-box transparent;
        background-color: transparent;
        background-image: none;
        baseline-shift: baseline;
        binding: none;
        bleed: 6pt;
        bookmark-label: content();
        bookmark-level: none;
        bookmark-state: open;
        bookmark-target: none;
        border: 0 none transparent;
        border-radius: 0;
        bottom: auto;
        box-align: stretch;
        -webkit-box-decoration-break: slice;
        box-decoration-break: slice;
        box-direction: normal;
        box-flex: 0.0;
        box-flex-group: 1;
        box-lines: single;
        box-ordinal-group: 1;
        box-orient: inline-axis;
        box-pack: start;
        box-shadow: none;
        box-sizing: content-box;
        -webkit-column-break-after: auto;
        break-after: auto;
        -webkit-column-break-before: auto;
        break-before: auto;
        -webkit-column-break-inside: auto;
        break-inside: auto;
        caption-side: top;
        clear: none;
        clip: auto;
        color: inherit;
        color-profile: auto;
        -webkit-column-count: auto;
        -moz-column-count: auto;
        column-count: auto;
        -webkit-column-fill: balance;
        -moz-column-fill: balance;
        column-fill: balance;
        -webkit-column-gap: normal;
        -moz-column-gap: normal;
        column-gap: normal;
        -webkit-column-rule: medium medium #1f1f1f;
        -moz-column-rule: medium medium #1f1f1f;
        column-rule: medium medium #1f1f1f;
        -webkit-column-span: 1;
        -moz-column-span: 1;
        column-span: 1;
        -webkit-column-width: auto;
        -moz-column-width: auto;
        column-width: auto;
        -webkit-columns: auto auto;
        -moz-columns: auto auto;
        columns: auto auto;
        content: normal;
        counter-increment: none;
        counter-reset: none;
        crop: auto;
        cursor: auto;
        direction: ltr;
        display: inline;
        dominant-baseline: auto;
        drop-initial-after-adjust: text-after-edge;
        drop-initial-after-align: baseline;
        drop-initial-before-adjust: text-before-edge;
        drop-initial-before-align: caps-height;
        drop-initial-size: auto;
        drop-initial-value: initial;
        elevation: level;
        empty-cells: show;
        fit: fill;
        fit-position: 0 0;
        float: none;
        float-offset: 0 0;
        grid-columns: none;
        grid-rows: none;
        hanging-punctuation: none;
        height: auto;
        hyphenate-after: auto;
        hyphenate-before: auto;
        hyphenate-character: auto;
        hyphenate-lines: no-limit;
        hyphenate-resource: none;
        -webkit-hyphens: manual;
        -ms-hyphens: manual;
        hyphens: manual;
        icon: auto;
        image-orientation: auto;
        image-rendering: auto;
        image-resolution: normal;
        inline-box-align: last;
        left: auto;
        line-height: inherit;
        line-stacking: inline-line-height exclude-ruby consider-shifts;
        list-style: disc outside none;
        margin: 0;
        marks: none;
        marquee-direction: forward;
        marquee-loop: 1;
        marquee-play-count: 1;
        marquee-speed: normal;
        marquee-style: scroll;
        max-height: none;
        max-width: none;
        min-height: 0;
        min-width: 0;
        move-to: normal;
        nav-down: auto;
        nav-index: auto;
        nav-left: auto;
        nav-right: auto;
        nav-up: auto;
        opacity: 1;
        orphans: 2;
        outline: medium none invert;
        outline-offset: 0;
        overflow: visible;
        overflow-style: auto;
        padding: 0;
        page: auto;
        page-break-after: auto;
        page-break-before: auto;
        page-break-inside: auto;
        page-policy: start;
        -webkit-perspective: none;
        perspective: none;
        -webkit-perspective-origin: 50% 50%;
        perspective-origin: 50% 50%;
        pointer-events: auto;
        position: static;
        presentation-level: 0;
        punctuation-trim: none;
        quotes: none;
        rendering-intent: auto;
        resize: none;
        right: auto;
        rotation: 0;
        rotation-point: 50% 50%;
        ruby-align: auto;
        ruby-overhang: none;
        ruby-position: before;
        ruby-span: none;
        size: auto;
        string-set: none;
        table-layout: auto;
        top: auto;
        -webkit-transform: none;
        -ms-transform: none;
        transform: none;
        -webkit-transform-origin: 50% 50% 0;
        -ms-transform-origin: 50% 50% 0;
        transform-origin: 50% 50% 0;
        -webkit-transform-style: flat;
        transform-style: flat;
        transition: all 0 ease 0;
        unicode-bidi: normal;
        vertical-align: baseline;
        white-space: normal;
        white-space-collapse: collapse;
        widows: 2;
        width: auto;
        word-break: normal;
        word-spacing: normal;
        word-wrap: normal;
        z-index: auto;
        text-align: start;
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(enabled=false)";
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;

    }
    .intercom-composer-popover {
        z-index: 2147483003;
        position: absolute;
        bottom: 50px;
        right: calc(50% - 165px);
        box-shadow: 0 1px 15px 1px rgba(0,0,0,.08);
        background-color: #fff;
        border-radius: 6px;
        transition-duration: 200ms;
        transition-delay: 0ms;
        transform-style: flat;
        transform-origin: 50% 50% 0;
        opacity: 0;
        transition: all 0.2s linear;
        visibility: hidden;
    }
    .intercom-composer-popover.active{
        visibility: visible;
        opacity:1;
        bottom: 70px;
        background-color: #fff;
    }
    .intercom-emoji-picker {
        width: 330px;
        height: 260px;
    }
    .intercom-composer-popover-header {
        position: absolute;
        top: 0;
        left: 20px;
        right: 20px;
        height: 40px;
        border-bottom: 1px solid #edeff1;
    }
    .intercom-composer-popover-input {
        background-image: url(https://js.intercomcdn.com/images/search.7ae40c25.png);
        background-size: 16px 16px;
        background-repeat: no-repeat;
        background-position: 0 12px;
        font-weight: 400;
        font-size: 14px;
        color: #6e7a89;
        padding-left: 25px;
        height: 40px;
        width: 100%;
        box-sizing: border-box;
        background-image: url(https://js.intercomcdn.com/images/search@2x.9f02b9f3.png);
        border:none;
        outline: none;
    }
    .intercom-composer-popover-body {
        position: absolute;
        top: 40px;
        left: 0;
        right: 0;
        bottom: 5px;
        padding: 0 20px;
        overflow-y: scroll;
    }
    .intercom-emoji-picker-group {
        margin: 10px -5px;
    }
    .intercom-emoji-picker-group {
        margin: 10px -5px;
    }
    .intercom-emoji-picker-group-title {
        color: #b8c3ca;
        font-weight: 400;
        font-size: 13px;
        margin: 5px;
    }
    .intercom-emoji-picker-emoji {
        padding: 5px;
        width: 30px;
        line-height: 30px;
        display: inline-table;
        text-align: center;
        cursor: pointer;
        vertical-align: middle;
        font-size: 28px;
        transition: -webkit-transform 60ms ease-out;
        transition: transform 60ms ease-out;
        transition: transform 60ms ease-out,-webkit-transform 60ms ease-out;
        transition-delay: 60ms;
        font-family: Apple Color Emoji,Segoe UI Emoji,NotoColorEmoji,Segoe UI Symbol,Android Emoji,EmojiSymbols;
    }
    .intercom-emoji-picker-emoji:hover {
        transition-delay: 0ms;
        -webkit-transform: scale(1.4);
        -ms-transform: scale(1.4);
        transform: scale(1.4);
    }
    .intercom-composer-popover-caret {
        position: absolute;
        bottom: -8px;
        right: 0;
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid #fff;
        left:20px;
    }
    .frame .sidepanel .chat_list ul li.contact .wrap span.date span.picon{
        background-color: #ffffff;
        color: #107eec;
        position: relative;
        left: 5px;
        padding: 2px 5px;
        font-size: 10px;
        border: 1px solid #fff;
    }
    .contact_status_red{
        background: red !important;
    }
    .frame .content .message-input .wrap textarea{
        float: left;
        border: none;
        width: 100%;
        padding: 11px 32px 10px 8px;
        font-size: 0.8em;
        color: #32465a;
        height: 50px !important;
        min-height:50px !important;
        resize: none;
    }
    .image-upload{
        font-size: 16px;
    margin-right: 10px;
    margin-top: 13px;
    }
    .addEmoji{
        font-size: 16px;
    margin-top: 13px;
    }
</style>
@stop
@section('content')
<div class="clearfix">
    <div class="dash-bottom-part pb-0">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="frame">
                    <div id="sidepanel" class="sidepanel">
                        <div id="search">
                            <label><i class="fa fa-search" aria-hidden="true"></i></label>
                            {{-- <input type="text" id="filterReceipent" placeholder="Search for people" /> --}}
                            <input type="text" id="filterReceipent" placeholder="Search Expert..." name="search" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" />
                            <button class="chatBtnSearch" type="button" data-toggle="modal" data-target="#add-user"><i class="icofont-chat"></i> <i class="icofont-plus-circle"></i></button>
                        </div>
                        <div id="contacts" class="chat_list contacts">
                            <ul>
                                @forelse($recipients as $i=>$sender)

                                @php
                                $user=App\Models\UserMaster::select('first_name','last_name','type_id','id','profile_picture')->where('id',$sender)->first();
                                if(!empty($user)):
                                $connection_id=$connection_arr[$i];
                                $project_title=$project_arr[$i];
                                $last_message=App\Models\Message::where(['connection_id'=>$connection_id])->latest('id')->first();

                                @endphp
                                @if(!empty($user))
                                <li class="contact {{ ($i==0) ? 'first-chat' : '' }} select-chat{{$user->id}} recipient-box" data-id="{{$user->id??''}}" data-connection="{{$connection_id}}" data-bcode="{{$connection_bid_codes[$i]}}">
                                    <div class="wrap">
                                        <span class="contact-status online contact_status{{$user->id??''}}"></span>
                                        <img src="{{asset('storage/uploads/frontend/profile_picture/thumb/'.$user->profile_picture)}}" onerror="this.onerror=null;this.src='{{asset("storage/frontend/assets/images/profile_user.png")}}';" alt="profile image" />
                                        <div class="meta">
                                            <p class="name user_info">{{$user->first_name.' '.$user->last_name}} <span class="date">@if(!empty($last_message)) {{\Carbon\Carbon::parse($last_message->created_at)->format('h:i A ,M d, Y')}} @endif </span></p>
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
                                </li>
                                @endif
                                @php
                                endif;
                                @endphp

                                @empty
                                <div class="col-md-12">
                                    <div class="alert alert-info text-center" style="padding:10px 0px;" role="alert">
                                        Sorry! No Chat found.
                                    </div>
                                </div>
                                @endforelse
                            </ul>
                        </div>
                        <!--                                    <div id="bottom-bar">
                                                                                        <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
                                                                                        <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
                                                                                    </div>-->
                    </div>
                    <div class="content">
                        <div class="msg_head contact-profile d-none">
                            <img src="{{asset("storage/frontend/assets/images/profile_user.png")}}" class="active-chat-user-img" alt="" />
                            <p class="active-chat-user-name"></p>
                            <div class="social-media camera">
                                <!-- <a href="#" class="video_call">
                                    <i class="fa fa-video-camera m-0" aria-hidden="true"></i>
                                </a> -->
                                {{-- <a href="#" class="common-btn userptofilelink">View Profile</a> --}}
                            </div>
                        </div>

                        <input type="hidden" name="scroll_offset" id="scroll_offset" value="0">
                        <input type="hidden" name="scroll_total" id="scroll_total" value="0">
                        <input type="hidden" name="last_message_id" value="3">
                        <div class="messages  chat-history" id='chat-history'>
                            <ul class='msg_card_body cust-scroll-table messages bfchat' id="chatBox">
                            </ul>
                            
                        </div>
                        <div class="message-input  message-body-content d-none">
                        <form id="send-msg-form" method="post" autocomplete="off">


                                <input type="hidden" name="receiver_id" id="send_receiver_id" value="" />
                                <input type="hidden" name="connection_id" id="connection_id" value="" />
                                <input type="hidden" name="last_message_as" value="0">
                                <input type="hidden" name="media_file" value="1" />

                                <div class="wrap mx-0 messagetext align-items-stretch">
                                    <textarea type="text" ref="message_box" name="message" class="textareaMsg message_text change test-emoji" rows="2" placeholder="Write your message..." id="upload-2-dropzone"></textarea>
                                    <span class="addEmoji">
                                    <i class="icofont-simple-smile attacharea messageicon" id="emoji-picker"></i>
                                    </span>
                                    <div class="image-upload">
                                        <label for="mySendFiles" class="mb-0">
                                           <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                                        </label>

                                        <input name="file_names[]" id="mySendFiles" type="file"
                                            class="file-upload-field form-control" multiple style="display:none">
                                    </div>
                                    <button type="button" class="submit sendmsgbtn" onclick="sendMsg();"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </div>
                                <div id="upload-2-queue" class="queue"></div>
                                </div>

                                </form>
                                <!-- <div class="message-input">
                                    <div class="wrap">
                                        <input type="text" placeholder="Write your message...">
                                        <i class="icofont-simple-smile attacharea messageicon"></i>
                                        <i class="fa fa-paperclip attachment messageicon" aria-hidden="true"></i>
                                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    </div>
                                </div> -->

                        <div class="alert alert-primary text-center shwblkmsg d-none" role="alert" style="background-color: #563d7c;color: #fff;">
                            <i><strong>Sorry !</strong> You can not conversation with opponent.</i>
                        </div>
                    </div>
                    @include('message.emoji')
                </div>
            </div>

        </div>
    </div>
</div>
<input type="hidden" id="getcode" value="{{$code}}" />
<div class="modal fade cust-my-modal genrmodal" id="upload_media_modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="exampleModalLabel">Send Media</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="create-post common-dash-form adjh">
                    <form id="send_upload_msg_form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="media_file" value="1" />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Upload</label>
                                    <div class="file-upload-wrapper" data-text="Upload here">
                                        <input name="file_names[]" id="mySendFiles" type="file"
                                            class="file-upload-field form-control" multiple>
                                        <!--<div class="droptarget">drop here</div>-->
                                    </div>

                                    <div id="upload-2-queue" class="queue"></div>
                                    <a class="control-button btn btn-link" style="display: none"
                                        href="javascript:$.fileup('upload-2', 'upload', '*')">Upload all</a>
                                    <a class="control-button btn btn-link" style="display: none"
                                        href="javascript:$.fileup('upload-2', 'remove', '*')">Remove all</a>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center save mb-3 dash_btnwrp">
                            <button type="submit" class="common-btn upbtn"><i class="icofont-upload-alt"></i>
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- modal for new user  -->
<div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered addChatModal">
      <div class="modal-content shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user"></i> Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="mt-2 space-y-6 c-form" id="MessageAddConnection" action="" method="post"> 
        <div class="form-floating mb-3">
              <input type="text" class="form-control" name="recommendation" id="addUserAutocomplete" placeholder="username">
              <input type="hidden" name="to_id" id="txtAllowSearchMessageID">
              <label for="addUserAutocomplete">Type User Name</label>
              <div id="emailHelp" class="form-text">example : username</div>
              </div>
              {{-- <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" name="message" id="floatingTextarea2" style="height: 100px"></textarea>
              <label for="floatingTextarea2">Type your message here...</label>
              </div> --}}
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn postBtn btnSuccess form-login-action"><i class="icofont-paper-plane"></i> Send</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <input type="hidden" id="get_message_user_id" value="{{$message_user_id}}" class="video_call_id">
@stop
@section('js')
{{-- {!!script_version('/frontend/custom/js/chat.js') !!} --}}
<script type="text/javascript" src="{{asset('storage/frontend/custom/js/chat.js')}}"></script>
<script type="text/javascript" src="{{asset('storage/frontend/custom/uploader/jquery.growl.js')}}"></script>
<script type="text/javascript" src="{{asset('storage/frontend/custom/uploader/src/fileup.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


<script type="text/javascript">



	$(document).ready(function () {


		$(document).on("click", "#emoji-picker", function (e) {
			e.stopPropagation();
			$('.intercom-composer-emoji-popover').toggleClass("active");
		});

		$(document).click(function (e) {
			if ($(e.target).attr('class') != '.intercom-composer-emoji-popover' && $(e.target).parents(".intercom-composer-emoji-popover").length == 0) {
				$(".intercom-composer-emoji-popover").removeClass("active");
			}
		});

		$(document).on("click", ".intercom-emoji-picker-emoji", function (e) {
			var reviou = $(".test-emoji").val();
			$(".test-emoji").val(reviou + $(this).html());
		});

		$('.intercom-composer-popover-input').on('input', function () {
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

    $(function () {

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {
                $('.file-upload-wrapper').attr('data-text',label);
            });
        });

    });
</script>
<script>
$(document).ready(function() {
    $.fileup({
        url: full_path + 'fileuploadforjob',
        inputID: 'mySendFiles',
        dropzoneID: 'upload-2-dropzone',
        queueID: 'upload-2-queue',
        filesLimit: 5,
        autostart: true,
        onSelect: function(file) {
            $('#multiple .control-button').show();
            setTimeout(() => {
                $('.file-upload-wrapper').attr('data-text', 'Upload Here');
            }, 100);
        },
        onRemove: function(file, total) {
            if (file === '*' || total === 1) {
                $('#multiple .control-button').hide();
            }
        },
        onSuccess: function(response, file_number, file) {
            var result = JSON.parse(response);
            var options = this.fileup.options;
            $('#fileup-' + options.inputID + '-' + file_number).append(
                '<input type="hidden" name="upload_file_names[]" value="' + result.name + '">');
            $.growl.notice({
                title: "Upload success!",
                message: file.name
            });
        },
        onError: function(event, file, file_number, response) {
            var result = JSON.parse(response);
            var message = result.errors.filedata[0];
            var options = this.fileup.options;
            $.growl.error({
                message: message
            });
        }
    });
});
</script>

<script>
    $(document).ready(function(){
        var id = $('#get_message_user_id').val();
        // $('.first-chat').trigger('click');
        
        if(id==''){
            $('.first-chat').trigger('click');
        }else{
            $('.select-chat'+id).trigger('click');
        }
       
       
    });
</script>
@stop
