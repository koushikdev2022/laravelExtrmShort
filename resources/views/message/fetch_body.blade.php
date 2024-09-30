<?php
$my_id = Auth()->guard('frontend')->user()->id;
$last_point_day = strtotime(date('Y-m-d'));
$imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];



?>

@forelse($messages as $message)

@php
$loop_msg_day=strtotime(date('Y-m-d',strtotime($message->created_at)));
$files='';
if($message->message_type==='5' && !empty($message->file_name)){
$all_files=explode(',',$message->file_name);
foreach($all_files as $all_file){
$explodeImage = explode('.', $all_file);
$extension = end($explodeImage);
if(in_array($extension, $imageExtensions)){
$files.='<img src="'.asset('storage/uploads/frontend/messages/'.$all_file).'" alt="'.$all_file.'" />';
}
$files.='<a href="'.asset('storage/uploads/frontend/messages/'.$all_file).'" target="_blank"
    download="'.$all_file.'">'.$all_file.' <i class="icofont-download"></i></a>';

}
}
@endphp

@if ($loop_msg_day!=$last_point_day)

@php
$last_point_day=$loop_msg_day;
@endphp

<li class="extra">
    <p class="text-center text-primary mb-0 m-head">
        @if ($message->created_at->isToday())
        Today
        @elseif ($message->created_at->isYesterday())
        Yesterday
        @else
        {{$message->created_at->format('l,F d, Y')}}
        @endif

    </p>
    <hr class="mb-0 m-bor">
</li>

<div class="">
    <p class="m-blank"></p>
</div>
@endif

@if($message->to_user_id==$my_id)

@php
$type_id=$message->from->type_id??'';
$image=$message->from->profile_picture??'';

@endphp

<li class="sent message-content-part" data-id="{{$message->id}}" data-as='from'>
    <img src="{{asset('storage/uploads/frontend/profile_picture/thumb/'.$image)}}"
        onerror="this.onerror=null;this.src='{{asset("storage/frontend/assets/images/profile_user.png")}}';" alt="" />
    @if ($message->message_type==='5')
    <p class="wrapper filemessage">
        @if(!empty($message->message))
        {!!$message->message!!}
        @endif
        {!! $files !!}
    </p>
    @elseif($message->message_type==='4')
    <p class="wrapper filemessage">
        @if(!empty($message->message))
        {!!$message->message!!}
        @endif
        <img src="{{asset('storage/uploads/frontend/messages/'.$message->file_name)}}" alt="{{$message->message}}" />
        <a href="{{asset('storage/uploads/frontend/messages/'.$message->file_name)}}" target="_blank"
            download="{{$message->message}}">{{$message->message}} <i class="icofont-download"></i></a>
    </p>
    @else
    <p> {!!$message->message!!}</p>
    @endif
    <span class="msg_time">{{\Carbon\Carbon::parse($message->created_at)->format('h:i A ,M d, Y')}}</span>
</li>
@else

@php
if($message->from_user_id==$my_id){
$type_id=$message->from->type_id??'';
$image=$message->from->profile_picture??'';
}else{
$type_id=$message->to->type_id??'';
$image=$message->to->profile_picture??'';
}
@endphp
<li class="replies message-content-part" data-id="{{$message->id}}" data-as='from'>
    <img src="{{asset('storage/uploads/frontend/profile_picture/thumb/'.$image)}}"
        onerror="this.onerror=null;this.src='{{asset("storage/frontend/assets/images/profile_user.png")}}';" alt="" />
    @if ($message->message_type==='5')
    <p class="wrapper filemessage">
        @if(!empty($message->message))
        {!!$message->message!!}
        @endif
        {!! $files !!}
    </p>
    @elseif($message->message_type==='4')
    <p class="wrapper filemessage">
        @if(!empty($message->message))
        {!!$message->message!!}
        @endif
        <img src="{{asset('storage/uploads/frontend/messages/'.$message->file_name)}}" alt="{{$message->message}}" />
        <a href="{{asset('storage/uploads/frontend/messages/'.$message->file_name)}}" target="_blank"
            download="{{$message->message}}">{{$message->message}} <i class="icofont-download"></i></a>
    </p>
    @else
    <p> {!!$message->message!!}</p>
    @endif
    <span class="msg_time">{{\Carbon\Carbon::parse($message->created_at)->format('h:i A ,M d, Y')}}</span>
</li>

@endif

@empty

@endforelse