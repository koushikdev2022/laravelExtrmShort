@extends('layouts.master')
@section('content')
<!--INNER PAGE HERO SECTION START-->
<section class="inner-hero-section">
    <figure>
        <img src="{{ URL::asset('public/frontend/images/signup-banner.jpg') }}" alt="Banner" />
    </figure>
</section>
<!--INNER PAGE HERO SECTION END-->

<!-- SIGN UP FORM SECTION START-->
<section class="signup-section bg-gray">
    <div class="container">
        <div class="signup-wrapper" style="display:block;">
            <h3>Reset Password</h3>
            
            <form id="resetPassword" action="{{ Route('set-password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Password</label>
                    <div class="pass-holder">
                        <input type="password" name="password" placeholder="Enter password">
                        <span><i class="icofont-eye"></i><i class="icofont-eye-blocked"></i></span>
                    </div>
                    <div class=" text-danger help-block"></div>

                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="pass-holder">
                        <input type="password" name="retype_password"placeholder="Enter confirm password">
                        <span><i class="icofont-eye"></i><i class="icofont-eye-blocked"></i></span>
                    </div>
                    <div class=" text-danger help-block"></div>

                </div>
                <div class="submit-btn">
                    <input type="submit" value="Continue" />
                </div>
            </form>
        </div>
    </div>
</section>
<!-- SIGN UP FORM SECTION END-->

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