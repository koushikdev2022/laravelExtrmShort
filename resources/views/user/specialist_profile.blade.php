@extends('layouts.main')
@section('content')
<div class="container backButton">
    <a class="btn-site btn-normal-outline me-2" href="{{ Route('user.dashboard') }}"><i class="icofont-simple-left"></i> Back To Listing</a>
</div>
<section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="proLeft">
                    <div class="ppProfile">
                        <div class="d-flex">
                            <div>
                                <img src="{{ URL::asset('storage/frontend/assets/images/profile/pro3.jpg') }}" alt="">
                            </div>
                            <div class="flex-fill">
                                <h5>Zane Bowen</h5>
                                <p class="u-online"><i class="fa-solid fa-circle"></i> Online</p>
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
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn-site btn-normal btn-block">Assign a Task</button>
                                </div>
                                <div class="col-6">
                                    <a href="{{ Route('user.message') }}"><button class="btn-site btn-normal btn-block"><i class="icofont-chat"></i> Message</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ppDetails">
                        <div class="d-flexx">
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="icofont-user-suited"></i></span>
                                    <h5>Age</h5>
                                    <p>24 years</p>
                                </li>
                                <li><span class="fa-li"><i class="icofont-location-pin"></i></span>
                                    <h5>From</h5>
                                    <p>Washingborough, United Kingdom</p>
                                </li>
                                <li><span class="fa-li"><i class="fa fa-language" aria-hidden="true"></i></span>
                                    <h5>Speaks</h5>
                                    <p>English</p>
                                </li>
                                <li><span class="fa-li"><i class="icofont-user-alt-7"></i></span>
                                    <h5>Member since</h5>
                                    <p>Sep 2017</p>
                                </li>
                                <li><span class="fa-li"><i class="icofont-clock-time"></i></span>
                                    <h5>Hours Available</h5>
                                    <p class="lh-base">More than 30 hrs/week <br>
                                        &lt; 24 hrs response time</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="expertDetailsBox">
                    <div class="profileDash textuper d-flex justify-content-between">
                        <div class="proItems">
                            <h5>Average hourly rate</h5>
                            <p>$20/HOUR</p>
                        </div>
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
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span class="reviewRate">(4.5)</span>
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

                        <p class="proDes">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ante leo, molestie quis odio eu, malesuada sollicitudin orci. Vivamus luctus fermentum interdum. Nam sapien est, laoreet ut ipsum sit amet, dapibus molestie lacus. Pellentesque id varius libero.</p>


                        <h5 class="proTitle">Skills</h5>
                        <div class="exTag mt-3 mb-0">
                            <a href="#">Pretiumsedpu</a>
                            <a href="#">Adipiscing</a>
                            <a href="#">Bibe</a>
                            <a href="#">Erat</a>
                            <a href="#">Venenis Ligula Dui</a>
                            <a href="#">Elit</a>
                            <a href="#">Praesent</a>
                            <a href="#">Eleifend </a>
                        </div>
                    </div>
                    <div class="proVerified">

                        <div class="verifiedBox d-flex align-items-center">
                            <div class="veriIcon">
                                <i class="icofont-id"></i>
                            </div>
                            <div class="flex-fill">
                                <h5>Personal ID</h5>
                                <p><i class="icofont-check"></i>verified</p>
                            </div>
                        </div>

                        <div class="verifiedBox d-flex align-items-center">
                            <div class="veriIcon">
                                <i class="icofont-envelope"></i>
                            </div>
                            <div class="flex-fill">
                                <h5>E-mail</h5>
                                <p><i class="icofont-check"></i>verified</p>
                            </div>
                        </div>


                        <div class="verifiedBox d-flex align-items-center">
                            <div class="veriIcon">
                                <i class="icofont-phone"></i>
                            </div>
                            <div class="flex-fill">
                                <h5>Phone</h5>
                                <p><i class="icofont-check"></i>verified</p>
                            </div>
                        </div>

                        <div class="verifiedBox d-flex align-items-center">
                            <div class="veriIcon">
                                <i class="fa-brands fa-google"></i>
                            </div>
                            <div class="flex-fill">
                                <h5>Google</h5>
                                <p><i class="icofont-check"></i>verified</p>
                            </div>
                        </div>


                    </div>
                    <div class="proTextArea">
                        <h5 class="proTitle mb-3">Service Categories</h5>

                        <div class="d-flex align-items-center titleWithIcon">
                            <div class="titleIcon">
                                <i class="icofont-repair"></i>
                            </div>
                            <div>
                                <h6>Appliance repair and installation </h6>
                            </div>
                        </div>

                        <div class="seviceCatList">
                            <div class="seviceCatListItem">
                                <div>
                                    <p>Refrigerators and freezers</p>
                                </div>
                                <div>
                                    <p class="scliLast">Performed 25 tasks</p>
                                </div>
                            </div>
                            <div class="seviceCatListItem">
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
                            </div>

                        </div>
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
                        <div class="reviewList">
                            <h5>Barbara Martin</h5>
                            <p class="reviewDate"><i class="fa fa-star" aria-hidden="true"></i> 4.5 <span>12th May 2022</span></p>
                            <p class="reviewText">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
                        </div>

                        <div class="reviewList">
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop