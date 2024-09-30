@php
$name = 'User';
$loginUser = Auth()->guard('frontend')->user();
if (isset($loginUser->name) && $loginUser->name != null)
$name = $loginUser->name;
@endphp
@if(Auth::guard('frontend')->check())
<div class="user-top-head">
    <div class="top-right-btn">
        <ul class="list-inline header-top pull-right">
            <!-- <li>
                <a href="#" class="icon-info">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="label label-primary"></span>
                </a>
            </li> -->
            @php
            $notification = \App\Models\Notification::where(['is_view'=>'0','notifier_id'=>$loginUser->id])->orderBy('id','desc')->get();
            $count = count($notification);
            @endphp
            <li class="notification {{ ($count != '0')  ? 'active' : ''}}  dropdown noti_drop">
                <a class="nav_noti icon-info" href="javascript:void(0)" id="navbarDropdown" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="{{ ($count != '0')  ? 'label label-primary' : ''}}"></span>
                </a>
                <ul class="dropdown-menu noti_droplist dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if(count($notification) > 0)
                    @foreach($notification as $notify)
                    <li>
                        <a class="noti-item" href="javascript:void(0);" onclick="changeNotificationStatus('{{$notify->id}}')">
                            <div class="me-3"><img src="https://procurein.newtestserver.com/frontend/images/notification.png" alt="icon" /></div>
                            <div>
                                <p class="noti_text">{{ $notify->message }}</p>
                                <p class="noti_time">{{ date('M n, Y', strtotime($notify->created_at)) }} | {{ date('h:i A', strtotime($notify->created_at)) }}</p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @else
                    <li>
                        <a class="noti-item" href="javascript:void(0);">
                            <div>

                                <p class="noti_text">You have No Notifications</p>
                            </div>
                        </a>
                    </li>
                    @endif
                    <!-- <li>
                        <a class="noti-item" href="javascript:void(0);">
                            <div class="me-3"><img src="https://procurein.newtestserver.com/frontend/images/notification.png" alt="icon" /></div>
                            <div>
                                <p class="noti_text">Admin Replied to your message Harry Jones</p>
                                <p class="noti_time">Nov 11, 2022 | 08:03 AM</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="noti-item" href="#">
                            <div class="me-3"><img src="https://procurein.newtestserver.com/frontend/images/notification.png" alt="icon" /></div>
                            <div>
                                <p class="noti_text">A connect with Minhas Asif</p>
                                <p class="noti_time">Oct 26, 2022 | 04:00PM</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="noti-item" href="#">
                            <div class="me-3"><img src="https://procurein.newtestserver.com/frontend/images/notification.png" alt="icon" /></div>
                            <div>
                                <p class="noti_text">A connect with Minhas Asif</p>
                                <p class="noti_time">Oct 26, 2022 | 04:00PM</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="noti-item" href="#">
                            <div class="me-3"><img src="https://procurein.newtestserver.com/frontend/images/notification.png" alt="icon" /></div>
                            <div>
                                <p class="noti_text">A connect with Minhas Asif</p>
                                <p class="noti_time">Oct 26, 2022 | 04:00PM</p>
                            </div>
                        </a>
                    </li> -->

                </ul>
            </li>
            <li>
                @php

                $received_amount = \App\Models\EscrowWallet::where(['user_id'=>$loginUser->id,'status'=>'0'])->sum('amount');
                $withdrawal_amount = \App\Models\EscrowWallet::where(['user_id'=>$loginUser->id,'status'=>'1'])->sum('amount');
                $hold_amount = \App\Models\EscrowWallet::where(['user_id'=>$loginUser->id,'status'=>'2'])->sum('amount');
                $amount = $received_amount - $withdrawal_amount - $hold_amount;
                @endphp
                <a class="dashWallet" href="{{ Route('earning') }}"> <i class="icofont-wallet"></i> ${{ $amount }} USD</a>
            </li>
            <li class="">
                <div class="dropdown dash-drop">
                    <span data-toggle="dropdown" aria-expanded="false">
                        @if($loginUser->profile_picture != '')
                        <img class="rounded-circle headr-prof-pic" src="{{ URL::asset('public/uploads/frontend/profile_picture/thumb/'.$loginUser->profile_picture) }}" alt="">
                        @else
                        <img class="rounded-circle headr-prof-pic" src="{{ URL::asset('public/frontend/dashboard/images/user.jpg') }}" alt="">
                        @endif
                        <h1>{{ ucfirst($name) }}<i class="icofont-rounded-down"></i></h1>
                    </span>
                    <ul class="dropdown-menu nw-drp">
                        <li><a href="{{ Route('user.viewprofile',base64_encode($loginUser->id)) }}" data-original-title="" title=""><i class="icofont-user"></i>&nbsp;View Profile</a></li>
                        <li><a href="{{ Route('user.edit.profile') }}" data-original-title="" title=""><i class="icofont-gear"></i>&nbsp;Account Settings</a></li>
                        <li><a href="{{ Route('logout') }}" data-original-title="" title=""><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Logout</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endif