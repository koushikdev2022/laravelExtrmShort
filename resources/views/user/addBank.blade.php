@extends('layouts.main')
@include('partials.dashboard.header')
@section('content')
<div class="user-dash-right">
    @include('partials.dashboard.topright')
    <div class="clearfix">
        <div class="dash-bottom-part pb-0">
            <div class="justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="main_dashbord_area">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">Add Bank Details</h4>
                            </div>
                            
                        </div>
                        <div class="view-box view-as-grid">
                            <div class="dashboard_grid dashborad_listbx">
                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Name of bank</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Branch Name</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Account Number</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>

                                <div class="content-footer-part">
                                    <input type="button" value="Edit">
                                    <input type="submit" value="Save">
                                </div>


                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- col-lg-12 end -->
            </div>
        </div>
    </div>
</div>
@stop