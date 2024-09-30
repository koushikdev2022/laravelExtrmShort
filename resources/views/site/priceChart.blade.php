@extends('layouts.master')
@section('content')
<!--INNER PAGE HERO SECTION START-->
<!--<section class="inner-hero-section">
    <figure>
        <img src="{{ URL::asset('public/frontend/images/signup-banner.jpg') }}" alt="Banner" />
    </figure>
</section>-->
<section class="py-0">
    <div class="loginHead staticnwarea">
        <div class="loginImg pageTitle">
            <div class="container text-center">
                <h1 class="heading">Business Model</h1>
            </div>
        </div>
    </div>
</section>
<!--INNER PAGE HERO SECTION END-->

<!-- SIGN UP FORM SECTION START-->
<section class="staticinnerbg bg-gray">
    <div class="container">
        <!-- <div class="pp_header">
            <img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="">
        </div> -->
        <div class="col-md-8">
            {!! $data->content_body !!}
        </div>

        {{--<div class="pp_body priceareanw">
            <div class="row">
                <div class="col-lg-3">
                    <div class="pp_box">
                        <h4>Amount of video determined by create</h4>
                    </div>
                    <h5 class="text-center mt-3">X</h5>
                </div>
                <div class="col-lg-1">
                    <div class="plus_ico">
                            <i class="icofont-plus"></i>
                        </div>
                </div>
                <div class="col-lg-3">
                    <div class="pp_box">
                        <h4>Broadcast license* type determined by client for a period of 12 months</h4>
                    </div>
                    <h5 class="text-center mt-3">Y</h5>
                </div>
                <div class="col-lg-1">
                    <div class="plus_ico">
                            <i class="icofont-plus"></i>
                        </div>
                </div>
                <div class="col-lg-3">
                    <div class="pp_box">
                        <h4>Commissions**<br>
                        Xterme long shot</h4>
                    </div>
                    <h5 class="text-center mt-3">Z</h5>
                </div>
            </div>
            <div class="row justify-content-center margin_tt mrgcstnw">
                <div class="col-lg-6 text-center">
                    <div class="pp_box">
                    <h5 class="mb-2">Education and Training : 2%</h5>
                    <h5 class="mb-2">Internal organization : 3%</h5>
                    <h5 class="mb-2">Social media and websites : 5%</h5>
                    <h5 class="mb-2">TV, docu, features and gaming : 8</h5>
                    <h5 class="mb-2">Other : Check each case separately</h5>
                    </div>
                </div>

            </div>
        </div>--}}
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