@extends('layouts.main')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('stroage/frontend/custom/raty-3.1.0/lib/jquery.raty.css') }}">

    <style>
        .functions .demo {
        margin-bottom: 10px;
        }

        .functions .item {
        background-color: #FEFEFE;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 5px;
        padding: 5px 10px;
        }

        .functions .item a {
        border: 1px solid #CCC;
        margin-left: 10px;
        padding: 5px;
        text-decoration: none;
        }

        .functions .item input {
        display: inline-block;
        margin-left: 2px;
        padding: 5px 6px;
        width: 120px;
        }

        .functions .item label {
        display: inline-block;
        font-size: 1.1em;
        font-weight: bold;
        }

        .hint {
        font-size: 16px;
        padding: 5px 10px;
        text-align: center;
        width: 160px;
        }

        div.hint {
        margin-top: 10px;
        }
    </style>

    <style>
        .functions .demo {
            margin-bottom: 10px;
        }
        .dltImg img{
            max-width: 25% !important;
        }

        .functions .item {
            background-color: #FEFEFE;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 5px;
            padding: 5px 10px;
        }

        .functions .item a {
            border: 1px solid #CCC;
            margin-left: 10px;
            padding: 5px;
            text-decoration: none;
        }

        .functions .item input {
            display: inline-block;
            margin-left: 2px;
            padding: 5px 6px;
            width: 120px;
        }

        .functions .item label {
            display: inline-block;
            font-size: 1.1em;
            font-weight: bold;
        }

        .hint {
            font-size: 16px;
            padding: 5px 10px;
            text-align: center;
            width: 160px;
        }

        div.hint {
            margin-top: 10px;
        }
    </style>

@stop
@section('content')

<div class="container backButton">
    <div class="d-flex justify-content-between">
        <div>
            <h4> <i class="icofont-document-folder"></i> Task Details</h4>
        </div>
        <div>
            <a class="btn-site btn-normal-outline me-2" href="{{ Route('find_task') }}"><i class="icofont-simple-left"></i> Back To
                Listing</a>
        </div>
    </div>
</div>
{{-- {{ json_encode($bidStatus) }} --}}
{{-- <hr> --}}
{{-- {{ $project }} --}}
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-9 proSecLeft">
                <div class="taskProTitle">
                    <h2>{{$project->title}}</h2>
                </div>
                <div class="proType d-flex justify-content-between">
                    <div class="proItems proItemsCat">
                        <h5>Task category</h5>
                        <?php
                        $cats = explode(",", $project->categories);

                        foreach ($cats as $cat) {
                            $cat_name = \App\Models\Category::with('translation')->whereNull('parent_id')->where('id', '=', $cat)->where('status', '=', '1')->first();
                        ?>
                            <p>{{ $cat_name->translation->category_name}}, </p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="proItems">
                        <h5>Subcategory</h5>
                        <?php
                        $sub_cat = explode(",", $project->sub_categories);

                        foreach ($sub_cat as $subc) {
                            $sub_cats = \App\Models\TranslationCategory::where('category_id', '=', $subc)->where('status', '=', '1')->first();
                        ?>
                            <p>{{ $sub_cats->category_name}}, </p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="proItems">
                        <h5>budget</h5>
                        <p>${{ $project['budget']}}</p>
                    </div>
                    <div class="proItems">
                        <h5>Task published</h5>
                        <p>{{$project->created_at->diffForHumans()}}</p>
                    </div>
                    <div class="proItems">
                        <h5>deadline</h5>
                        @if($project->begin_date != '')
                        <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->begin_date)->format('l jS  F Y ') }}</p>
                        @endif
                    </div>
                </div>
                <div class="TaskProDes">
                    <h5>Task description</h5>
                    <p>{{ $project->description}}</p>
                </div>
                @php
                $date=date('Y-m-d');
                $user=Auth::guard('frontend')->user();
                $ExtendExpireDate=App\Models\ExtendExpireDate::where('end_date','>',$date)->where('user_id',$user->id)->orderBy('id','DESC')->first();
                @endphp
                @if(!empty($ExtendExpireDate))
                <div class="TaskProDes">
                    <h5>Phone number</h5>
                    <p>{{ $project->phone}}</p>
                </div>
                @endif

                <div class="TaskProDes proAddress">
                    <h5>Address</h5>

                    <div class="row mt-3">
                        <div class="col-md-5">
                            <div class="d-flex">
                                <div>
                                    <i class="icofont-location-pin"></i>
                                </div>

                                <div>
                                    <h6>Pickup address</h6>
                                    <p>{{$project['start_address']}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex">
                                <div>
                                    <i class="icofont-location-pin"></i>
                                </div>

                                <div>

                                    <h6>Delivery address</h6>
                                    @forelse($project['address'] as $final_add)

                                    <p>{{ $final_add['final_address']}}</p>
                                    @empty
                                    <p>No Address Found</p>
                                    @endforelse

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="TaskProDes proImages">
                    <h5>attachements</h5>

                    <div class="d-flex flex-wrap mt-3">
                        @forelse($project['files'] as $files)
                        <div>
                            <a href="{{ URL::asset('storage/uploads/frontend/project/'.$files['image']) }}" target="_blank">
                                <img src="{{ URL::asset('storage/uploads/frontend/project/'.$files['image']) }}" alt="">
                            </a>
                        </div>
                        @empty
                        <div>
                            No Attachments Found
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 proSecRight">
                {{-- <div class="btn-area">
                    <button class="btn-site btn-normal">Submit a Proposal</button>
                </div> --}}
                @php
                    $user=auth()->guard('frontend')->user();
                    $bid=App\Models\Bid::where('project_id',$project->id)->where('user_id',$user->id)->where('status','<>','3')->first();
                @endphp
                @if($project->user_id != $user->id)
                <div class="btn-area">
                    @guest('frontend')
                    <a href="{{route('login')}}" class="btn-site btn-normal mt-3">Submit a Proposal</a>
                    @endguest
                    @if (auth()->guard('frontend')->check() && Request::route()->getName()!='user-profile')

                    <button class="btn-site btn-normal mt-3 {{ !empty($bid) ? 'd-none' : ''}}" id="proposal_btn" onclick="submit_proposal({{$project->id}})" >Submit a Proposal</button>

                    @if($project->status==3)
                    <button class="btn-site btn-normal mt-3 {{ !empty($bid) ? '' : 'd-none'}}" id="proposal_edit_btn" onclick="submit_proposal({{$project->id}})"  disabled>Completed project</button>
                    @elseif($project->status==2)
                    <button class="btn-site btn-normal mt-3 {{ !empty($bid) ? '' : 'd-none'}}" id="proposal_edit_btn" onclick="submit_proposal({{$project->id}})" disabled>Closed</button>
                    @elseif($project->status==1)
                    <button class="btn-site btn-normal mt-3 {{ !empty($bid) ? '' : 'd-none'}}" id="proposal_edit_btn" onclick="submit_proposal({{$project->id}})">Edit a Proposal</button>
                    @endif

                    @endif
                    @php
                        $data['user']= Auth()->guard('frontend')->user();
                        $AddFavorite=App\Models\AddFavorite::where('to_id',$project->user->id)->where('form_id',$data['user']->id)->where('project_id',$project->id)->where('status','1')->first();
                    @endphp
                    @guest('frontend')
                    <a href="{{route('login')}}"  class="btn btn-outline mt-3 {{(!empty($AddFavorite))?"d-none":""}}"><span >Add To Favorites</span></a>
                    <a href="{{route('login')}}" class="btn btn-outline mt-3 {{(!empty($AddFavorite))?"":"d-none"}}"><span>Remove To Favorites</span></a>
                    @endguest
                    @if (auth()->guard('frontend')->check() && Request::route()->getName()!='user-profile')
                    <a id="add-favorite{{$project->user->id}}" href="javascript:void(0)"  onclick="add_favorite({{$project->id}},{{$project->user->id}},'1')" class="btn btn-outline mt-3 {{(!empty($AddFavorite))?"d-none":""}}"><span >Add To Favorites</span></a>
                    <a id="remove-favorite{{$project->user->id}}" href="javascript:void(0)"  onclick="add_favorite({{$project->id}},{{$project->user->id}},'0')" class="btn btn-outline mt-3 {{(!empty($AddFavorite))?"":"d-none"}}"><span>Remove To Favorites</span></a>
                    @endif
                    {{-- <button class="btn btn-outline mt-3"><i class="icofont-plus-circle"></i> Add To Favorites</button> --}}
                    @guest('frontend')
                        <a class="btn btn-trans mt-3" href="{{route('login')}}">Report Job As Inappropriate</a>
                    @endguest
                    @if (auth()->guard('frontend')->check() && Request::route()->getName()!='user-profile')
                        <a class="btn btn-trans mt-3" data-bs-toggle="modal" data-bs-target="#add-report" onclick="add_report({{$project->id}})" href="javascript:void(0)">Report Job As Inappropriate</a>
                    @endif
                </div>
                @endif

                <div class="profileArea">
                    <p class="title">About the Client</p>
                    <div class="d-flex align-item-center">
                        <div>
                            <img src="{{ URL::asset('storage/uploads/frontend/profile_picture/original/'.$project['user']['profile_picture']) }}" alt="">
                        </div>
                        <div>
                            <p class="proName">{{ $project['user']['name']}}</p>
                        </div>
                    </div>
                    <div class="proImgDetails">
                        <?php
                            $max = 0;
                            if(isset($review[0]->id)){
                                $n = count($review); // get the count of comments
                                foreach ($review as $rate => $count) { // iterate through array
                                    $max = $max+$count->score;
                                }
                                $avgRating = $max / $n;
                            }
                            else{
                                $n = 0;
                                $avgRating =0;
                            }

                        ?>

                        <p><i class="icofont-location-pin"></i> {{ !empty($project['user']['address_line1']) ? $project['user']['address_line1'] : 'N/A' }}</p>
                        <p> <i class="icofont-user"></i>
                            @for ($i=0; $i < $avgRating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            {{ $avgRating }} of {{ $n }} reviews
                        </p>

                        {{-- {{ $review }} --}}
                        <p><i class="icofont-clock-time"></i> Member {{ date('F j, Y', strtotime($project['user']['created_at'])) }}</p>
                        <p> </p>
                    </div>
                    <div>
                        @if(isset($bidStatus) && $bidStatus->status == 1)
                            <a class="btn-site btn-normal mt-3 " data-bs-toggle="modal" data-bs-target="#add-review" onclick="add_report({{$project->id}})" href="javascript:void(0)">Write A Review</a>
                        @endif
                    </div>
                </div>
                <div class="profileArea clientEng">
                    <p class="title">Client Engagement</p>
                    <h5>Has published</h5>
                    <h6>0 Tasks</h6>

                    <h5>Has performed</h5>
                    <h6>0 Tasks</h6>
                </div>

                <div class="clientVerification">
                    <p class="title">Client Verification</p>
                    <ul class="list-group checkList">
                        <li class="border-0 p-0 pb-2 list-group-item"><i class="fa-solid fa-circle-check"></i> Personal ID</li>
                        <li class="border-0 p-0 pb-2 list-group-item"><i class="fa-solid fa-circle-check"></i> E-mail</li>
                        <li class="border-0 p-0 pb-2 list-group-item"><i class="fa-solid fa-circle-check"></i> Phone</li>
                        <li class="border-0 p-0 pb-2 list-group-item"><i class="fa-solid fa-circle-check"></i> Google</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .rating {
    display: inline-block;
    position: relative;
    height: 50px;
    line-height: 50px;
    font-size: 50px;
    }

    .rating label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    cursor: pointer;
    }

    .rating label:last-child {
    position: static;
    }

    .rating label:nth-child(1) {
    z-index: 5;
    }

    .rating label:nth-child(2) {
    z-index: 4;
    }

    .rating label:nth-child(3) {
    z-index: 3;
    }

    .rating label:nth-child(4) {
    z-index: 2;
    }

    .rating label:nth-child(5) {
    z-index: 1;
    }

    .rating label input {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    }

    .rating label .icon {
    float: left;
    color: transparent;
    }

    .rating label:last-child .icon {
    color: #000;
    }

    .rating:not(:hover) label input:checked ~ .icon,
    .rating:hover label:hover input ~ .icon {
    color: #09f;
    }

    .rating label input:focus:not(:checked) ~ .icon:last-child {
    color: #000;
    text-shadow: 0 0 5px #09f;
    }
</style>
<script>
    $(':radio').change(function() {
  console.log('New star rating: ' + this.value);
});
</script>
<!--Start Add Recommendation Model-->
<div class="modal fade" id="add-review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered addChatModal">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="">Write A Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="">
                <h6>Review</h6>
                {{-- id="add-review-form" --}}
                <form class="mt-2 space-y-6 c-form "  action="{{route('user.add_review')}}" method="post">
                    @csrf
                    <div class="rating">
                        <label>
                            <input type="radio" name="score" value="1" />
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </div>
                    <input type="hidden" name="project_id" id="review_value" value="{{ $project->id }}">
                    <div class="form-floating mb-3 form-group">
                    <!-- <label for="floatingInput">Review</label> -->
                        <div id="rating-star"></div>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-floating mb-3 form-group">
                        <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden; height:120px" rows="5" type="text" name="message" class="form-control search-input" placeholder="Write a review.."></textarea>
                        <label  for="floatingInput">Message</label>
                        <span class="help-block"></span>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-site btn-normal form-login-action" type="submit">Submit</button>
                    </div>
                </form>



        </div>
    </div>
</div>


<div class="modal fade" id="add-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered addChatModal">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="">Report Job As Inappropriate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="">
                <h6>Write A Reason</h6>
                <form class="mt-2 space-y-6 c-form" id="add-report-form" action="{{route('user.add-report')}}" method="post">
                    <input type="hidden" name="project_id" id="report_value">
                    <div class="form-floating mb-3 form-group">
                        <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden; height:120px" rows="5" type="text" name="message" class="form-control search-input" placeholder="Write a review.."></textarea>
                        <label  for="floatingInput">Write A Reason</label>
                        <span class="help-block"></span>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-site btn-normal form-login-action" type="submit">Submit</button>
                    </div>
                </form>
        </div>
    </div>
</div>



<!-- Modal -->
 <!-- Modal Proposal -->
 <div class="modal fade" id="proposalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bidding Screen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="mt-2 space-y-6 c-form" id="store-proposal" action="" method="post">
                <span id="htmleditproposal"></span>

            <div class="modal-footer">
                <button type="button" class="btn btn_site_outline" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn_site form-login-action">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>


@endsection
@section('js')
<script type="text/javascript" src="{{URL::asset('storage/frontend/custom/raty-3.1.0/lib/jquery.raty.js')}}"></script>
<script>
    $('#rating-star').raty({ score: 3 });

    function textAreaAdjust(element) {
  element.style.height = "1px";
  element.style.height = (64+element.scrollHeight)+"px";
}
</script>
@stop
