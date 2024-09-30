@extends('layouts.master')
@section('content')
<section class="video-listing-page-section">
    <div class="container">
        <div class="marketplace-wrapper">
            <div class="left-filter">
                <h3><img src="{{ URL::asset('public/frontend/images/filter-icon.png') }}" alt="icon" />Filters</h3>
                <div class="filter-box">
                    <h4>SORT BY</h4>
                    <ul>
                        <li>
                            <input type="radio" id="status1" name="status" onclick="getPopular('created_at', 'BestMatch')" />
                            <label class="radio-lbl" for="status1">Best match</label>
                        </li>
                        <li>
                            <input type="radio" id="status2" name="status" onclick="getPopular('created_at', 'Newest')" />
                            <label class="radio-lbl" for="status2">Newest</label>
                        </li>
                        <li>
                            <input type="radio" id="status3" name="status" onclick="getPopular('created_at', 'Oldest')" />
                            <label class="radio-lbl" for="status3">Oldest</label>
                        </li>
                        <li>
                            <input type="radio" id="status4" name="status" onclick="getPopular('created_at', 'MostPopular')" checked />
                            <label class="radio-lbl" for="status4">Most popular</label>
                        </li>
                    </ul>
                </div>
                <div class="filter-box filter-closed">
                    <h4>Category</h4>
                    <ul>
                        <li>
                            <!-- <input type="checkbox" id="Category" onclick="categorySearch('category', 'all')" />
                            <label class="check-lbl" for="Category">All</label> -->
                            <input type="checkbox" id="CategoryAll" onclick="toggleAllCategories(this)" />
                            <label class="check-lbl" for="CategoryAll">All</label>
                            
                        </li>
                        @if (isset($categories[0]))
                        @foreach ($categories as $key => $cat)
                        <!-- <li>
                            <input type="checkbox" id="Category{{ $key }}" onclick="categorySearch('category','{{ $cat->category_id }}' )" />
                            <label class="check-lbl" for="Category{{ $key }}">{{ $cat->category_name }}</label>
                        </li> -->
                        <li>
                                        <input type="checkbox" class="category-checkbox" id="Category{{ $key }}" value="{{ $cat->category_id }}" onclick="categorySearch()" />
                                        <label class="check-lbl" for="Category{{ $key }}">{{ $cat->category_name }}</label>
                                    </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="filter-box filter-closed">
                    <h4>DATE RANGE</h4>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select a category</label>
                        <select class="my-select selectpicker" data-container="body" id="dateSelections">
                            <option value="">Any date</option>
                            <option value="24">Last 24 hours</option>
                            <option value="48">Last 48 hours</option>
                            <option value="7">Last 7 days</option>
                        </select>
                    </div>
                </div>
                <div class="filter-box filter-closed">
                    <h4>DURATION</h4>

                    <div class="mt-4">
                        <div id="slider-range" class="mt-1 ms-2 me-2" onkeypress="getDuration(this.value)"></div>
                        <div class="d-flex justify-content-between mt-2">
                            <input class="readInput" id="amount" value="0" readonly>
                            <input class="readInput text-end" id="amount2" value="60+" readonly>
                        </div>
                    </div>
                </div>


                <!-- <div class="filter-box filter-closed">
                    <h4>Composition</h4>
                    <ul>
                        <li>
                            <input type="checkbox" id="landscape" onclick="compositionSearch('orientation', 'landscape')" />
                            <label class="check-lbl" for="landscape">Landscape</label>
                        </li>
                        <li>
                            <input type="checkbox" id="portrait" onclick="compositionSearch('orientation', 'portrait')" />
                            <label class="check-lbl" for="portrait">Portrait</label>
                        </li>
                    </ul>
                </div>
                <div class="filter-box filter-closed">
                    <h4>FORMATS</h4>
                    <div class="mt-4">
                        <div class="ans_checkbox">
                            <input type="checkbox" name="rGroup" value="MP4" id="r1" onclick="formatSearch('formats','MP4' )">
                            <label class="checkbox-alias" for="r1">MP4</label>
                            <input type="checkbox" name="rGroup" value="MOV" id="r2" onclick="formatSearch('formats','MOV' )">
                            <label class="checkbox-alias" for="r2">MOV</label>
                            <input type="checkbox" name="rGroup" value="MKV" id="r3" onclick="formatSearch('formats','MKV' )">
                            <label class="checkbox-alias" for="r3">MKV</label>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="right-cont">

                <ul class="nav nav-tabs newtab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="icofont-video-clapper"></i>Editorial</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="icofont-ui-video-play"></i>Scenes</button>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="right-filters">
                            <form class="search-form" action="">
                                <input type="search" placeholder="What are you looking for" name="search" value="@if (isset($_GET['search'])) {{ $_GET['search'] }} @endif" id="searchKeyword" class="typeahead" />
                                <input type="submit" value="search" />
                            </form>
                            <div class="total-footage">
                                <h3 id="getTotalCount">0 Video Footage</h3>
                                <ul class="list-grid-view">
                                    <li>View As: </li>
                                    <li><a href="javascript:void(0)" id="Grid" onclick="getActiveTab(event,'grid')" class="link link_Grid"><i class="icofont-navigation-menu"></i></a></li>
                                    <li><a href="javascript:void(0)" id="Card" onclick="getActiveTab(event,'card')" class="link link_Card active"><img src="{{ URL::asset('public/frontend/images/grid-icon.png') }}" alt="icon" /></a></li>
                                </ul>
                            </div>
                            <ul class="filter-cat">
                                <li><a href="#">City</a></li>
                                <li><a href="#">Sport</a></li>
                                <li><a href="#">Tourism</a></li>
                                <li><a href="#">War</a></li>
                                <li><a href="#">Cars</a></li>
                                <li><a href="#">Celebration</a></li>
                                <li><a href="#">Coronavirus</a></li>
                                <li><a href="#">Funs</a></li>
                            </ul>
                        </div>
                        <div class="listType" id="card">
                            <div id="cardView">
                            </div>
                        </div>

                        <div class="listType" id="grid" style="display:none;">
                            <div id="gridView">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @if(Auth::guard('frontend')->check())
                        <!-- @php
                        $user = Auth()->guard('frontend')->user();
                        $stories = \App\Models\UserStory::where(['user_id' => $user->id,'status'=>'1'])->get();
                        @endphp -->
                        @php
                                $user = Auth()->guard('frontend')->user();
                                $stories = \App\Models\UserStory::where([
                            'user_id' => $user->id,
                            'status' => '1'
                        ])->where('video', '!=', '')->get();                     
                        @endphp
                        @if(count($stories) > 0)
                        <div class="video-list-wrapper">
                            @forelse($stories as $story)
                            <div class="video-holder">
                                <div class="video-box" onclick="showStory({{ $story->id }})">
                                    <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
                                    <a href="#" class="video-link">
                                        <video poster="{{ URL::asset('public/uploads/frontend/story/img_preview/'.$story->image)}}" muted>
                                            <source src="{{ URL::asset('public/uploads/frontend/story/video/'.$story->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <span></span>
                                    </a>
                                    <div class="video-box-footer">
                                        <span><i class="icofont-clock-time"></i>00.60</span>
                                        <span></span>
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
                        @else
                        <div class="alert alert-danger" role="alert">
                            Nothing Found
                        </div>
                        @endif
                    </div>
                </div>
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


     $(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 60,
            values: [0, 60],
            slide: function(event, ui) {
                $("#amount").val(ui.values[0]);
                $("#amount2").val(ui.values[1] + (ui.values[1] == 60 ? '+' : ''));
            },
            change: function(event, ui) {
                // Call the sortByCategory function when the user stops sliding
                sortByCategory('duration', 'durationFilter');
            }
        });
        // Set the initial values
        $("#amount").val($("#slider-range").slider("values", 0));
        $("#amount2").val($("#slider-range").slider("values", 1) + '+');
    });
    function getActiveTab(evt, typeName) {

        var i;
        var x = document.getElementsByClassName("listType");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";

            document.getElementById(typeName).style.display = "block";
        }
    }

    $('.link').click(function() {
        var requested_to = $(this).attr("id")
        $(".link").removeClass("active");
        $(".link_" + requested_to).addClass("active");
    });

    var path = full_path + "autocomplete";
    $("input.typeahead").typeahead({
        source: function(value, process) {
            return $.get(
                path, {
                    value: value,
                },
                function(data) {

                    return process(data);
                }
            );
        },
    });

    $("#selector").change(function() {
        $("#slider-range").slider('values',0,$(this).val());
        alert('js')
    });
</script>
@stop