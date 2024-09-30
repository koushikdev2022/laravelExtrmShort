<div class="col-lg-9 dashboard-right">

    <div class="dash-bottom-part account_settings">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="bottom-part-2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item active"><a class="nav-link" onclick="showtabH()" href="#home-h" role="tab"
                                    aria-controls="home">Personal Details</a></li>
                            {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#portfolio-h" role="tab"
                                    aria-controls="portfolio">Portfolio Details</a></li> --}}
                            <li class="nav-item"><a class="nav-link" onclick="showtabP()" href="#profile-h" role="tab"
                                aria-controls="profile">Change Password</a></li>
                        </ul>
                        <div class="white_contentbx">
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-h" role="tabpanel">
                                    <div class="common-dash-form">
                                        <livewire:user.admin.personal-detail :user="$user" />
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile-h" role="tabpanel">
                                    <div class="common-dash-form">
                                        <livewire:user.admin.change-password :user="$user" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    function showtabH(){
        $('#home-h').addClass('active');
        $('#profile-h').removeClass('active');
        
    }
    function showtabP(){
        $('#home-h').removeClass('active');
        $('#profile-h').addClass('active');
    }
</script>