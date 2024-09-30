@extends('layouts.master')
@section('content')
<!--banner start-->
<!-- page header title banner  -->

<section class="py-0">
    <div class="loginHead staticnwarea">
        <div class="loginImg pageTitle">
            <div class="container text-center">
                <h1 class="heading">{{__('Help & Support')}}</h1>
            </div>
        </div>
    </div>
</section>

<!-- end of page header title banner -->
<!-- ======= Contact Section ======= -->
<section class="static_page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="left-contact-inner contact-left-section">
                    <h2>{{__('Help & Support 24/7')}}</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et dignissim justo. Curabitur at ultrices</p>
                    <div class="media">
                        <span class=" mr-3"><i class="icofont-phone"></i></span>
                        <div class="media-body align-self-center">
                            <h4>{{__('Call Us')}}</h4>
                            <h5>{{$settings[0]->value}}</h5>
                        </div>
                    </div>
                    <div class="media">
                        <span class=" mr-3"><i class="icofont-envelope"></i></span>
                        <div class="media-body align-self-center">
                            <h4>{{__('Send us an email')}}</h4>
                            <a href="mailto:{{$settings[1]->value}}">{{$settings[1]->value}}</a>
                        </div>
                    </div>
                    <div class="media">
                        <span class=" mr-3"><i class="icofont-location-pin"></i></span>
                        <div class="media-body align-self-center">
                            <h5>{{$settings[2]->value}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-right-section">
                    <div class="">
                        <form  id="contact-us-form-submit" action="{{route('post-contact-us')}}" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="lebel-style" for="FirstName">{{__('Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="lebel-style" for="exampleInputEmail1">{{__('Email Address')}}<span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control right-icon" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="lebel-style" for="exampleInputEmail1">{{__('Subject')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="subject" class="form-control right-icon" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="lebel-style" for="message">{{__('Your Message')}}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="message"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <button class="btn-site btn-normal" type="submit" value="submit">
                                {{__('Send')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- map -->

{{-- <section>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4022692.3496186216!2d-101.99905089623454!3d38.603301476192385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sin!4v1661151269411!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section> --}}
@stop
