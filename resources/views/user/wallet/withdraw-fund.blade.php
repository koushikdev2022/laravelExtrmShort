@extends('layouts.master')
@section('content')
@php
    $user=Auth()->guard('frontend')->user();
@endphp
    <style>
        .boder_btmnone .white_contentbx {
            border-radius: 7px 7px 0px 0px !important;
        }

        .wallet_tpbx .wallet_leftbx .left_heading {
            margin-bottom: 0px;
            text-align: left;
            font-size: 16px;
        }

        .wallet_tpbx .wallet_leftbx .heading {
            font-size: 23px;
            color: #666666;
            font-weight: 500;
            margin-bottom: 0px;
        }
    </style>
    <div class="dash-bottom-part pb-0">
        <div class="justify-content-center">
            <div class="col-md-12">


                <div class="row justify-content-center mx-0">
                    <div class="col-lg-6">
                        <div class="withdrawbx">
                            <div class="wallet_tpbx boder_btmnone">
                                <div class="wallet_leftbx white_contentbx">
                                    <h1 class="left_heading">Balance available for withdrawal</h1>
                                    <h1 class="heading">$ {{ $data->balance }}</h1>
                                </div>
                            </div>
                            <div class="common-section-box border_tpnone">
                                <div class="common-dash-form common-section-box-content">
                                    <form action="withdraw-fund" id="withdraw-request" method="post">
                                        @csrf
                                         <input type="hidden" name="user_type_id" value="{{ $user->type_id }}">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Enter Amount</label>
                                                    <input type="number" name="amount" class="form-control"placeholder="Enter withdrawal amount">
                                                    <span class="help-block"><span>
                                                        </span></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control"placeholder="">
                                                    <span class="help-block"><span>
                                                        </span></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>IBAN No</label>
                                                    <input type="text" name="iban_no" class="form-control"placeholder="">
                                                    <span class="help-block"><span>
                                                        </span></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Account No</label>
                                                    <input type="text" name="account_no" class="form-control"
                                                        placeholder="">
                                                    <span class="help-block"><span>
                                                        </span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center save mb-3 mt-3 dash_btnwrp">
                                            <button type="submit" class="common-btn">Confirm</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


@stop
