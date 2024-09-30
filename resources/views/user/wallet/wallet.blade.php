@extends('layouts.master')
@section('content')
@php
    $user=Auth()->guard('frontend')->user();
@endphp

    <style>
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

        .common-btn {
            /* background: #54A233;
                border: 1px solid #54A233; */
            padding: 8px 27px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 5px !important;
            color: #ffffff;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            display: inline-block;
        }
    </style>
    <div class="clearfix">
        <div class="dash-bottom-part pb-0">
            <div class="justify-content-center">
                <div class="col-md-12">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="wallet_tpbx">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="wallet_leftbx walletBoxx white_contentbx flexNone mb-4">
                                    <h1 class="left_heading">Available funds</h1>
                                    <div class="text-center">
                                        <h1 class="heading">${{ $balance->balance }}</h1>
                                        @if($user->type_id==2)
                                            <div>
                                                <a class="common-btn mb-2 mt-4" href="deposit-fund">Deposit funds</a>
                                            </div>
                                        @endif
                                        @if($user->type_id==3)
                                            <div>
                                                <a class="common-btn" href="withdraw-fund">Withdrawl funds</a>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="bottom-part-2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab_one" role="tab"
                                    aria-controls="tab_one">
                                    History
                                </a>
                            </li>
                        </ul>
                        <div class="white_contentbx px-3">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_one" role="tabpanel">
                                    <div wire:id="35JUmQ2F3I7eYwObQRTN">
                                        <div class="wallet_leftbx white_contentbx filter_area">
                                            {{-- <div class="wallet_filter">
                                                <form class="form-inline text-center dblockmob justify-content-center">
                                                    <div class="form-group">
                                                        <input type="date" wire:model.defer="walletForm.from" class="form-control" placeholder="From" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    </div>
                                                    <div class="form-group mx-sm-3">
                                                        <input type="date" wire:model.defer="walletForm.to"
                                                            class="form-control" placeholder="To" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    </div>
                                                    <a class="common-btn common-btn-search" href="#" wire:click.prevent="render" wire:loading.class="d-none" wire:target="render">Search
                                                    </a>
                                                </form>
                                            </div> --}}

                                        </div>
                                        <div class="table_bx">
                                            <div class="table-responsive">
                                                <table class="table table-striped mb-0">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $trns)
                                                        <tr>
                                                            <td data-label="Type">
                                                                {{ (($trns->credit_amount == null) ? $trns->debit_amount : $trns->credit_amount) }}
                                                            </td>
                                                            <td data-label="Description">
                                                                {{ (($trns->credit_amount == null) ? 'Debit Request' : 'credit Request') }}
                                                            </td>
                                                            <td data-label="Date">
                                                                {{ $trns->created_at }}
                                                            </td>
                                                            <td data-label="Status">
                                                                @if ($trns->status == 'completed')
                                                                    <span class="badge badge-success">Success</span>
                                                                @elseif ($trns->status == 'processing')
                                                                    <span class="badge badge-warning">processing</span>
                                                                @elseif ($trns->status == 'decline')
                                                                    <span class="badge badge-danger">decline</span>
                                                                @else
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">


                                        </div>
                                    </div>
                                    <!-- Modal Proposal -->
                                    <div class="modal fade" id="refundRequesttModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Refund Request</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form class="mt-2 space-y-6 c-form" id="refund-request" action=""
                                                    method="post">
                                                    <span id="htmleditRefundRequest"></span>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn_site_outline"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn btn_site form-login-action">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Livewire Component wire-end:35JUmQ2F3I7eYwObQRTN -->
                                </div>


                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@stop
