@extends('layouts.master')
@section('content')
<!-- page header title banner  -->

<!-- page header title banner  -->

<section class="py-0">
    <div class="loginHead staticnwarea">
        <div class="loginImg pageTitle">
            <div class="container text-center">
                <h1 class="heading">{{__('Testimonials')}}</h1>
            </div>
        </div>
    </div>
</section>

<!-- end of page header title banner -->

<section class="static_page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="testiCard">
                    <img class="qu" src="{{URL::asset('storage/frontend/assets/images/icons/testi.png') }}" alt="">
                    <p class="testiText"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nost rud
                        exercitation ullamco laboris nisi ut aliquip commodo.</p>
                    <div class="d-flex">
                        <div><img class="profile" src="assets/images/profile/pro2.png" alt=""></div>
                        <div class="flex-fill">
                            <h5 class="cardName">Harry J. Walker</h5>
                            <div class="testiStar">
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testiLocation">
                        <p><i class="fa-solid fa-location-dot"></i> Advaxis, California</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testiCard">
                    <img class="qu" src="{{URL::asset('storage/frontend/assets/images/icons/testi.png') }}" alt="">
                    <p class="testiText"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nost rud
                        exercitation ullamco laboris nisi ut aliquip commodo.</p>
                    <div class="d-flex">
                        <div><img class="profile" src="assets/images/profile/pro2.png" alt=""></div>
                        <div class="flex-fill">
                            <h5 class="cardName">Willie Thompson</h5>
                            <div class="testiStar">
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testiLocation">
                        <p><i class="fa-solid fa-location-dot"></i> Advaxis, California</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testiCard">
                  <img class="qu" src="{{URL::asset('storage/frontend/assets/images/icons/testi.png') }}" alt="">
                    <p class="testiText"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nost rud
                        exercitation ullamco laboris nisi ut aliquip commodo.</p>
                    <div class="d-flex">
                        <div><img class="profile" src="assets/images/profile/pro2.png" alt=""></div>
                        <div class="flex-fill">
                            <h5 class="cardName">Harry J. Walker</h5>
                            <div class="testiStar">
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testiLocation">
                        <p><i class="fa-solid fa-location-dot"></i> Advaxis, California</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testiCard">
                    <img class="qu" src="{{URL::asset('storage/frontend/assets/images/icons/testi.png') }}" alt="">
                    <p class="testiText"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nost rud
                        exercitation ullamco laboris nisi ut aliquip commodo.</p>
                    <div class="d-flex">
                        <div><img class="profile" src="assets/images/profile/pro2.png" alt=""></div>
                        <div class="flex-fill">
                            <h5 class="cardName">Willie Thompson</h5>
                            <div class="testiStar">
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                                <i class="icofont-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testiLocation">
                        <p><i class="fa-solid fa-location-dot"></i> Advaxis, California</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
