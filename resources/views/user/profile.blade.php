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
    <div class="banner-part">
        <figure>
            <video autoplay muted loop>
                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </figure>
    </div>
</section>

<section class="bg-gray pt-0">
    <div class="container">
        <div class="profile-footage-wrapper d-flex flex-wrap">
            <div class="left-cont">
                <div class="profile-card">
                    <div class="name-card">
                        <figure class="profile-pic">
                            @if($data->profile_picture != '')
                            <img src="{{ URL::asset('public/uploads/frontend/profile_picture/thumb/'. $data->profile_picture) }}" alt="image" />
                            @else
                            <img src="{{ URL::asset('public/frontend/images/profile-pic.jpg') }}" alt="image" />
                            @endif
                        </figure>
                        <div class="text">
                            <h4>{{ ucfirst($data->name) }}</h4>
                            <address><i class="icofont-location-pin"></i>{{ $data->country }}</address>

                            @php
                            $user = Auth()->guard('frontend')->user();
                            $following = \App\Models\UserFollower::where(['user_id'=>$user->id,'following_user_id'=>$data->id,'status'=>'1'])->first();
                            @endphp
                            @if($user->id != $data->id)
                            @if($following != '')
                            <a href="javascript:void(0)" class="btn-follow" style="background:blue;" onclick="followUser('{{ $data->id }}')">Following</a>
                            @else
                            <a href="javascript:void(0)" class="btn-follow" onclick="followUser('{{ $data->id }}')">Follow</a>
                            @endif
                            @endif

                            <a href="{{ Route('taxdetails') }}" class="btn-follow">Tax Detail</a>
                        </div>
                    </div>
                    <div class="profile-details">
                        <ul class="member-activity d-flex flex-wrap">
                            <li>
                                <h5><i class="icofont-user-alt-7"></i>Member since</h5>
                                <p>{{ date("D Y", strtotime($data->created_at)) }}</p>
                            </li>
                            <li>
                                <h5><i class="icofont-ui-clip-board"></i>Profile Status</h5>
                                @if($data->user_verifications == '1')
                                <p>Verified</p>
                                @else
                                <p>Not Verified</p>
                                @endif
                            </li>
                        </ul>
                        <div class="profile-about">
                            <h5>About</h5>
                            <p>
                                {{ $data->about_me}}
                            </p>
                        </div>
                        <div class="profile-about">
                            <h5>Topics</h5>
                            <ul class="d-flex flex-wrap">
                                @php
                                $topic = explode(',',$data->topic);

                                @endphp
                                @if($data->topic != '')
                                @forelse($topic as $t)
                                <li><a href="#">{{ $t }}</a></li>
                                @empty
                                @endforelse
                                @endif

                                <!-- <li><a href="#">Drone</a></li>
                                <li><a href="#">Medical</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">War</a></li>
                                <li><a href="#">Politics</a></li>
                                <li><a href="#">Social</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Science</a></li>
                                <li><a href="#">Sport</a></li>
                                <li><a href="#">Entertainment</a></li>
                                <li><a href="#">Celebration</a></li>
                                <li><a href="#">Matches</a></li>
                                <li><a href="#">Religion</a></li>
                                <li><a href="#">Education</a></li>
                                <li><a href="#">Security</a></li>
                                <li><a href="#">Culture</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-cont">
                <div class="right-filters footage-sort">
                    <div class="total-footage">
                        <h3 id="getTotalCount"></h3>
                        <div class="sort-by d-flex align-items-center flex-wrap">
                            <span>Sort: </span>
                            <label>
                                <select  id="filterIndexData">
                                    <option value="Newest">Newest first</option>
                                    <option value="Oldest">Oldest first</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="listType" >
                    <div class="cardView">
                    </div>
                </div>
                <!-- <div class="video-list-wrapper">
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
                </div> -->
                <!-- <div class="loader">
                    <img src="{{ URL::asset('public/frontend/images/loader.png') }}" alt="loader" />
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
    var data = {!!json_encode($data) !!};
    var id = data.id;

    $(document).ready(function(){
        $("#filterIndexData").on("change", function() {
            var item = "created_at";
            var type = $("#filterIndexData").val();
            sortByCategory(item, type);
        });
    });

    function sortByCategory(item, type) {
        ajaxindicatorstart();
        $.ajax({
            url: full_path + "searchMyVideos",
            data: {
                item: item,
                type: type,
            },
            success: function(result) {
                console.log(result);
                $(".cardView").html("");
                $(".cardView").append(result.content);
            
                $("#getTotalCount").html("");
                $("#getTotalCount").append(result.TotalCount + " Video Footage");
                ajaxindicatorstop();
            },
            error: function(result) {
                alert("Some Error");
                ajaxindicatorstop();
            },
        });
    }
</script>
@stop