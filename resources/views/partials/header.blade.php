@php
$name = 'User';
$loginUser = Auth()->guard('frontend')->user();
if (isset($loginUser->name) && $loginUser->name != null) {
$name = $loginUser->name;
}
@endphp
<header class="site-header">
    <div class="header-top">
        <div class="container">
            <div class="top-menu-wrapper">
                <h1 class="logo">
                    @php
                    $logo = \App\Models\Settings::where(['slug' => 'website_logo'])->first();
                    @endphp
                    <a href="{{ URL('/') }}" title="{{ config('app.name') }}">
                        <img src="{{ URL::asset('public/uploads/frontend/logo/'.$logo->value) }}" alt="logo" />
                    </a>
                </h1>
                <ul class="top-menu-list">
                    <li><a href="{{ Route('about-us') }}">About US</a></li>
                    <li><a href="{{ Route('contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ Route('how_it_works') }}">How It Works</a></li>
                    <li><a href="{{ Route('blog')}}">Blog</a></li>
                </ul>
                <a class="mobile-menu-trigger" data-bs-toggle="offcanvas" href="#offcanvasExample"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-bottom-wrapper">
                <ul class="left-menu">
                    <!-- <li class="has-submenu">
                        <a href="#">Footage</a>
                        <ul class="sub-menu">
                            <li><a href="{{ Route('listing') }}">Footage 1</a></li>
                            <li><a href="{{ Route('listing') }}">Footage 2</a></li>
                            <li><a href="{{ Route('listing') }}">Footage 3</a></li>
                        </ul>
                    </li> -->
                    {{-- {{ $categories }} --}}
                    <li class="has-submenu">
                        <a href="#">Categories</a>
                        <ul class="sub-menu">
                            @if (isset($categories[0]))
                            @foreach ($categories as $cat)
                            <li><a href="{{ Route('listing') }}">{{ $cat->category_name }}</a></li>
                            @endforeach
                            @else
                            <li><a href="#">No Category Found</a></li>
                            @endif
                        </ul>
                    </li>
                    <li><a href="{{ Route('priceChart') }}">Prices</a></li>
                </ul>
                <ul class="right-menu">
                    @if (Auth::guard('frontend')->check())
                    <a href="javascript:void(0)" class="addstory" onclick="uploadStory()">
                        <span class="imageframe">
                            <img src="{{ URL::asset('public/frontend/images/ftg17.png') }}" alt="icon" />
                            <span class="plsicon">
                                <i class="icofont-plus-circle"></i>
                            </span>
                        </span>
                        <p class="yourstory">Your Story</p>
                    </a>
                    @endif

                    @if (!Auth::guard('frontend')->check())
                    <li class="login"><a href="{{ Route('login') }}">log in</a></li>
                    <li class="signup"><a href="{{ Route('signup') }}">sign up</a></li>
                    @elseif(Auth::guard('frontend')->check())
                    <!-- <li class="notification active">
                        <a href="javascript:void(0)"><img src="{{ URL::asset('public/frontend/images/notification.png') }}" alt="icon" /></a>
                    </li> -->
                    @php
                    $notification = \App\Models\Notification::where(['is_view'=>'0','notifier_id'=>$loginUser->id])->orderBy('id','desc')->get();
                    $count = count($notification);
                    @endphp
                    <li class="notification {{ ($count != '0')  ? 'active' : ''}} nav-item dropdown noti_drop">
                        <a class=" nav_noti" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ URL::asset('public/frontend/images/notification.png') }}" alt="icon" />
                        </a>

                        <ul class="dropdown-menu noti_droplist dropdown-menu-end" aria-labelledby="navbarDropdown">
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


                    <li class="has-submenu">
                        @if($loginUser->profile_picture != '')
                        <a href="javascript:void(0)" class="loginaftbximt"><img src="{{ URL::asset('public/uploads/frontend/profile_picture/thumb/'.$loginUser->profile_picture) }}" alt="icon" class="img-responsive rounded-circle headr-prof-pic" /></a>
                        @else
                        <a href="javascript:void(0)" class="loginaftbximt"><img src="{{ URL::asset('public/frontend/images/default-avter.png') }}" alt="icon" /></a>
                        @endif
                        <ul class="sub-menu">
                            <li><a href="{{ Route('user.edit.profile') }}">My Account</a></li>
                            <li><a href="{{ Route('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ Route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="upload">
                        <a href="{{ Route('project-create') }}"><i class="icofont-upload-alt"></i>upload</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Story Upload Modal -->
<div class="modal cuustomfont fade" id="storyUploaderModal" tabindex="-1" role="dialog" aria-labelledby="storyUploaderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="storyUploaderModalLabel">Upload Reel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadStoryRequest" enctype="multipart/form-data" action="{{ Route('uploadStory') }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp">
                    </div> -->
                    <div class="form-group uploadfield">
                        <label for="exampleInputEmail1">Upload Image</label>
                        <input type="file" name="image" class="file" accept=".png, .jpg, .jpeg">
                        <div class="input-group">
                            <input type="text" class="form-control" disabled placeholder="" aria-label="Upload File" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                                <button type="button" class="browse input-group-text btn btn-primary" id="basic-addon2"><i class="icofont-upload-alt"></i> Upload Here</button>
                            </div>
                        </div>
                        <div class="text-danger help-block"></div>
                    </div>
                    <div class="form-group uploadfield">
                        <label for="exampleInputEmail1">Upload Video</label>
                        <input type="file" name="video" class="file" accept=".mp4, .mkv, .mov">
                        <div class="input-group">
                            <input type="text" class="form-control" disabled placeholder="" aria-label="Upload File" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                                <button type="button" class="browse input-group-text btn btn-primary" id="basic-addon2"><i class="icofont-upload-alt"></i> Upload Here</button>
                            </div>
                        </div>
                        <div class="text-danger help-block"></div>
                        <p class="text-muted m-0 mt-2">Video must be under 60 seconds</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn cmnbtnnw">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>