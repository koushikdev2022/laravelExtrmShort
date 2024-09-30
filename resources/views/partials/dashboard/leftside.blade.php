@php
$name = 'User';
$loginUser = Auth()->guard('frontend')->user();
if (isset($loginUser->name) && $loginUser->name != null)
$name = $loginUser->name;
@endphp
@if(Auth::guard('frontend')->check())

<!-------- Mobile view menu section -------->
<div class="mobile-view">
    <div class="logo-sec">
        <div class="clearfix d-flex">
            <div class="col-xs-6 col-5">
                <a href="{{ URL('/') }}"><img src="{{ URL::asset('public/frontend/dashboard/images/logo_left.png') }}" alt="" class="img-responsive"></a>
            </div>
            <div class="col-xs-6 col-7 text-right">
                <a class="dashWallet mr-1" href="#"> <i class="icofont-wallet"></i> $500.00 USD</a>
                <a href="javascript:void(0);" id="MobilesidebarToggle" class="bgr-mnu menubaerger">
                    <img src="{{ URL::asset('public/frontend/dashboard/images/menu.svg') }}" alt="" class="img-responsive">
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="mobile-menu-link" style="display: none;">
        <ul>
            <li class="{{ (in_array(Route::currentRouteName(), ['dashboard'])) ? 'active' : '' }}"><a href="{{ Route('dashboard') }}"><i class="icofont-dashboard-web"></i>Dashboard</a></li>
            <li class="{{ (in_array(Route::currentRouteName(), ['user.edit.profile'])) ? 'active' : '' }}"><a href="{{ Route('user.edit.profile') }}"><i class="icofont-gear"></i>account settings</a></li>
            <li class="{{ (in_array(Route::currentRouteName(), ['videoListing'])) ? 'active' : '' }}"><a href="{{ Route('videoListing') }}"><i class="icofont-ui-video-play"></i>my uploaded Videos</a></li>
            <li><a href="#"><i class="icofont-ui-video-play"></i>my purchased videos</a></li>
            <li><a href="#"><i class="icofont-users-social"></i>Followers</a></li>
            <li><a href="#"><i class="icofont-star"></i>Following</a></li>
            <li><a href="#"><i class="icofont-money-bag"></i>My Earnings</a></li>
            <li class="{{ (in_array(Route::currentRouteName(), ['logout'])) ? 'active' : '' }}"><a href="{{ Route('logout') }}"><i class="icofont-ui-power"></i>Logout</a></li>
        </ul>
        <div class="top-right-btn">
            <ul class="list-inline header-top pull-right">
                <li>
                    <a href="#" class="icon-info">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        <span class="label label-primary"></span>
                    </a>
                </li>
                <li class="">
                    <div class="dropdown dash-drop">
                        <span data-toggle="dropdown" aria-expanded="false">
                            @if($loginUser->profile_picture != '')
                            <img class="img-responsive rounded-circle headr-prof-pic" src="{{ URL::asset('public/uploads/frontend/profile_picture/thumb/'.$loginUser->profile_picture) }}" alt="">
                            @else
                            <img class="img-responsive rounded-circle headr-prof-pic" src="{{ URL::asset('public/frontend/dashboard/images/user.jpg') }}" alt="">
                            @endif
                            <h1>{{ $name }}<i class="icofont-caret-down"></i></h1>
                        </span>
                        <ul class="dropdown-menu nw-drp">
                            <li><a href="{{ Route('user.profile') }}" data-original-title="" title=""><i class="icofont-gear"></i>&nbsp;Account Settings</a></li>
                            <li><a href="{{ URL('/') }}" data-original-title="" title=""><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-------- End Mobile view menu section -------->
<div class="user-left-side">
    <div class="side-bar-menu">
        <a href="{{ URL('/') }}" class="big-logo"><img src="{{ URL::asset('public/frontend/images/logo.png') }}" class="img-responsive"></a>
        <a href="javascript:void(0);" class="berger" id="sidebarToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="26.855" height="13.913" viewBox="0 0 26.855 13.913">
                <defs>
                    <style>
                        .b {
                            fill: #ffffff;
                        }
                    </style>
                </defs>
                <g transform="translate(0 -3)">
                    <path class="b" d="M7.238,124.886H1.109a1.109,1.109,0,1,1,0-2.218H7.238a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 -113.82)" />
                    <path class="b" d="M25.736,2.218H1.119A1.109,1.109,0,1,1,1.119,0H25.736a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 3)" />
                    <path class="b" d="M16.37,247.55H1.109a1.109,1.109,0,0,1,0-2.218H16.37a1.109,1.109,0,0,1,0,2.218Zm0,0" transform="translate(0 -230.636)" />
                </g>
            </svg>
            <div class="clearfix"></div>
        </a>
    </div>

    <ul class="ck_list">
        <li class="active"><a href="#"><i class="icofont-pencil-alt-2"></i>Upload And Description <i class="fa fa-check-circle checkTick" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="icofont-list"></i>Details <i class="fa fa-check-circle checkTick" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="icofont-dollar"></i>License And Price <i class="fa fa-check-circle checkTick" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="icofont-check"></i>Review <i class="fa fa-check-circle checkTick" aria-hidden="true"></i></a></li>
    </ul>

    <div class="copy-right text-left mt-auto">©{{ date('Y') }} Copyright.</div>
</div>

@endif