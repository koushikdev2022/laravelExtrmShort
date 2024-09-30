<div class="dash-bottom-part pb-0 ">
    <div class="col-md-12">
        <div class="processCard">

            <div class="processBody">
                <div class="ppProfile sideProfile bg-white p-4 border-bottom pb-4">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="d-flex">
                                <div>
                                    <a class="aNone" href="#">
                                        <img src="{{($bids->user->profile_picture != '') ? asset('storage/uploads/frontend/profile_picture/original/'.$bids->user->profile_picture) : asset('storage/frontend/images/profile/dummyProfile.jpg')}}" onerror="this.onerror=null;this.src='{{asset("storage/frontend/images/profile/dummyProfile.jpg")}}';" alt="">
                                    </a>
                                </div>
                                <div class="flex-fill">
                                    <a class="aNone" href="#">
                                        <h5>{{$bids->user->name}}</h5>
                                    </a>

                                    @if(!empty($bids->user->timezone))
                                    @php
                                    $diff=0;
                                    $date1 = new DateTime("now", new DateTimeZone($bids->user->timezone) );
                                    @endphp
                                    @endif

                                    <p>
                                        <small><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            {{!empty($bids->user->countryDetail->country_name) ?
                                            $bids->user->countryDetail->country_name: 'N/A'}}
                                            @if(!empty($bids->user->timezone))
                                            - {{$date1->format('h:i a')}} local time
                                            @endif
                                        </small>
                                    </p>


                                    <p class="giStatus"><i class="fa fa-bolt" aria-hidden="true"></i> Available now</p>
                                    <a class="greenLink" href="#">View Profile</a>
                                    <div class="d-flex">
                                        <div>
                                            <h5>80%</h5>
                                            <div class="progressMain smProgress">
                                                <!-- <div class="progress-bar">
                                                    <div data-size="80" class="progress" style="width: 80%;"></div>
                                                </div> -->
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <h6><small>Job success</small></h6>
                                        </div>
                                        <div class="ml-5 mt-4">
                                            <p class="text-muted"><small><i class="fa fa-star" aria-hidden="true"></i>
                                                    TOP RATED PLUS</small></p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        @if(Auth()->guard('frontend')->user()->type_id==2)
                        <div class="col-md-4 text-center mHireBtn">
                            @if($bids->status==0)
                            <div> <a href="{{route('user.accept-proposal-award',base64_encode($bids->id))}}"
                                     class="btn btn_site btn_fixed ">Hire Talent</a></div>
                            @elseif($bids->status==1)
                            {{-- <div> <a href="{{route('user.view-award-contract',base64_encode($bids->id))}}"
                                     class="btn btn_site btn_fixed ">View milestone</a></div> --}}
                                     <div> <a href="#" class="btn btn_site btn_fixed ">Hired</a></div>
                            @endif
                            <div> <a href="{{route('user.messages',base64_encode($bids->user->id))}}" wire:click="message({{$bids->user->id}})"
                                     class="btn btn_site btn_fixed mt-4">Message</a></div>
                        </div>
                        @endif
                    </div>

                </div>


                <div class="mt-4">
                    <div class="text-center mt-4 mb-4">
                        <h4>{{$bids->project->title}}</h4>
                    </div>
                    <div class="row mRow_reverse">
                        <div class="col-md-9">
                            <h4 class="ppTitleBold">Proposal Details :</h4>
                            {{$bids->proposal}}
                        </div>
                        <div class="col-md-3 orderF">
                            <div class="text-center">
                                <h3 class="m-0">${{$bids->budget_details->billable_target}}</h3>
                                <p>Proposed Bid</p>
                            </div>
                        </div>
                    </div>

                    <h4 class="ppTitleBold">Proposal Files:</h4>
                    @php
                    $bid_files=App\Models\BidFile::where('bid_id',!empty($bids->id) ? $bids->id : '')->where('status','1')->get();
                    @endphp
                    @foreach ($bid_files as $bid_file)
                    @php
                    $file_t=explode(".",$bid_file->file);
                    $file_type=end($file_t);
                    @endphp
                    @if($file_type=='png' || $file_type=='jpeg' || $file_type=='jpg' || $file_type=='gif')

                    <a href="{{asset('storage/uploads/frontend/proposal/'.$bid_file->file)}}" target="_blank">
                        <div class="dltImg">
                            <img src="{{asset('storage/uploads/frontend/proposal/'.$bid_file->file)}}" class="w-100">
                            {{-- <a onclick="file_delete({{$bid_file->id}})"><i class="fa-solid fa-xmark"></i></a> --}}
                </div>
                </a>
                @else
                <a href="{{asset('storage/uploads/frontend/proposal/'.$bid_file->file)}}" target="_blank">
                    <div class="dltImg">
                        <img src="{{asset('storage/frontend/images/file.png')}}">

                        {{-- <a onclick="file_delete({{$bid_file->id}})"><i class="fa-solid fa-xmark"></i></a> --}}
            </div>
            </a>
            @endif

            @endforeach
            {{-- <h4 class="ppTitleBold">Cover Letter :</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                but also                the leap into electronic typesetting, remaining essentially unchanged. It was
                popularised in t                he 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                and more recently with d                esktop publishing software like Aldus PageMaker including versions of
                Lorem Ipsum.</p> --}}
            @if($bids->project->job_type=='IT Projects' || $bids->project->job_type=='Business & Robotics Automation' || $bids->project->job_type=='Website, Mobile & Software Development')
            <h4 class="ppTitleBold">Describe your recent & relevant experience with similar projects :</h4>
            <p>{{$bids->describe_recent_project}}</p>

            <h4 class="ppTitleBold">Include a link to your profile and/or website :</h4>
            @php
            $links=explode(",",$bids->project_link)
            @endphp
            @foreach ($links as $link)
            <a class="greenLink" href="{{$link}}"><i class="fa fa-link" aria-hidden="true"></i> {{$link}}</a>
            @endforeach

            <h4 class="ppTitleBold">Describe your approach to development, testing and improving QA :</h4>
            <p>{{$bids->describe_qa}}</p>
            @endif
        </div>
    </div>

</div>

<!-- page One  -->
{{-- <div class="processCard">

    <div class="processBody">
        <div class="ppProfile sideProfile bg-white p-0 border-bottom pb-4">
            <div class="row">
                <div class="col-lg-6">

                    <div class="d-flex">
                        <div>
                            <a class="aNone" href="#">
                                <img class="logo"
                                     src="{{asset('storage/frontend/images/profile/dummyProfile.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="flex-fill">
                            <a class="aNone" href="#">
                                <h5>adam smit</h5>
                            </a>
                            <p><small><i class="fa fa-map-marker" aria-hidden="true"></i> Angola - 06:19 pm
                                    local
                                    time</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center nwstlbx mHireBtn">
                    <a href="#" class="btn btn_site btn_fixed">Pay Now</a>
                    <a href="#" class="btn btn_site btn_fixed bdr">Give Bonus</a>
                    <a href="#" class="btn btn_site btn_fixed bdr">Cancel Contract</a>
                </div>
            </div>
        </div>


        <div class="usermilestone_details tabdisplay">
            <ul class="nav nav-tabs px-0" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-one" role="tab"
                                        aria-controls="home">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-two" role="tab"
                                        aria-controls="profile">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-three" role="tab"
                                        aria-controls="home">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-four" role="tab"
                                        aria-controls="profile">Navlink</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-one" role="tabpanel">
                    <div class="proSecLeft dashmilestone under_tab">
                        <div class="proType d-flex justify-content-between">
                            <div class="proItems">
                                <h5>Budget</h5>
                                <p>$200.00</p>
                            </div>
                            <div class="proItems">
                                <h5>In Escrow</h5>
                                <p>$200.00</p>
                            </div>
                            <div class="proItems">
                                <h5>Milestone Paid</h5>
                                <p>$200.00</p>
                            </div>
                            <div class="proItems">
                                <h5>Remaning</h5>
                                <p>$200.00</p>
                            </div>
                            <div class="proItems">
                                <h5>Budget</h5>
                                <p>$1000</p>
                            </div>
                            <div class="proItems">
                                <h5>Total Payments</h5>
                                <p>$1000</p>
                            </div>
                        </div>
                        <div class="top_headingbx cstnw">
                            <h1 class="ppTitleBold">Remaining Milestone</h1>
                            <a href="#" class="btn btn_site bdr" data-toggle="modal"
                               data-target="#exampleModal">Add or edit milestone</a>
                        </div>

                        <div class="milestone_listgrp">
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet<span
                                                class="milestn_active">ACTIVE</span></h2>
                                        <p class="money">$30.00(Funded)</p>
                                    </div>
                                    <div class="datebx">
                                        <h2>Due Jan 24</h2>
                                    </div>
                                    <a href="#" class="btn btn_site">Pay Now</a>
                                </div>
                            </div>
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet</h2>
                                        <p class="money">$30.00(Funded)</p>
                                    </div>
                                    <div class="datebx">
                                        <h2>Due Jan 24</h2>
                                    </div>
                                    <a href="#" class="btn btn_site">Pay Now</a>
                                </div>
                            </div>
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet</h2>
                                        <p class="money">$30.00(Funded)</p>
                                    </div>
                                    <div class="datebx">
                                        <h2>Due Jan 24</h2>
                                    </div>
                                    <a href="#" class="btn btn_site">Pay Now</a>
                                </div>
                            </div>
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet</h2>
                                        <p class="money">$30.00(Funded)</p>
                                    </div>
                                    <div class="datebx">
                                        <h2>Due Jan 24</h2>
                                    </div>
                                    <a href="#" class="btn btn_site">Pay Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-two" role="tabpanel">

                </div>
                <div class="tab-pane" id="tab-three" role="tabpanel">

                </div>
                <div class="tab-pane" id="tab-four" role="tabpanel">

                </div>
            </div>
        </div>
    </div>

</div>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contract change</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Remaining milestones</h6>
                    </div>
                    <div>
                        <a class="btn btn_site btn_fixed text-white" data-toggle="modal" data-target="#exampleModalnew">Add Milestone</a>
                    </div>
                </div>

                <table class="table border-top mt-4 myModalList">
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <p class="pText">Create a mockup</p>

                                <small class="text-muted">$30.00 (Funded)</small>
                            </td>
                            <td>
                                <small class="text-muted">Due Jun 24</small>
                            </td>
                            <td class="text-right">
                                <a class="aGreenLink" href="#">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <p class="pText">Create Design</p>

                                <small class="text-muted">$140.00</small>
                            </td>
                            <td>
                                <small class="text-muted">Due Jul 1</small>
                            </td>
                            <td class="text-right">
                                <a class="outlineCircle" href="#"><i class="fa fa-pencil"
                                                                     aria-hidden="true"></i></a>
                                <a class="outlineCircle" href="#"><i class="fa fa-trash"
                                                                     aria-hidden="true"></i></a>

                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <p class="pText">Additional feedback</p>

                                <small class="text-muted">$30.00</small>
                            </td>
                            <td>
                                <small class="text-muted">Due Jul 1</small>
                            </td>
                            <td class="text-right">
                                <a class="outlineCircle" href="#"><i class="fa fa-pencil"
                                                                     aria-hidden="true"></i></a>
                                <a class="outlineCircle" href="#"><i class="fa fa-trash"
                                                                     aria-hidden="true"></i></a>

                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Message <span
                            class="text-muted">(Optional)</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- new -->



<!-- page Two  -->
<div class="processCard">

    <div class="processBody">
        <div class="ppProfile sideProfile bg-white p-0 border-bottom pb-4">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Build Responsive portfolio website with payment</h5>
                    <small class="text-muted">Active since feb 16, 2022</small>
                </div>
                <div class="col-lg-6">

                    <div class="d-flex">
                        <div>
                            <a class="aNone" href="#">
                                <img class="logo"
                                     src="{{asset('storage/frontend/images/profile/dummyProfile.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="flex-fill">
                            <a class="aNone" href="#">
                                <h5>adam smit</h5>
                            </a>
                            <p><small><i class="fa fa-map-marker" aria-hidden="true"></i> Angola - 06:19 pm
                                    local
                                    time</small></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <div class="usermilestone_details tabdisplay">
            <ul class="nav nav-tabs px-0" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-one1" role="tab"
                                        aria-controls="home">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-two2" role="tab"
                                        aria-controls="profile">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-three3" role="tab"
                                        aria-controls="home">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-four4" role="tab"
                                        aria-controls="profile">Navlink</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-one1" role="tabpanel">
                    <div class="proSecLeft dashmilestone under_tab">

                        <div class="top_headingbx cstnw">
                            <h1 class="ppTitleBold">Remaining Milestone</h1>
                        </div>

                        <div class="milestone_listgrp">
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet<span
                                                class="milestn_active">ACTIVE</span></h2>
                                        <p class="money text-muted">Due Jan 24</p>
                                    </div>
                                    <a href="#" class="btn btn_site" data-toggle="modal"
                                       data-target="#exampleModal5">Submit Work for Payment</a>
                                </div>
                            </div>
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet</h2>
                                        <p class="money text-muted">Due Jan 24</p>
                                    </div>
                                    <a href="#" class="btn btn_site" data-toggle="modal"
                                       data-target="#exampleModal5">Submit Work for Payment</a>
                                </div>
                            </div>
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet</h2>
                                        <p class="money text-muted">Due Jan 24</p>
                                    </div>
                                    <a href="#" class="btn btn_site" data-toggle="modal"
                                       data-target="#exampleModal5">Submit Work for Payment</a>
                                </div>
                            </div>
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet</h2>
                                        <p class="money text-muted">Due Jan 24</p>
                                    </div>
                                    <a href="#" class="btn btn_site" data-toggle="modal"
                                       data-target="#exampleModal5">Submit Work for Payment</a>
                                </div>
                            </div>
                            <div>
                                <a href="#" class="greenLink">Show more</a>
                            </div>

                            <div id="accordion" class="accordion">
                                <div class="card mb-0">
                                    <div class="card-header collapsed" data-toggle="collapse"
                                         href="#collapseOne">
                                        <a class="card-title ac_title"> Completed milestones (4) </a>
                                    </div>
                                    <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                            terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                            skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                            single-origin coffee nulla assumenda shoreditch et. Nihil anim
                                            keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                            sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                            occaecat craft beer farm-to-table, raw denim aesthetic synth
                                            nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS. </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-two2" role="tabpanel">

                </div>
                <div class="tab-pane" id="tab-three3" role="tabpanel">

                </div>
                <div class="tab-pane" id="tab-four4" role="tabpanel">

                </div>
            </div>
        </div>
    </div>

</div>
<!-- </div>
</div> -->



<!-- Modal -->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submit work or request
                    payment for a milestone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p class="text-muted">Use this form to request qpproval for the work you've
                    completed. Your payment will be released upon approval.</p>
                <p class="m-0">Milestone</p>
                <p class="text-muted">5 (Due May4)</p>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              placeholder="Descibe the work you've completed for this milestone"></textarea>
                    <small class="text-muted">Attaching work is recommended, but not required if
                        your've already delivered work.</small>
                </div>



                <div class="mt-3">
                    <input type="file" id="upload" hidden>
                    <label class="uploadLabel" for="upload"><i class="icofont-paper-clip"></i> Upload</label>
                    <span class="text-muted ml-2">Up to 25 MB</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="dash_btn_outline mr-3" data-dismiss="modal">Cancel</button>
                <button type="button" class="dash_btn_green">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- new -->

<div class="modal fade" id="exampleModalnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add/Edit Milestone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Milestone Name</label>
                    <input type="text" class="form-control" aria-describedby="milestone_name">
                </div>
                <div class="form-group">
                    <label>Deadline</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Milestone Budget</label>
                    <div class="input-group right_input">
                        <input type="number" class="form-control groupInput">
                        <span class="input-group-text"><i class="icofont-dollar"></i></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="dash_btn_outline mr-3" data-dismiss="modal">Cancel</button>
                <button type="button" class="dash_btn_green">Submit</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Milestone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p class="text-muted">Use this form to request qpproval for the work you've
                    completed. Your payment will be released upon approval.</p>
                <p class="m-0">Milestone</p>
                <p class="text-muted">5 (Due May4)</p>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              placeholder="Descibe the work you've completed for this milestone"></textarea>
                    <small class="text-muted">Attaching work is recommended, but not required if
                        your've already delivered work.</small>
                </div>



                <div class="mt-3">
                    <input type="file" id="upload" hidden>
                    <label class="uploadLabel" for="upload"><i class="icofont-paper-clip"></i> Upload</label>
                    <span class="text-muted ml-2">Up to 25 MB</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="dash_btn_outline mr-3" data-dismiss="modal">Cancel</button>
                <button type="button" class="dash_btn_green">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- page three  -->
<div class="processCard">

    <div class="processBody">
        <div class="ppProfile sideProfile bg-white p-0 border-bottom pb-4">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Make updates and extensions on my website</h5>
                    <small class="text-muted">Active since feb 16, 2022</small>
                </div>
                <div class="col-lg-6">

                    <div class="d-flex">
                        <div>
                            <a class="aNone" href="#">
                                <img class="logo" src="{{asset('storage/frontend/images/profile/dummyProfile.jpg')}}"
                                     alt="">
                            </a>
                        </div>
                        <div class="flex-fill">
                            <a class="aNone" href="#">
                                <h5>adam smit</h5>
                            </a>
                            <p><small><i class="fa fa-map-marker" aria-hidden="true"></i> Angola - 06:19 pm
                                    local time</small></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="usermilestone_details tabdisplay">
            <ul class="nav nav-tabs px-0" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-one1" role="tab"
                                        aria-controls="home">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-two2" role="tab"
                                        aria-controls="profile">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-three3" role="tab"
                                        aria-controls="home">Navlink</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-four4" role="tab"
                                        aria-controls="profile">Navlink</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-one1" role="tabpanel">
                    <div class="proSecLeft dashmilestone under_tab">

                        <div class="top_headingbx cstnw">
                            <h1 class="ppTitleBold">Remaining Milestone</h1>
                        </div>

                        <div class="milestone_listgrp">
                            <div class="milestone_list">
                                <div class="media">
                                    <h1 class="number">1</h1>
                                    <div class="media-bodytopv">
                                        <h2 class="namearea">Lorem ipsum dolor sit amet<span
                                                class="milestn_active">SUBMITTED</span></h2>
                                        <p class="money text-muted">Due Jan 24</p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="#" class="btn btn_site minWidth" data-toggle="modal"
                                           data-target="#exampleModal6">Resubmit</a><br>
                                        <a href="#" class="btn btn_site btn_fixed bdr minWidth">View Submission</a>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-two2" role="tabpanel">

                </div>
                <div class="tab-pane" id="tab-three3" role="tabpanel">

                </div>
                <div class="tab-pane" id="tab-four4" role="tabpanel">

                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Work Submissions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table border-top mt-4 myModalList">
                    <tbody>
                        <tr>
                            <th>Submitted </th>
                            <th>Message </th>
                            <th class="text-right">Attachment </th>
                        </tr>
                        <tr>
                            <td>
                                <small class="text-muted">4 Days ago</small>
                            </td>
                            <td>
                                <p class="pText">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p>

                            </td>

                            <td class="text-right">
                                <a class="aGreenLink" href="#">View</a>
                            </td>
                        </tr>

                        <tr>
                            <th>Submitted </th>
                            <th>Message </th>
                            <th class="text-right">Attachment </th>
                        </tr>
                        <tr>
                            <td>
                                <small class="text-muted">4 Days ago</small>
                            </td>
                            <td>
                                <p class="pText">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</p>

                            </td>

                            <td class="text-right">
                                -
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="dash_btn_outline mr-3" data-dismiss="modal">Cancel</button>
                <button type="button" class="dash_btn_green">Submit</button>
            </div>
        </div>
    </div>
</div>  --}}

<!-- new -->





</div> <!-- col-md-12 -->
</div>
