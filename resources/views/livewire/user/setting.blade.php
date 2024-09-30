<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="bottom-part-2">
                        <div class="dash_headingbx">
                            <h2 class="dash_heading pl-0">Settings</h2>
                        </div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link {{$tab=='profile'?'active':''}}" data-toggle="tab"
                                    href="#home-h" role="tab" aria-controls="home">Personal Details</a></li>
                            {{-- <li class="nav-item"><a class="nav-link {{$tab=='portfolio'?'active':''}}" data-toggle="tab"
                                    href="#portfolio-h" role="tab" aria-controls="portfolio">Portfolio Details</a></li> --}}
                            {{-- @if(!empty(auth()->guard('frontend')->user()->email))
                            <li class="nav-item">
                                <a class="nav-link {{$tab=='payment'?'active':''}}" data-toggle="tab" href="#payment-h"
                                    role="tab" aria-controls="Payment">Payment Settings</a>
                            </li>
                            @endif --}}
                            {{-- @if(auth()->guard('frontend')->user()->login_type==='0') --}}
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-h" role="tab"
                                    aria-controls="profile">Change Password</a></li>
                            {{-- @endif --}}
                        </ul>
                        <div class="white_contentbx">
                            <div class="tab-content">
                                <div class="tab-pane {{$tab=='profile'?'active':''}}" id="home-h" role="tabpanel">
                                    <div class="common-dash-form left_bx common-section-box mb-3">
                                        <livewire:user.personal-detail />
                                    </div>
                                </div>
                                {{-- <div class="tab-pane {{$tab=='portfolio'?'active':''}}" id="portfolio-h"
                                    role="tabpanel">
                                    <div class="common-dash-form">
                                        <livewire:user.portfolio-detail />
                                    </div>
                                </div> --}}
                                {{-- @if(!empty(auth()->guard('frontend')->user()->email))
                                <div class="tab-pane {{$tab=='payment'?'active':''}}" id="payment-h" role="tabpanel">
                                    <div class="common-dash-form">
                                        <livewire:user-payment.setting />
                                    </div>
                                </div>
                                @endif --}}
                                {{-- @if(auth()->guard('frontend')->user()->login_type==='0') --}}
                                <div class="tab-pane" id="profile-h" role="tabpanel">
                                    <div class="common-dash-form left_bx common-section-box mb-3">
                                    <livewire:user.change-password />
                                    </div>
                                </div>
                                {{-- @endif --}}

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>