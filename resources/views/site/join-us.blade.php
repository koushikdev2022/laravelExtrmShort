@extends('layouts.main')

@section('content')
<!-- login Head -->
<section>
    <div class="loginHead">
        <div class="loginImg"></div>
        <!--background-->
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5 col-xl-4">
                <div class="loinBox">
                    <h2>{{__('site.Sign Up')}}</h2>

                    <a href="#" class="btn loginGoogle">
                        <i class="fab fa-google"></i> {{__('site.Continue with Google')}}
                    </a>

                    <a href="#" class="btn loginFacebook">
                        <i class="fab fa-facebook-f"></i> {{__('site.Continue with Facebook')}}
                    </a>

                    <div class="loginDivider">
                        <p>{{__('site.Or')}}</p>
                    </div>
                    <form>


                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('site.Name')}}</label>
                            <input type="text" class="form-control giControl" placeholder="{{__('site.Enter name')}}">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('site.Email')}}</label>
                            <input type="text" class="form-control giControl" placeholder="{{__('site.Enter Email')}}">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('site.Password')}}</label>
                            <input type="password" class="form-control giControl" placeholder="{{__('site.Password')}}">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">{{__('site.Confirm Password')}}</label>
                            <input type="password" class="form-control giControl" placeholder="{{__('site.Re-enter password')}}">
                        </div>


                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{__('site.Creating an account means youre okay with our')}} <a class="aLink" href="#">{{__('site.Terms & Conditions')}} </a> &amp; <a class="aLink" href="#">{{__('site.Privacy Policy.')}}</a>
                            </label>
                        </div>


                        <button class="btn btnLogin">{{__('site.Sign up')}}</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="haveAccount">{{__('site.Already Have An Account?')}} <a class="aLink" href="#">{{__('site.Log In')}}</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@stop
