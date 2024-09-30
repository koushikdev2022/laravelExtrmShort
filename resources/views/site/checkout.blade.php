@extends('layouts.master')
@section('content')
<section class="public-profile-page-section">
    <div class="container">
        <div class="search-holder">
            <form class="search-form">
                <input type="search" placeholder="What are you looking for">
                <input type="submit" value="search">
            </form>
        </div>
    </div>
</section>
<section class="checkout_section">
    <div class="container">
        <div class="d-flex justify-content-between checkDiv">
            <div>
                <h4 class="checkTitle">Checkout</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-sm-7">
                <div class="cartM">
                    <!-- start loop -->
                    <div class="cartBox checkBox">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <a href="#" class="aNone">
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/pexels-football-wife-1618269.jpg') }}" alt="">
                                </a>
                            </div>
                            <div class="col-8 col-md-9 paddingM0">
                                <a href="#" class="tag_info mb-2">sports</a>
                                <h1 class="heading"><a href="#">Lorem ipsum dolor sit amet.</a></h1>
                                <p class="parabx"><span>quality</span>4K</p>
                                <p class="parabx"><span>licence</span>Internet only use</p>
                                <p class="parabx"><span>rental period</span>12 Months</p>
                                <p class="parabx large_font"><span>Price:</span>$100.00</p>
                            </div>
                        </div>
                    </div>
                    <!-- end loop  -->

                    <!-- start loop -->
                    <div class="cartBox checkBox">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <a href="#" class="aNone">
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/pexels-football-wife-1618269.jpg') }}" alt="">
                                </a>
                            </div>
                            <div class="col-8 col-md-9 paddingM0">
                                <a href="#" class="tag_info mb-2">sports</a>
                                <h1 class="heading"><a href="#">Lorem ipsum dolor sit amet.</a></h1>
                                <p class="parabx"><span>quality</span>4K</p>
                                <p class="parabx"><span>licence</span>Internet only use</p>
                                <p class="parabx"><span>rental period</span>12 Months</p>
                                <p class="parabx large_font"><span>Price:</span>$100.00</p>
                            </div>
                        </div>
                    </div>
                    <!-- end loop  -->
                </div>
            </div>
            <div class="col-lg-4 col-sm-5">
                <h4></h4>
                <div class="cartBox">
                    <div class="cartBoxTotal checkoutBox">
                        <h5>Price Details</h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>SUBTOTAL</p>
                                <p>TAX</p>
                            </div>
                            <div>
                                <p class="text-end"> $200.00 </p>
                                <p class="text-end"> $0.00 </p>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex subTotal justify-content-between">
                        <div>
                            <p>TOTAL</p>
                        </div>
                        <div>
                            <p class="text-end"> $200.00 </p>
                        </div>
                    </div>
                    <div class="selectPayment">
                        <div class="paymentType">
                            <label class="payLabel">Select A Payment Type:</label>
                            <div class="form-check customRadio">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <img src="{{ URL::asset('public/frontend/images/Minimal-Credit-Card-Icons.png') }}" alt="">
                                </label>
                            </div>
                            <div class="form-check customRadio">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked="">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <img src="{{ URL::asset('public/frontend/images/paymentlogo2.png') }}" alt="">
                                </label>
                            </div>
                        </div>
                        <div class="paymentSection">
                            <button class="paymentBtn"> Pay with <span>PayPal</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--NEED ASSISTANCE SECTION START-->
<section class="need-assistance-section">
    <div class="container">
        <div class="left-part">
            <h3><strong>Need Assistance?</strong> Your wish is our command.</h3>
            <a href="#">request a call back</a>
        </div>
    </div>
</section>
<!--NEED ASSISTANCE SECTION END-->
@stop