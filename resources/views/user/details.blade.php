@extends('layouts.master')
@section('content')
<section class="public-profile-page-section">
    <div class="container">
        <div class="search-holder">
            <form class="search-form" action="{{ Route('listing') }}">
                <input type="search" name="search" placeholder="What are you looking for" />
                <input type="submit" value="search" />
            </form>
        </div>
    </div>
</section>

<section class="video-listing-page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="backBtn" href="{{ Route('listing') }}"><i class="icofont-simple-left"></i> Return to search</a>
            </div>
            @if( $data != '')
            <div class="col-md-8">
                <div class="mainVideo">
                    <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo"></figure>
                    <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$data->image) }}" width="100%" height="auto" controls controlsList="nodownload">
                        @if($data->video_extension == 'mp4')
                        <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$data->video) }}" type="video/mp4">
                        @elseif($data->video_extension == 'mov')
                        <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$data->video) }}" type="video/mov">
                        @endif
                        Your browser does not support HTML video.
                    </video>
                    @if( $data->is_exclusive == '1')
                        <span class="videoextab">Exclusive</span>
                    @endif
                </div>

                <div class="videoProfile">
                    <div class="vp_header">
                        <div class="vp_header_row">
                            <div class="vp_profile">
                                @if(!empty($user))
                                @if($data->user->profile_picture != '')
                                <div><img src="{{ URL::asset('public/uploads/frontend/profile_picture/thumb/'. $data->user->profile_picture) }}" alt="image" /></div>
                                @else
                                <div><img src="{{ URL::asset('public/frontend/images/profile-placeholder.png') }}" alt=""></div>
                                @endif
                                <div>
                                    <h4>By: <span>{{ ucfirst($data->user->name) }}</span></h4>
                                </div>
                                @endif
                            </div>
                            <div>
                                @if(!empty($user))
                                @php
                                $following = \App\Models\UserFollower::where(['user_id'=>$user->id,'following_user_id'=>$data->user->id,'status'=>'1'])->first();
                                @endphp
                               
                                @if($following != '')
                                <a href="javascript:void(0)" class="btn-follow" style="background:blue;" onclick="followUser('{{ $data->user->id }}')">Following</a>
                                @else
                                <a href="javascript:void(0)" class="btn-follow" onclick="followUser('{{ $data->user->id }}')">Follow</a>
                                @endif
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="vp_body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="vp_list">
                                    <p>Footage ID:</p>
                                    <p>#{{ $data->footage_code}}</p>
                                </div>
                                <div class="vp_list">
                                    <p>Collection:</p>
                                    @php
                                    $playlist = \App\Models\Playlist::where(['id'=>$data->playlist_id])->first();
                                    @endphp
                                    <p>@if($data->playlist_id != '' && $data->playlist_id != '0'){{ ucfirst($playlist->name) }} @endif</p>
                                </div>
                                <div class="vp_list">
                                    <p>Location:</p>
                                    <p>{{ $data->location }}</p>
                                </div>
                                <div class="vp_list">
                                    <p>Mastered to:</p>
                                    <p>QuickTime 10-bit ProRes 422 (HQ) 4K 4096x2160 25p</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vp_list">
                                    @php
                                    $lang = session()->get('locale');
                                    $category = \App\Models\TranslationCategory::where(['category_id'=>$data->category])->where('lang_code', '=', $lang)->first();
                                    @endphp

                                    <p>Category:</p>
                                    <p>@if($data->category != ''){{ ucfirst($category->category_name) }} @endif</p>
                                </div>
                                <div class="vp_list">
                                    <p>Licence type:</p>
                                    <p>Rights-ready</p>
                                </div>
                                <div class="vp_list">
                                    <p>Clip length:</p>
                                    <p>{{ $data->duration}}</p>
                                </div>
                                <div class="vp_list">
                                    <p>Release info:</p>
                                    <p>Model and property released</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4 class="vd_title">{{ \Illuminate\Support\Str::limit(ucfirst($data->title),150) }}</h4>
                <div class="likeArea">
                    <div class="d-flex align-items-center">

                        @if($data->likes != '')
                        @if($data->likes->like_status == '1')
                        <a class="likebtn active" data-bs-toggle="tooltip" data-bs-placement="top" title="Like" href="javascript:void(0)"><i class="icofont-heart" onclick="likeProject( {{$data->id}} )"></i></a>

                        @elseif($data->likes->like_status == '0')
                        <a class="likebtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Like" href="javascript:void(0)"><i class="icofont-heart" onclick="likeProject( {{$data->id}} )"></i></a>
                        @endif
                        @else
                        <a class="likebtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Like" href="javascript:void(0)"><i class="icofont-heart" onclick="likeProject( {{$data->id}} )"></i></a>
                        @endif

                        @php

                        $user = Auth()->guard('frontend')->user();
                        if(!empty($user)){
                            $likes = \App\Models\UserLikes::where(['user_id'=>$user->id,'like_status'=>'1'])->get();
                        }else {
                            $likes=[];
                        }
                        @endphp
                        <span class="liveValue">{{ count($likes) }}</span>
                    </div>
                    <div class="d-flex">

                        @if($data->bookmark != '')
                        @if($data->bookmark->like_status == '1')
                        <a class="likebtn active" data-bs-toggle="tooltip" data-bs-placement="top" title="Bookmark" href="javascript:void(0)"><i class="icofont-book-mark" onclick="saveProject( {{$data->id}} )"></i></a>

                        @elseif($data->bookmark->like_status == '0')
                        <a class="likebtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Bookmark" href="javascript:void(0)"><i class="icofont-book-mark" onclick="saveProject( {{$data->id}} )"></i></a>
                        @endif
                        @else
                        <a class="likebtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Bookmark" href="javascript:void(0)"><i class="icofont-book-mark" onclick="saveProject( {{$data->id}} )"></i></a>
                        @endif

                    </div>
                    <div class="d-flex">
                        <a class="likebtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Report" href="javascript:void(0)" onclick="reportProject({{$data->id}})"><i class="icofont-flag"></i></a>
                    </div>
                </div>
                <label class="vd_lable">Choose a size</label>

                <div class="vdo-q">
                    @if(count($data->info) > 0)
                        @forelse($data->info as $i)
                        <div class="vdo-i">
                            <div class="form-check new-check">
                                <input class="form-check-input" type="radio" name="quality" value="{{ $i->id }}"  id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <span class="vd_qa">@if($i->quality == '1') HD @else 4K @endif</span> ${{ $i->total }} <span class="vd_details">@if($i->quality == '1') 1920 x 1080 / mov / 219.9MB / H.264 @else 3840 x 2160 / mov / 598.9MB / PRORES 422 @endif</span>
                                </label>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    @endif
                </div>
                <label class="vd_lable">License <i class="icofont-info-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom"></i></label>
                <div class="vd_standard new-check">
                    <input class="form-check-input" type="radio" name="licence" value="add_licence" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Standard
                    </label>
                    <p>Rental period: 12 Months</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Etiam venenatis rutrum dolor</p>
                    <p class="vd_inc">Included</p>
                </div>

                <div class="vd_btnArea">
                    @if(!empty($user))
                    <a href="javascript:void(0)" onclick="purchaseVideo( '{{ $data->id }}' )" class="vd_btn vd_btn1">Purchase the video</a>
                    <a href="javascript:void(0)" class="vd_btn vd_btn2" onclick="upgradeLicence('{{ $data->id }}')">Upgrade license as your needs</a>
                    <a target="_blank" class="vd_btn vd_btn3" href="{{ Route('download','video.mp4') }}">download watermark sample</a>
                    @else
                    <a href="{{ Route('login') }}" class="vd_btn vd_btn1">Purchase the video</a>
                    <a href="{{ Route('login') }}" class="vd_btn vd_btn2">Upgrade license as your needs</a>
                    <a target="_blank" class="vd_btn vd_btn3" href="{{ Route('download','video.mp4') }}">download watermark sample</a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<section class="tabSection">

    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs vd_tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home">Related Results</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu1"> More From This Filmmaker</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="tab-pane active"><br>
                @if(count($similar_data) > 0)
                <div class="video-list-wrapper video-list-four">
                    @forelse($similar_data as $similar)
                    <div class="video-holder" onclick="Details({{ $similar->id }})">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" />
                            </figure>

                            <a href="javascript:void(0)" class="video-link">
                                <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$similar->image) }}" muted>
                                    <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$similar->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                @php
                                $lang = session()->get('locale');
                                $category = \App\Models\TranslationCategory::where(['category_id'=>$similar->category])->where('lang_code', '=', $lang)->first();
                                @endphp
                                <span>@if($similar->category != '') {{ ucfirst($category->category_name) }} @endif</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.60</span>
                                <span> @if(count($similar->info) > 0)
                                    @forelse($similar->info as $i)
                                    quality @if($i->quality == '1') HD <br>@else 4K <br> @endif
                                    @empty
                                    @endforelse
                                    @endif
                                </span>
                            </div>
                            <div class="likebookmark tppenw">

                                @if($similar->bookmark != '')
                                @if($similar->bookmark->like_status == '1')
                                <a href="javascript:void(0)" class="iconancher active"><i class="icofont-book-mark" onclick="saveProject( {{$similar->id}} )"></i></a>
                                @elseif($similar->bookmark->like_status == '0')
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark" onclick="saveProject( {{$similar->id}} )"></i></a>
                                @endif
                                @else
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark" onclick="saveProject( {{$similar->id}} )"></i></a>
                                @endif

                                @if($similar->likes != '')
                                @if($similar->likes->like_status == '1')
                                <a href="javascript:void(0)" class="iconancher active"><i class="icofont-heart" onclick="likeProject( {{$similar->id}} )"></i></a>
                                @elseif($similar->likes->like_status == '0')
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart" onclick="likeProject( {{$similar->id}} )"></i></a>
                                @endif
                                @else
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart" onclick="likeProject( {{$similar->id}} )"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                @else
                <div class="alert alert-danger" role="alert">
                    Nothing Found
                </div>
                @endif


                <!-- <div class="video-list-wrapper video-list-four">
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg1.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Technology</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg2.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Political</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg3.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>political</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg4.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Sports</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg5.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Sports</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg6.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>War</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg7.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>War</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg8.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Sports</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg9.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Entertainment</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg10.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Trending</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg11.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Science</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg12.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Entertainment</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg13.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>War</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg14.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Sports</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg15.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Political</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg16.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>War</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg17.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Technology</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg18.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>political</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="loader">
                    <img class="icn-spinner" src="{{ URL::asset('public/frontend/images/loader.png') }}" alt="loader" />
                </div> -->
            </div>
            <div id="menu1" class="tab-pane fade"><br>
                @if(count($maker_data) > 0)
                <div class="video-list-wrapper video-list-four">
                    @forelse($maker_data as $maker)
                    <div class="video-holder" onclick="Details({{ $maker->id }})">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" />
                            </figure>

                            <a href="javascript:void(0)" class="video-link">
                                <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$maker->image) }}" muted>
                                    <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$maker->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                @php
                                $lang = session()->get('locale');
                                $category = \App\Models\TranslationCategory::where(['category_id'=>$maker->category])->where('lang_code', '=', $lang)->first();
                                @endphp
                                <span>@if($maker->category != '') {{ ucfirst($category->category_name) }} @endif</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.60</span>
                                <span> @if(count($maker->info) > 0)
                                    @forelse($maker->info as $i)
                                    quality @if($i->quality == '1') HD <br>@else 4K <br> @endif
                                    @empty
                                    @endforelse
                                    @endif
                                </span>
                            </div>
                            <div class="likebookmark tppenw">

                                @if($maker->bookmark != '')
                                @if($maker->bookmark->like_status == '1')
                                <a href="javascript:void(0)" class="iconancher active"><i class="icofont-book-mark" onclick="saveProject( {{$maker->id}} )"></i></a>
                                @elseif($maker->bookmark->like_status == '0')
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark" onclick="saveProject( {{$maker->id}} )"></i></a>
                                @endif
                                @else
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark" onclick="saveProject( {{$maker->id}} )"></i></a>
                                @endif

                                @if($maker->likes != '')
                                @if($maker->likes->like_status == '1')
                                <a href="javascript:void(0)" class="iconancher active"><i class="icofont-heart" onclick="likeProject( {{$maker->id}} )"></i></a>
                                @elseif($maker->likes->like_status == '0')
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart" onclick="likeProject( {{$maker->id}} )"></i></a>
                                @endif
                                @else
                                <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart" onclick="likeProject( {{$maker->id}} )"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                @else
                <div class="alert alert-danger" role="alert">
                    Nothing Found
                </div>
                @endif
                <!-- <div class="video-list-wrapper video-list-four">
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg1.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Technology</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                    <div class="video-holder">
                        <div class="video-box">
                            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                            <a href="#" class="video-link">
                                <video poster="{{ URL::asset('public/frontend/images/ftg2.png') }}" muted>
                                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span>Political</span>
                            </a>
                            <div class="video-box-footer">
                                <span><i class="icofont-clock-time"></i>00.30</span>
                                <span>quality 4k</span>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<!--NEED ASSISTANCE SECTION START-->
<section class="need-assistance-section">
    <div class="container">
        <div class="left-part">
            <h3><strong>Need Assistance?</strong> Your wish is our command.</h3>
            <a href="{{ Route('contact-us')}}">request a call back</a>
        </div>
    </div>
</section>
<!--NEED ASSISTANCE SECTION END-->
@stop
@section('js')
<script>
    function upgradeLicence(id){
        $.ajax({
        url: full_path + "upgradeLicence/" + id,
        success: function(response) {
            ajaxindicatorstop();
            purchaseVideo(id);

        },error:function(err){
            notie.alert({
                type: "error",
                text: '<i class="fa fa-times"></i>' + err.responseJSON.message,
                time: 6,
            });
        }
    });
    }
</script>
@stop