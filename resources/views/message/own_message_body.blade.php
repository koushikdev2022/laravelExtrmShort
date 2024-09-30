

<div class="receive message-content-part mb-3" data-id="{{$message->id}}">
    <div class="d-block text-right">
        <div class="msg_cotainer_send disp_in_block">
            @if($message->message_type==='4')
            <img src="{{asset('public/uploads/frontend/messages/'.$message->file_name)}}" height="200" onerror="this.onerror=null;this.src='{{DEFAULT_IMG}}';" alt="Image" />
            @elseif($message->message_type==='2')
            <div class="wrapper">
                <div class="videocontent">
                    <video  class="myvideo2" style="width:100%;height:100%;" width="640px" height="352px" controls="controls" preload="metadata" >
                        <source src="{{asset('public/uploads/frontend/messages/'.$message->file_name)}}" />
                    </video>
                </div>
            </div>
            @elseif($message->message_type==='3')
            {!!$message->message!!}
            @endif
            <span class="msg_time">{{\Carbon\Carbon::parse($message->created_at)->format('h:i A ,M d, Y')}}</span>
        </div>
    </div>
</div>