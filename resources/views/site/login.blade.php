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
            <h3>Welcome Back</h3>
            <a href="{{ Route('social.oauth','google') }}" class="signup-with-gp"><img src="{{ URL::asset('public/frontend/images/google-icon.png') }}" alt="icon" />Continue with Google</a>
            <div class="dvd"><span>Or</span></div>
            <form id="loginRequest" action="{{ Route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email" value="<?php
                                if (isset($_COOKIE['xtreme_user_email']) && $_COOKIE['xtreme_user_email'] != "") {
                                    echo $_COOKIE['xtreme_user_email'];
                                }
                                ?>" />
                    <div class=" text-danger help-block"></div>

                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="pass-holder">
                        <input type="password" name="password"  placeholder="Enter password" value="<?php
                            if (isset($_COOKIE['xtreme_user_password']) && $_COOKIE['xtreme_user_password'] != "") {
                                echo $_COOKIE['xtreme_user_password'];
                            }
                            ?>">
                        <span><i class="icofont-eye"></i><i class="icofont-eye-blocked"></i></span>
                        <div class=" text-danger help-block"></div>

                    </div>
                </div>
                <div class="form-group forgot">
                    <input type="checkbox" id="remember" name="rememberMe" <?php
                        if (isset($_COOKIE['xtreme_user_email']) && $_COOKIE['xtreme_user_password'] != "") {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    <label class="check-lbl" for="remember">Remember Me</label>
                    <p><a href="{{ Route('forgot-password') }}">Forgot Password?</a></p>
                </div>
                <div class="submit-btn">
                    <input type="submit" value="Log In" />
                </div>
                <p>Don't Have An Account?<a href="{{ Route('signup') }}">Join Now</a></p>
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