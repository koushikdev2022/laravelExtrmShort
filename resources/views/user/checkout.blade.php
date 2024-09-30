@extends('layouts.master')
@section('content')
<section class="public-profile-page-section">
    <div class="container">
        <div class="search-holder">
            <form class="search-form" action="{{ Route('listing') }}">
                <input type="search" name="search" placeholder="What are you looking for" />
                <input type="submit" value="search" />
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
    @php
            $total = 0.00;
            if(count($data) > 0){
                foreach($data as $d){
                    $t[] = (float)$d->total;
                }
                $total = array_sum($t);

            }
    @endphp
        <div class="row">
            <div class="col-lg-8 col-sm-7">
                <div class="cartM">
                    <!-- start loop -->
                    @if(count($data) > 0)
                    @forelse($data as $d)
                    @php
                    $project = \App\Models\Project::where("status", '=', '1')->where('id','=',$d->project_id)->first();
                    @endphp
                    <div class="cartBox checkBox">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <a href="javascript:void(0)" class="aNone">
                                    <img class="img-fluid" src="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$project->image) }}" alt="">
                                </a>
                            </div>
                            <div class="col-8 col-md-9 paddingM0">
                                @php
                                $lang = session()->get('locale');
                                $category = \App\Models\TranslationCategory::where(['category_id'=>$project->category])->where('lang_code', '=', $lang)->first();
                                @endphp
                                <a href="javascript:void(0)" class="tag_info mb-2">@if($project->category != '') {{ ucfirst($category->category_name) }} @endif</a>
                                <h1 class="heading"><a href="#">{{ ucfirst($project->title) }}</a></h1>
                                <p class="parabx"><span>quality</span>
                                    @php
                                    $projectinfo = \App\Models\ProjectInfo::where('id','=',$d->project_info_id)->first();
                                    @endphp
                                    <span class="descrb">@if($projectinfo->quality == '1') HD ,@else 4K ,@endif</span>
                                </p>
                                <p class="parabx"><span>licence</span>@if($projectinfo->licence_for == '1') For Internet Use Only @else For Other UseOnly @endif</p>
                                <p class="parabx"><span>rental period</span>12 Months</p>
                                <p class="parabx large_font"><span>Price:</span>$ {{ $d->total }}</p>

                                <button class="cart_remove" onclick="deleteCart('{{ $d->id }}')"><i class="icofont-ui-delete"></i></button>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                    @else
                    @php
                    $total = 0.00;
                    @endphp
                    <div class="alert alert-danger" role="alert">
                        Nothing Found
                    </div>
                    @endif
                    <!-- end loop  -->

                    <!-- start loop -->
                    <!-- <div class="cartBox checkBox">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <a href="#" class="aNone">
                                    <img class="img-fluid" src="images/pexels-football-wife-1618269.jpg" alt="">
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
                    </div> -->
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

                                <p class="text-end"> ${{ $total }} </p>
                                <p class="text-end"> $0.00 </p>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex subTotal justify-content-between">
                        <div>
                            <p>TOTAL</p>
                        </div>
                        <div>
                            <p class="text-end"> ${{ $total }} </p>
                        </div>
                    </div>
                    <form id="paymentRequest" action="{{ Route('pay') }}" method="post">
                        @csrf
                        <div class="selectPayment">
                            <div class="paymentType">
                                <label class="payLabel">Select A Payment Type:</label>
                                <div class="form-check customRadio">
                                    <input class="form-check-input" type="radio" name="paypal" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <img src="{{ URL::asset('public/frontend/images/Minimal-Credit-Card-Icons.png') }}" alt="">
                                    </label>
                                </div>
                                <input type="hidden" name="amount" value="{{ $total }}">
                                <div class="form-check customRadio">
                                    <input class="form-check-input" type="radio" name="paypal" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <img src="{{ URL::asset('public/frontend/images/paymentlogo2.png') }}" alt="">
                                    </label>
                                </div>
                            </div>
                            <div class="paymentSection">
                                <button type="submit" class="paymentBtn"> Pay with <span>PayPal</span></button>
                            </div>
                        </div>
                    </form>
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
@section('js')
<script>
    function deleteCart(cart_id){
        ajaxindicatorstart();
        $.ajax({
            type: "GET",
            url: full_path + "deleteCart/" + cart_id,
            success: function(response) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + response.message,
                    time: 6,
                });
                ajaxindicatorstop();
                setTimeout(function(){
                    window.location.reload();

                },2000);
            },
            error: function(response) {
                notie.alert({
                    type: "error",
                    text: '<i class="fa fa-times"></i>' + response.responseJSON.message,
                    time: 6,
                });
                ajaxindicatorstop();
            },
        });
    }
</script>
@stop