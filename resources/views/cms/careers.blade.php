@extends('layouts.master')
@section('content')
<!--banner start-->
<!-- page header title banner  -->

<!-- page header title banner  -->

<section class="py-0">
    <div class="loginHead staticnwarea">
        <div class="loginImg pageTitle">
            <div class="container text-center">
                <h1 class="heading">{{__('Careers')}}</h1>
            </div>
        </div>
    </div>
</section>

<!-- end of page header title banner -->

<section class="static_page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-right-section">
                    <div class="">
                        <form id="career-form-submit" action="{{route('post-careers')}}" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="lebel-style" for="FirstName">{{__('Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control">
                                        <span class="text-danger help-block"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="lebel-style" for="exampleInputEmail1">{{__('Email Address')}}<span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" >
                                        <span class="text-danger help-block"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="lebel-style" for="exampleInputEmail1">{{__('Mobile No.')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="phone_no" class="form-control" >
                                        <span class="text-danger help-block"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="lebel-style" for="exampleInputEmail1">{{__('Job Type')}}<span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="category_id" aria-label="Default select example">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->translation_cat->category_id}}">{{$category->translation_cat->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger help-block"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="lebel-style" for="message">{{__('Your Message')}}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="message"></textarea>
                                        <span class="text-danger help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mobcentnw">
                                <button class="btn-site btn-normal" type="submit" value="submit">
                                    {{__('Send')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
