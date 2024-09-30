@extends('layouts.master')
@section('content')
    <div class="dash-bottom-part pb-0">
        <div class="justify-content-center">
            <div class="col-md-8">
                <div class="dash-bottom-part">
                    <div class="bottom-part-2">
                        <div class="dash_headingbx">
                            <div class="white_contentbx">
                                <h2 class="dash_heading pl-0">Add Funds to Wallet</h2>
                                <div class="common-section-box-content">
                                    <div class="common-dash-form">
                                        <form action="deposit-fund" method="POST">
                                            @csrf
                                            <div class="step_bx">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Enter Amount ($)</label>
                                                            <input class="form-control" name="amount"
                                                                placeholder="Amount" type="number" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center save dash_btnwrp">
                                                    <button type="submit" class="common-btn green"
                                                        wire:loading.class="d-none">Save</button>
                                                    <button class="common-btn green custloading" type="button"
                                                        wire:loading="" wire:target="store" disabled="">
                                                        <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                    </button>
                                                </div>
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
    </div>


@stop
