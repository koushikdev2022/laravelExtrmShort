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
            <h3>Sign Up</h3>
            <a href="{{ Route('social.oauth','google') }}" class="signup-with-gp"><img src="{{ URL::asset('public/frontend/images/google-icon.png') }}" alt="icon" />Continue with Google</a>
            <div class="dvd"><span>Or</span></div>
            <form id="signupRequest" action="{{ Route('signup') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter name" />
                    <div class=" text-danger help-block"></div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email" />
                    <div class=" text-danger help-block"></div>
                </div>
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
                        <input type="password" name="confirm_password" placeholder="Re-enter password">
                        <span><i class="icofont-eye"></i><i class="icofont-eye-blocked"></i></span>
                    </div>
                    <div class=" text-danger help-block"></div>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="agree" name="check_policy" />
                    <label class="check-lbl" for="agree">Creating an account means you’re okay with our <a href="{{ Route('terms-and-conditions')}}">Terms & Conditions</a> & <a href="{{ Route('privacy-policy')}}">Privacy Policy</a>.</label>
                    <div class=" text-danger help-block"></div>
                </div>
                <div class="submit-btn">
                    <input type="submit" value="sign up" />
                </div>
                <p>Already Have An Account? <a href="{{ Route('login') }}">Log In</a></p>
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