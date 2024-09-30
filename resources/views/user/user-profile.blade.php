@extends('layouts.main')

@section('content')
<section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="proLeft">
                    <div class="ppProfile">
                        <div class="d-flex">
                            <div>
                                <img src="{{($user->profile_picture != '') ? asset('storage/uploads/frontend/profile_picture/original/'.$user->profile_picture) : asset('storage/frontend/images/profile/dummyProfile.jpg')}}" onerror="this.onerror=null;this.src='{{asset("storage/frontend/images/profile/dummyProfile.jpg")}}';" alt="">
                            </div>
                            <div class="flex-fill">
                                <h5>{{$user->name}}</h5>
                                {{-- <p class="u-online"><i class="fa-solid fa-circle"></i> Online</p> --}}
                                <h6>Job success</h6>
                                <div class="progressMain">
                                    <div class="progress-bar">
                                        <div style="width: 96%" class="progress"></div>
                                    </div>
                                    <p class="progressText">96%</p>
                                </div>
                            </div>
                        </div>
                        <div class="ppBtnSection">
                            @if(!empty($bids))
                            <div class="row">
                                @if($bids->status==0)
                                <div class="col-6">
                                    <a href="{{route('user.accept-proposal-award',base64_encode($bids->id))}}" class="nav-link nav-green-btn">Hire Talent</a>
                                </div>
                                @elseif($bids->status==1)
                                {{-- <div> <a href="{{route('user.view-award-contract',base64_encode($bids->id))}}"
                                        class="btn btn_site btn_fixed ">View milestone</a></div> --}}
                                        <div class="col-6"> <a href="javascript:void(0);" class="nav-link nav-green-btn">Hired</a></div>
                                @endif
                                
                                {{-- <div class="col-6">
                                    <a href="{{route('user.messages',base64_encode($user->id))}}" class="nav-link nav-green-btn"><i class="icofont-chat"></i> Message</a>
                                </div> --}}
                                <div class="col-12">
                                    <table class="table">
                                        <thead class="thead-light">
                                          <tr>
                                            <th scope="col">Agree Amount</th>
                                            <th scope="col">Agree Deadline</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th>${{$bids->budget_details->billable_target}}</th>
                                            <td>{{!empty($bids->deadline)?date('jS M Y',strtotime($bids->deadline)):''}}</td>
                                          </tr>
                                          
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="ppDetails">
                        <div class="d-flexx">
                            <ul class="fa-ul">
<!--                                    <li><span class="fa-li"><i class="icofont-user-suited"></i></span>
                                    <h5>Age</h5>
                                    <p>24 years</p>
                                </li>-->
                                <li>
                                    <span class="fa-li"><i class="icofont-location-pin"></i></span>
                                    <h5>From</h5>
                                    <p>{{!empty($user->address_line1) ? $user->address_line1:'N/A'}}</p>
                                </li>
                                <li>
                                    <span class="fa-li"><i class="icofont-phone"></i></span>
                                    <h5>Phone number</h5>
                                    <p><a href="tel:{{!empty($user->phone) ? $user->phone:''}}">{{!empty($user->phone) ? $user->phone:'N/A'}}</a></p>
                                </li>
                                <li><span class="fa-li"><i class="fa fa-language" aria-hidden="true"></i></span>
                                    <h5>Speaks</h5>
                                    @if(!empty($user->details->languages))
                                    @foreach($user->details->languages as $key=>$lang)
                                    @php
                                    $language=App\Models\Language::find($lang);
                                    @endphp
                                    {{$language->Language}}{{($key<0) ? '':','}}
                                    @endforeach
                                    @endif
                                    {{-- <p>{{$user->details->languages}}</p> --}}
                                   
                                </li>
                                <li><span class="fa-li"><i class="icofont-user-alt-7"></i></span>
                                    <h5>Member since</h5>
                                    <p>{{date_format($user->created_at, 'M Y');}}</p>
                                </li>
                                {{-- <li><span class="fa-li"><i class="icofont-clock-time"></i></span>
                                    <h5>Hours Available</h5>
                                    <p class="lh-base">More than 30 hrs/week <br>
                                        &lt; 24 hrs response time</p>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="expertDetailsBox">
                    <div class="profileDash textuper d-flex justify-content-between">
                        {{-- <div class="proItems">
                            <h5>Average hourly rate</h5>
                            <p>$20/HOUR</p>
                        </div> --}}
                        <div class="proItems">
                            <h5>Has performed</h5>
                            <p>64 tasks</p>
                        </div>
                        <div class="proItems">
                            <h5>Has published</h5>
                            <p>25 tasks</p>
                            <p></p>
                        </div>
                        <div class="proItems flex-fill">
                            <h5>Rating</h5>
                            <p class="starRating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                {{-- <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i> --}}
                                @php
                                $total_review=App\Models\Review::where('client_id',$user->id)->where('status','1')->avg('score');
                                @endphp
                                @if(!empty($total_review))
                                <span class="reviewRate">({{round($total_review,1)}})</span>
                                @else
                                <span class="reviewRate">(N/A)</span>
                                @endif
                            </p>
                        </div>
                        
                        <div class="proItems dropOptions text-end pe-0 align-self-center">
                            <span class="dropdown dropstart">
                            <button class="iconBtn" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-flag" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu dropdownLeft" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </span>

                            <span class="dropdown dropstart">
                                <button class="iconBtn" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu dropdownLeft" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </span>                            
                        </div>
                    </div>
                    <div class="proTextArea">
                        
                        <h5 class="proTitle">About me</h5>

                        <p class="proDes">{{$user->about_me}}</p>

                        
                        <h5 class="proTitle">Skills</h5>
                        <div class="exTag mt-3 mb-0">
                            @if(!empty($user->details->skill_id))
                            <?php
                                $sub_cat = explode(",", $user->details->skill_id);

                                foreach ($sub_cat as $subc) {
                                    $sub_cats = \App\Models\TranslationCategory::where('category_id', '=', $subc)->where('status', '=', '1')->first();
                                ?>
                                    <a href="#">{{ $sub_cats->category_name}}</a>
                                <?php
                                }
                            ?>
                            @else
                            <p>N/A</p>
                            @endif
                            
                            {{-- <a href="#">Adipiscing</a>
                            <a href="#">Bibe</a>
                            <a href="#">Erat</a>
                            <a href="#">Venenis Ligula Dui</a>
                            <a href="#">Elit</a>
                            <a href="#">Praesent</a>
                            <a href="#">Eleifend </a> --}}
                        </div>
                    </div>
                    <div class="proVerified">
                        
                                <div class="verifiedBox d-flex align-items-center">
                                    <div class="veriIcon">
                                        <i class="icofont-id"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <h5>Personal ID</h5>
                                        @php
                                        $identity=App\Models\UserVerification::where('user_id',$user->id)->where('identity','1')->first();
                                        @endphp
                                        @if(!empty($identity))
                                        <p><i class="icofont-check"></i>verified</p>
                                        @else
                                        <p><i class="icofont-close-circled"></i>Unverified</p>
                                        @endif
                                        
                                    </div>
                                </div>
                            
                                <div class="verifiedBox d-flex align-items-center">
                                    <div class="veriIcon">
                                        <i class="icofont-envelope"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <h5>E-mail</h5>
                                        @php
                                        $identity=App\Models\UserVerification::where('user_id',$user->id)->where('email_address','1')->first();
                                        @endphp
                                        @if(!empty($identity))
                                        <p><i class="icofont-check"></i>verified</p>
                                        @else
                                        <p><i class="icofont-close-circled"></i>Unverified</p>
                                        @endif
                                    </div>
                                </div>
                            
                            
                                <div class="verifiedBox d-flex align-items-center">
                                    <div class="veriIcon">
                                        <i class="icofont-phone"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <h5>Documents</h5>
                                        @php
                                        $identity=App\Models\UserVerification::where('user_id',$user->id)->where('documents','1')->first();
                                        @endphp
                                        @if(!empty($identity))
                                        <p><i class="icofont-check"></i>verified</p>
                                        @else
                                        <p><i class="icofont-close-circled"></i>Unverified</p>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="verifiedBox d-flex align-items-center">
                                    <div class="veriIcon">
                                        <i class="fa-brands fa-google"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <h5>Google</h5>
                                        @php
                                        $identity=App\Models\UserVerification::where('user_id',$user->id)->where('email_address','1')->first();
                                        @endphp
                                        @if(!empty($identity))
                                        <p><i class="icofont-check"></i>verified</p>
                                        @else
                                        <p><i class="icofont-close-circled"></i>Unverified</p>
                                        @endif
                                    </div>
                                </div>
                           
                        
                    </div>
                    <div class="proTextArea">
                        <h5 class="proTitle mb-3">Service Categories</h5>
                        @if(!empty($user->details->category_id))
                        @php
                        $category_id=explode(",", $user->details->category_id);
                        @endphp
                        @foreach($category_id as $cat)
                        @php
                        $category=App\Models\Category::find($cat);
                        @endphp
                        <div class="d-flex align-items-center titleWithIcon">
                            <div class="titleIcon">
                                <img src="{{$category->image}}" style="height:20px;width:20px">
                                {{-- <i class="icofont-repair"></i> --}}
                            </div>
                            <div>
                                <h6>{{$category->translation_cat->category_name}}</h6>
                            </div>
                        </div>
                        @php
                        $sub_category=App\Models\Category::where('parent_id',$category->id)->get();
                        $skill_id=explode(",", $user->details->skill_id);
                        @endphp
                        <div class="seviceCatList">
                            @foreach($sub_category as $sub)
                            @foreach($skill_id as $skill)
                            <div class="seviceCatListItem {{($skill==$sub->id) ? '':'d-none'}}">
                                <div>
                                    <p>{{$sub->translation_cat->category_name}}</p>
                                </div>
                                {{-- <div>
                                    <p class="scliLast">Performed 25 tasks</p>
                                </div> --}}
                            </div>
                            @endforeach
                            @endforeach
                            {{-- <div class="seviceCatListItem">
                                <div>
                                    <p>Washers and dryers</p>
                                </div>
                                <div>
                                    <p class="scliLast">performed 15 tasks</p>
                                </div>
                            </div>
                            <div class="seviceCatListItem">
                                <div>
                                    <p>Dishwashers</p>
                                </div>
                                <div>
                                    <p class="scliLast">no performed tasks</p>
                                </div>
                            </div>
                            <div class="seviceCatListItem">
                                <div>
                                    <p>Electric cookers and panels</p>
                                </div>
                                <div>
                                    <p class="scliLast">no performed tasks</p>
                                </div>
                            </div>
                            <div class="seviceCatListItem">
                                <div>
                                    <p>Gas stoves</p>
                                </div>
                                <div>
                                    <p class="scliLast">performed 5 tasks</p>
                                </div>
                            </div>
                            <div class="seviceCatListItem">
                                <div>
                                    <p>Oven</p>
                                </div>
                                <div>
                                    <p class="scliLast">performed 4 tasks</p>
                                </div>
                            </div>
                            <div class="seviceCatListItem">
                                <div>
                                    <p>Air conditioning equipment</p>
                                </div>
                                <div>
                                    <p class="scliLast">performed 15 tasks</p>
                                </div>
                            </div> --}}
                            
                        </div>
                        @endforeach
                        @endif
                        

                        
                    </div>
                    <div class="reviewHeader d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="m-0">Reviews</h4>
                        </div>
                        <div>
                            <div class="dropdown">
                                <button class="btn btnRecent" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Most recent <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href="#">Action</a></li>
                                  <li><a class="dropdown-item" href="#">Another action</a></li>
                                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>

                    <div class="reviewBox">
                        @php
                        $reviewss=App\Models\Review::where('client_id',$user->id)->where('status','1')->get();
                        @endphp
                        @if(count($reviewss)>0)
                        @foreach($reviewss as $reviews)
                        <div class="reviewList">
                            <h5>{{$reviews->user->name}}</h5>
                            <p class="reviewDate"><i class="fa fa-star" aria-hidden="true"></i> {{$reviews->score}} <span>{{!empty($reviews->created_at) ? date('jS M Y',strtotime($reviews->created_at)) : 'N/A'}}</span></p>
                            <p class="reviewText">{{$reviews->message}}</p>
                        </div>
                        @endforeach
                        @else
                        <span class="reviewRate">(Not Found)</span>
                        @endif
                        

                        {{-- <div class="reviewList">
                            <h5>Ronald Fortin</h5>
                            <p class="reviewDate"><i class="fa fa-star" aria-hidden="true"></i> 4.5 <span>12th May 2022</span></p>
                            <p class="reviewText">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                        </div>

                        <div class="reviewList">
                            <h5>Stuart Maxwell</h5>
                            <p class="reviewDate"><i class="fa fa-star" aria-hidden="true"></i> 4.5 <span>12th May 2022</span></p>
                            <p class="reviewText">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren</p>
                        </div>

                        <div class="reviewList">
                            <h5>William Clevenger</h5>
                            <p class="reviewDate"><i class="fa fa-star" aria-hidden="true"></i> 4.5 <span>12th May 2022</span></p>
                            <p class="reviewText">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod.</p>
                        </div>

                        <div class="text-center pt-2 pb-2">
                            <a class="exShowMore" href="#">More Reviews</a>
                        </div> --}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


</section>
@stop