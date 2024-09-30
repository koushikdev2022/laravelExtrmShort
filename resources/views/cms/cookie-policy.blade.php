@extends('layouts.master')
@section('content')
<!-- page header title banner  -->

<section class="py-0">
    <div class="loginHead staticnwarea">
        <div class="loginImg pageTitle">
            <div class="container text-center">
                <h1 class="heading">{{__('cms.Cookie Policy')}}</h1>
            </div>
        </div>
    </div>
</section>

<!-- end of page header title banner -->

<section class="static_page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {!! $model->content_body !!}
            </div>
        </div>
    </div>
</section>
@stop
