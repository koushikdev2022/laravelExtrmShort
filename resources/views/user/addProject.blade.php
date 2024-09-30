@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
<style>
    .dropzone {
        background-color: #F9F9F9 !important;
        position: relative !important;
        /* padding: 0!important; */
        width: 100% !important;
        text-align: center !important;
        border: 2px dashed #ff1a03 !important;
        border-radius: 5px !important;
        line-height: 18px !important;
        overflow: hidden !important;
        cursor: pointer !important;
    }

    .dz-button {
        background-color: #2ecc71 !important;
        color: #fff !important;
        padding: 5px !important;
        border-radius: 5px !important;
    }
</style>

@stop
@section('content')

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
                <a href="{{ URL('/') }}"><img src="{{ URL::asset('public/frontend/dashboard/images/logo.png') }}" alt="" class="img-responsive"></a>
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
            <li class="{{ (in_array(Route::currentRouteName(), ['purchasedVideoListing'])) ? 'active' : '' }}"><a href="{{ Route('purchasedVideoListing')}}"><i class="icofont-ui-video-play"></i>my purchased videos</a></li>
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
                            <li><a href="{{ Route('user.edit.profile') }}" data-original-title="" title=""><i class="icofont-gear"></i>&nbsp;Account Settings</a></li>
                            <li><a href="{{ Route('logout') }}" data-original-title="" title=""><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Logout</a>
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
        <li class="active stepli steplione"><a href="javascript:void(0)"><i class="icofont-pencil-alt-2"></i>Upload And Description <i class="fa fa-check-circle checkTick step_process1" aria-hidden="true"></i></a></li>
        <li class="stepli steplitwo"><a href="javascript:void(0)"><i class="icofont-list"></i>Details <i class="fa fa-check-circle checkTick step_process2" aria-hidden="true"></i></a></li>
        <li class="stepli steplithree"><a href="javascript:void(0)"><i class="icofont-dollar"></i>License And Price <i class="fa fa-check-circle checkTick step_process3" aria-hidden="true"></i></a></li>
        <li class="stepli steplifour"><a href="javascript:void(0)"><i class="icofont-check"></i>Review <i class="fa fa-check-circle checkTick step_process4" aria-hidden="true"></i></a></li>
    </ul>

    <div class="copy-right text-left mt-auto">©{{ date('Y') }} Copyright.</div>
</div>

@endif
<div class="user-dash-right">
    @include('partials.dashboard.topright')
    <form enctype="multipart/form-data" id="projectRequest" method="POST">
        @csrf
        <div class="clearfix step1">
            <div class="dash-bottom-part pb-0">
                <div class="justify-content-center">
                    <div class="col-md-12">

                        <div class="processCard">
                            <div class="processHeader">
                                <h4>Upload Video Footage, Title & Description</h4>
                                <p>Step 1 of 4</p>
                            </div>
                            <div class="processBody">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-2">
                                            <label>Upload your content</label>
                                        </div>
                                        <div class="row" style="clear: both;margin-top: 18px;">
                                            <div class="col-12">
                                                <div class="dropzone" id="upload-dropzone"></div>
                                            </div>
                                        </div>
                                        <span class="help-block text-danger" id="videoValidationMessage"></span>
                                        <p class="m-0 mt-2 mb-3 infobuttomTitle">Videos must be .mov or .mp4 format <i class="icofont-info-circle mr-2" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i><a href="javascript:void(0)" onclick="criteria()">Check the criteria</a></p>

                                        <div class="form-group uploadfield">
                                            <label for="exampleInputEmail1">Add a thumbnail image <i class="icofont-question-circle mr-1" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></label>

                                            <input type="file" name="image" class="file">
                                            <div class="input-group">
                                                <input type="text" class="form-control" disabled placeholder="Only jpg, jpeg, png file" accept=".png, .jpg, .jpeg" aria-label="Upload File" aria-describedby="basic-addon1">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse input-group-text btn btn-primary" id="basic-addon2"><i class="icofont-upload-alt"></i> Upload Here</button>
                                                </div>
                                            </div>
                                            <span class="help-block text-danger"></span>

                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="exampleInputEmail1">Write a title for your content</label>
                                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            <span class="help-block text-danger"></span>

                                        </div>

                                        <div class="form-group">
                                            <label>Here are some good examples:</label>
                                            <ul class="outList">
                                                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                <li>Suspendisse ante leo, molestie quis odio eu, malesuada sollicitudin orci.</li>
                                                <li>Sed quis urna varius nisl dictum rhoncus vel ut nibh.</li>
                                            </ul>
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" placeholder="" name="description" rows="8" onkeyup="countChar(this)"></textarea>
                                            <span class="help-block text-danger"></span>

                                            <p class="text-muted text-right m-0 mt-2"><span id="charNum">0</span>/200 characters (minimum 50)</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                            <div class="processFooter">
                                <a href="{{ Route('dashboard') }}" class="dash_btn_outline mr-3">Back</a>
                                <button type="submit" class="dash_btn_green" id="submit_step1">Next</button>
                            </div>
                        </div>

                    </div>
                    <!-- col-lg-12 end -->
                </div>
            </div>
        </div>
        <div class="clearfix step2">
            <div class="dash-bottom-part pb-0">
                <div class="justify-content-center">
                    <div class="col-md-12">

                        <div class="processCard">
                            <div class="processHeader">
                                <h4>Details</h4>
                                <p>Step 2 of 4</p>
                            </div>
                            <div class="processBody">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Select a category</label>
                                            <select class="form-control categorySelector" name="category" onchange="changeCategory()" id="exampleFormControlSelect1">
                                                <option value="">Select Category</option>
                                                @forelse($categories as $c)
                                                <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <div class=" text-danger help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group addplaylist">
                                            <label for="exampleFormControlSelect1">Select a playlist <i class="icofont-question-circle mr-1" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></label>
                                            <div class="input-group">
                                                <select class="form-control playlistSection" name="playlist_id" id="exampleFormControlSelect1">
                                                    <option value="">Select Playlist</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <a class="browse input-group-text btn btn-primary" href="javascript:void(0)" onclick="newPlaylist('1')"><i class="icofont-plus-circle"></i> Add new playlist</a>
                                                </div>
                                            </div>
                                            <div class=" text-danger help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between mb-2">
                                                <div>
                                                    <label for="exampleInputEmail1">Keyword suggestion <i class="icofont-question-circle mr-1" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></label>
                                                </div>
                                                <!-- <div>
                                                    <a class="addNew" href="javascript:void(0)" onclick="newPlaylist('2')"><i class="icofont-plus-circle"></i> Add new keyword</a>
                                                </div> -->
                                            </div>
                                            <div class="ans_checkbox jobTag">
                                                <span id="keywordsSection"></span>
                                                <a class="btnSeeMore mb-0" id="keywordSeeMore" href="javascript:void(0)" onclick="seeMore('keywordSeeMore')">See More</a>
                                            </div>
                                            <div class=" text-danger help-block"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group addplaylist">
                                            <label for="exampleFormControlSelect1">Select a Event <i class="icofont-question-circle mr-1" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></label>
                                            <div class="input-group">
                                                <select class="form-control eventSection" name="event_id" id="exampleFormControlSelect1">
                                                    <option value="">Select Event</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <a class="browse input-group-text btn btn-primary" href="javascript:void(0)" onclick="newPlaylist('2')"><i class="icofont-plus-circle"></i> Add New Event</a>
                                                </div>
                                            </div>
                                            <div class=" text-danger help-block"></div>
                                        </div>
                                    </div>
                                    <div class=" form-group col-md-8">
                                        <div class=" mb-2">
                                            <label for="exampleFormControlSelect1">Location <i class="icofont-question-circle mr-1" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></label>
                                        </div>
                                        <div class="  input-group mb-3">
                                            <span class="input-group-text"><i class="icofont-location-pin"></i></span>
                                            <input type="text" class="form-control groupInput pl-0" placeholder="Choose location" name="location" aria-label="Amount (to the nearest dollar)">
                                        </div>
                                        <div class=" text-danger help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" name="project_id" class="project_id_step2">

                            <div class="processFooter">
                                <button type="button" class="dash_btn_outline mr-3" id="step_2_back">Back</button>
                                <button type="submit" class="dash_btn_green" id="submit_step2">Next</button>
                            </div>
                        </div>

                    </div>
                    <!-- col-lg-12 end -->
                </div>
            </div>
        </div>
        <div class="clearfix step3">
            <div class="dash-bottom-part pb-0">
                <div class="justify-content-center">
                    <div class="col-md-12">

                        <div class="processCard">
                            <div class="processHeader">
                                <h4>License and price</h4>
                                <p>Step 3 of 4</p>
                            </div>
                            <div class="processBody">
                                <div class="vdBox">
                                    <div class="row align-items-end">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Video quality</label>
                                                <select class="form-control" name="quality[]" id="exampleFormControlSelect1">
                                                    <option value="1">HD</option>
                                                    <option value="2">4K</option>
                                                </select>
                                                <div class=" text-danger help-block"></div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-text"><i class="icofont-dollar"></i></span>
                                                <input type="number" class="form-control groupInput quality"  onkeyup="changeQuality(0)" id="quality_0" name="quality_amount[]" aria-label="Amount (to the nearest dollar)">
                                                <div class=" text-danger help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="commission_0">Licence for</label>
                                                <select class="form-control select-commission " onchange="changeCommission(0)" id="commission_0" name="licence_for[]">
                                                    <!-- <option value="">Select Licence Type</option> -->
                                                    @forelse($commissions as $c)
                                                    <option value="{{ $c->name}}">{{ $c->name}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <div class=" text-danger help-block"></div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-text"><i class="icofont-dollar"></i></span>
                                                <input type="text" class="form-control groupInput licence_amount" id="licence_amount_0" name="licence_amount[]" aria-label="Amount (to the nearest dollar)" readonly>
                                                <div class=" text-danger help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="vdContent">
                                                <p>Price for this <br>
                                                    combination</p>
                                                <h4 class="combiningAmount" id="combiningAmount_0">$0</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="vdBtn" id='addCombination'><i class="icofont-plus-circle"></i> Add New Combination</a>
                                </div>
                                <div id="addCollection">
                                </div>
                            </div>
                            <div class="processBody pt-0">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Exclusive or Not?</label>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input exclusive" id="customRadio" name="is_exclusive" value="1">
                                                <label class="custom-control-label" for="customRadio">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input exclusive" id="customRadio2" name="is_exclusive" value="0">
                                                <label class="custom-control-label" for="customRadio2">No</label>
                                            </div>
                                        </div>
                                        <div style="display:none;" class="form-group" id="exclusiveField">
                                            <label>Exclusive Amount</label>
                                            <input type="text" class="form-control" name="exclusive_amount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" name="project_id" class="project_id_step3">

                            <input type="hidden" value="" name="draft_2" id="draft_2">

                            <div class="processFooter">
                                <a href="javascript:void(0)" class="dash_btn_outline mr-3" id="step_3_back">Back</a>
                                <a href="javascript:void(0)" class="dash_btn_outline mr-3" id="draft_project">Save As Draft</a>
                                <a href="javascript:void(0)" class="dash_btn_green" id="submit_step3">Submit</a>
                            </div>
                        </div>

                    </div>
                    <!-- col-lg-12 end -->
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="criteriaModal" tabindex="-1" role="dialog" aria-labelledby="criteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="criteriaModalLabel">Uploading Criteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus fermentum enim, lobortis hendrerit odio pellentesque sed. Praesent tortor metus, euismod et aliquam sit amet, condimentum eget nisl. Sed eu enim et lorem lobortis scelerisque.Sed porttitor arcu et urna volutpat pharetra. Ut vestibulum pharetra nibh. Aenean molestie ac est a imperdiet.</p>
                <ul class="outList">
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Suspendisse ante leo, molestie quis odio eu, malesuada sollicitudin orci.</li>
                    <li>Sed quis urna varius nisl dictum rhoncus vel ut nibh.</li>
                </ul>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn dash_btn_green" data-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>  

<!-- Playlist Modal -->
<div class="modal fade" id="platlistModal" tabindex="-1" role="dialog" aria-labelledby="platlistModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="platlistModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
                </button>
            </div>
            <form id="playlistRequest" action="{{ Route('savePlaylist') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Name" />
                        <div class=" text-danger help-block text-danger"></div>
                    </div>
                </div>
                <input type="hidden" name="type" id="playlist_type">
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn dash_btn_green">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<script>
    //to hide rest 2 forms
    $(document).ready(function() {
        $('.step2').css('display', 'none');
        $('.step3').css('display', 'none');
        loadPlaylist();
        loadKeyword();
        loadEvents();
    });

    //to change amount of licence for
    function changeCommission(id) {
        var name = $('.select-commission').find(":selected").val();
        ajaxindicatorstart();
        $.ajax({
            url: full_path + "getLicenceName",
            data: {
                name: name
            },
            success: function(response) {
                direct_percentile = (response.percentile) / 100;
                $('#licence_amount_'+id).html('');
                $("#licence_amount_"+id).val(direct_percentile);

                ajaxindicatorstop();
            }
        });
    }

    function countChar(val) {
        var len = val.value.length;
        if (len >= 200) {
            val.value = val.value.substring(0, 200);
        } else {
            $('#charNum').text(200 - len);
        }
    };

    function changeQuality(id) {
        var id = id;
        var amount = $('#quality_' + id).val();
        var name = $('.select-commission').find(":selected").val();

        ajaxindicatorstart();
        $.ajax({
            url: full_path + "getLicenceName",
            data: {
                name: name
            },
            success: function(response) {
                $('.licence_amount').html('');
                var licence_Amount = (response.percentile / 100) * amount;
                licence = parseFloat(licence_Amount).toFixed(2);
                var total = Number(amount) + Number(licence);
                $("#licence_amount_" + id).val(licence_Amount);

                // var comibination_id = $('.combiningAmount').attr('id');
                $('#combiningAmount_' + id).html('')
                $('#combiningAmount_' + id).append('$' + total)
                ajaxindicatorstop();
            }
        });
    }

    //exclusive hide & show
    $('.exclusive').on('click', function() {
        var value = $('input[name="is_exclusive"]:checked').val();
        if (value == '1') {
            $('#exclusiveField').css('display', 'block');
        } else {
            $('#exclusiveField').css('display', 'none');
        }
    });

    //see more hide and show
    function seeMore(id) {
        ajaxindicatorstart();
        $('#' + id).css('display', 'none');
        ajaxindicatorstop();
    }

    $('#step_2_back').on('click', function() {
        $('.step1').css('display', 'initial');
        $('.step2').css('display', 'none');
    });

    $('#step_3_back').on('click', function() {
        $('.step2').css('display', 'initial');
        $('.step3').css('display', 'none');
    });

    $('#draft_project').on('click', function(e) {
        $('#draft_2').val('draft');
        ajaxCalling('project-step3', e)
    });

    //to show modal
    function criteria() {
        $('#criteriaModal').modal('show');
    }

    //new playlist to show
    function newPlaylist(type) {
        $('#platlistModal').modal("show");
        $('#playlist_type').val(type);
    }

    Dropzone.options.uploadDropzone = {
        url: '{{ route("file-store") }}',
        acceptedFiles: ".mov,.mkv,.mp4",
        addRemoveLinks: true,
        maxFiles: 1,
        maxfilesexceeded: function(file) {
            this.removeAllFiles();
            this.addFile(file);
        },
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        removedfile: function(file) {
            var name = file.upload.filename;
            $("#videoValidationMessage").html("");
            $.ajax({
                type: 'POST',
                url: '{{ route("file-remove") }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name
                },
                success: function(data) {
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) {
            console.log(file);
        },
        error: function(error) {
            $('#videoValidationMessage').html("The file duration must be less than 60 seconds.")
        }
    }

    //to add playlist
    $('#playlistRequest').on('submit', function(e) {
        e.preventDefault();
        ajaxindicatorstart();
        var formdata = new FormData($('#playlistRequest')[0]);
        $.ajax({
            url: full_path + 'savePlaylist',
            type: "POST",
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            success: function(resp) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + resp.message,
                    time: 6,
                });
                $("#playlistRequest")[0].reset();
                loadPlaylist();
                loadKeyword();
                loadEvents();
                $('.project_id').val(resp.project_id)
                $('#platlistModal').modal("hide");
                ajaxindicatorstop();
            },
            error: function(err) {
                $.each(err.responseJSON.errors, function(key, val) {
                    $("#playlistRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                    $("#playlistRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .addClass("has-error");
                });
                ajaxindicatorstop();
            }
        })
    });

    //ajax for contacts to load
    function loadPlaylist() {
        ajaxindicatorstart();
        $.ajax({
            url: full_path + "getplaylist",
            success: function(response) {
                $('.playlistSection').html('');
                $(".playlistSection").append("<option value=''>Select Playlist</option>");
                $.each(response, function(index, value) {
                    $(".playlistSection").append("<option value=" + value.id + ">" + value.name + "</option>");
                });
                ajaxindicatorstop();
            }
        });
    }

    function loadEvents(){
        ajaxindicatorstart();
        $.ajax({
            url: full_path + "getevents",
            success: function(response) {
                $('.eventSection').html('');
                $(".eventSection").append("<option value=''>Select Event</option>");
                $.each(response, function(index, value) {
                    $(".eventSection").append("<option value=" + value.id + ">" + value.name + "</option>");
                });
                ajaxindicatorstop();
            }
        });
    }

    function changeCategory() {
        loadKeyword();
    }

    //ajax for keyword to load
    function loadKeyword() {
        ajaxindicatorstart();
        var category = $(".categorySelector").val();

        $.ajax({
            url: full_path + "getKeyword",
            data: {
                category: category
            },
            success: function(response) {
                $('#keywordsSection').html('');
                $('#keywordsSection').append(response.content);
                ajaxindicatorstop();
            }
        });
    }

    //ajax call for saving each step
    function ajaxCalling(url, e) {
        e.preventDefault();
    ajaxindicatorstart();
    
    // Clear existing errors
    clearErrors();
        var data = new FormData($('#projectRequest')[0]);
        $.ajax({
            type: "POST",
            url: full_path + url,
            data: data,
            dataType: $(this).data("type"),
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + response.message,
                    time: 6,
                });

                if (response.draft == '1') {
                    window.location.href = full_path + "dashboard";
                }
                $('.' + response.previous).css('display', 'none')
                $('.' + response.next).css('display', 'initial')

                $('.' + response.checkpoint).addClass('checkTickDone');
                $('.stepli').removeClass('active');
                $('.' + response.project_li).addClass('active');
                $('.project_id_step2').val(response.project_id_step2)
                $('.project_id_step3').val(response.project_id_step3)
                ajaxindicatorstop();
            },
            // error: function(response) {
            //     ajaxindicatorstop();
            //     $.each(response.responseJSON.errors, function(key, val) {
            //         $("#projectRequest")
            //             .find('[name="' + key + '"]')
            //             .closest(".form-group")
            //             .find(".help-block")
            //             .html(val[0]);
            //         $("#projectRequest")
            //             .find('[name="' + key + '"]')
            //             .closest(".form-group")
            //             .addClass("has-error");
            //     });
            // },

            error: function(response) {
            ajaxindicatorstop();
            displayErrors(response.responseJSON.errors);
        }
        });
    }
    

function clearErrors() {
    $("#projectRequest .form-group").removeClass("has-error");
    $("#projectRequest .help-block").html('');
}

function displayErrors(errors) {
    $.each(errors, function(key, val) {
        $("#projectRequest")
            .find('[name="' + key + '"]')
            .closest(".form-group")
            .addClass("has-error")
            .find(".help-block")
            .html(val[0]);
    });
}

    //when clicking draft 1 form
    $('#draft1').on('click', function(e) {
        $('#draft_1').val('draft_1');
        ajaxCalling('step_one', e)
    });

    //when clicking continue 1 form
    $('#submit_step1').on('click', function(e) {
        ajaxCalling('project-step1', e)
    });

    //when clicking continue 2 form
    $('#submit_step2').on('click', function(e) {
        ajaxCalling('project-step2', e)
    });

    //when clicking continue 2 form
    $('#submit_step3').on('click', function(e) {
        ajaxCalling('project-step3', e)
    });

    var commissions = {!!json_encode($commissions) !!};

    // add item of form 5 row
    $('#addCombination').click(function() {
        var i = '1';
        var html = '';
        html += '<div class="vdBox" id="combinationGroup">';
        html += '<div class="row align-items-end">';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label for="exampleFormControlSelect1">Video quality</label>';
        html += '<select class="form-control " name="quality[]" id="exampleFormControlSelect1">';
        html += '<option value="1">HD</option>';
        html += '<option value="2">4K</option>';
        html += '</select>';
        html += '<div class=" text-danger help-block"></div>';
        html += '</div>';
        html += '<div class="input-group">';
        html += '<span class="input-group-text"><i class="icofont-dollar"></i></span>';
        html += '<input type="number" class="form-control groupInput quality" id=' + `quality_${i}` + ' onkeyup="changeQuality('+i+')" name="quality_amount[]" aria-label="Amount (to the nearest dollar)">';
        html += '<div class=" text-danger help-block"></div>';

        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label id=' + `commission_${i}` + '>Licence for</label>';
        html += '<select class="form-control select-commission" onchange="changeCommission('+i+')" name="licence_for[]" id=' + `commission_${i}` + '>';
        // html += '<option value="">Select Licence Type</option>';
        $.each(commissions, function(index, value) {
            html += '<option value=' + value.name + '>' + value.name + '</option>';
        });

        html += '</select>';
        html += '<div class=" text-danger help-block"></div>';

        html += '</div>';

        html += '<div class="input-group">';
        html += '<span class="input-group-text"><i class="icofont-dollar"></i></span>';
        html += '<input type="text" class="form-control groupInput licence_amount" id=' + `licence_amount_${i}` + ' name="licence_amount[]" aria-label="Amount (to the nearest dollar)" readonly>';
        html += '<div class=" text-danger help-block"></div>';

        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="vdContent">';
        html += '<p>Price for this <br>combination</p>';
        html += '<h4 class="combiningAmount" id=' + `combiningAmount_${i}` + '>$0</h4>';
        html + '</div>';
        html += '</div>';
        html += '</div>';
        html += '<a href="javascript:void(0)" class="vdBtnDelete" id="removeCollection"><i class="icofont-bin"></i></a>';
        html += '</div>';
        $('#addCollection').append(html);
    });

    // remove row
    $(document).on('click', '#removeCollection', function() {
        $(this).closest('#combinationGroup').remove();
    });
</script>
<script>
    $(document).on("click", ".browse", function() {
        var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
        file.trigger("click");
    });
    $(document).on("change", ".file", function() {
        $(this)
            .parent()
            .find(".form-control")
            .val(
                $(this)
                .val()
                .replace(/C:\\fakepath\\/i, "")
            );
    });
</script>
@stop