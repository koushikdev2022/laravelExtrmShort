@extends('layouts.main')
@section('content')
@include('partials.dashboard.header')
<div class="user-dash-right">
    @include('partials.dashboard.topright')
    <div class="clearfix">
        <div class="dash-bottom-part pb-0">
            <div class="justify-content-center">
                <div class="col-md-10 col-lg-10">
                    <div class="main_dashbord_area erningtp mb-0">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">Balance</h4>
                            </div>
                        </div>
                        <div class="view-box view-as-grid">
                            <div class="dashboard_grid dashborad_listbx areanw">
                                <div class="balance_doller">
                                    <div>
                                        <p class="balancedtlnwtp">Your balance is <b>${{ $amount}}</b></p>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="btn_pay" onclick="getPaid()">Get Paid Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main_dashbord_area erningtp mb-0">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">Payment Details</h4>

                            </div>
                        </div>
                        <div class="view-box view-as-grid">

                            <div class="payment_list">
                                <div class="flex-fill">
                                    <h6>Last Payment</h6>
                                    <p>Sep 26, 2022 to localBank</p>
                                </div>
                                <div>
                                    <a href="#" class="view_pay">View Payments</a>
                                </div>
                            </div>

                            <div class="payment_list">
                                <div class="flex-fill">
                                    <h6>Last Payment</h6>
                                    <p>Sep 26, 2022 to localBank</p>
                                </div>
                                <div>
                                    <a href="#" class="view_pay">View Payments</a>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="main_dashbord_area erningtp">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">Payment Method</h4>
                            </div>
                            <div><a href="javascript:void(0)" onclick="add_bank()" class="view_pay view_fill">Add Method</a></div>
                        </div>
                        <div class="view-box view-as-grid">
                            <div id="bankDetailsSection"></div>
                            <!-- <div class="payment_list">
                                <div class="flex-fill">
                                    <p>Damini - Local Bank of world</p>
                                </div>
                                <div>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="circle_drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu dash-drop">
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment_list">
                                <div class="flex-fill">
                                    <p>Damini - Local Bank of world</p>
                                </div>
                                <div>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="circle_drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu dash-drop">
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment_list">
                                <div class="flex-fill">
                                    <p>Damini - Local Bank of world</p>
                                </div>
                                <div>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="circle_drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu dash-drop">
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- col-lg-12 end -->
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal cstpnwarea fade" id="addBank" tabindex="-1" aria-labelledby="addBankLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBankLabel">Add Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
        </button>
            </div>
            <div class="modal-body">
                <div class="main_dashbord_area">
                    <div class="view-box view-as-grid">
                        <div class="dashboard_grid dashborad_listbx">
                            <form id="addBankRequest" action="{{ Route('addBankDetails')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <input type="text" name="holder_name" class="form-control" placeholder="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Name of bank</label>
                                    <input type="text" name="bank_name" class="form-control" placeholder="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Branch Name</label>
                                    <input type="text" name="branch_name" class="form-control" placeholder="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" class="form-control" placeholder="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Account Number</label>
                                    <input type="text" name="confirm_account_number" class="form-control" placeholder="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="content-footer-part text-center">
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal cstpnwarea fade" id="editBank" tabindex="-1" aria-labelledby="editBankLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBankLabel">Edit Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
        </button>
            </div>
            <div class="modal-body">
                <div class="main_dashbord_area">
<!--                    <div class="earings_box">
                        <div class="earning_txt">
                            <h4 class="text_uppercase mb-0">Edit Bank Details</h4>
                        </div>
                    </div>-->
                    <div class="view-box view-as-grid">
                        <div class="dashboard_grid dashborad_listbx">
                            <form id="editBankRequest" action="{{ Route('editBankDetails')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="id" id="bank_id" class="form-control" value="">
                                    <div class=" text-danger help-block"></div>
                                </div>
                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <input type="text" name="holder_name" id="bank_holder_name" class="form-control" value="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Name of bank</label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control" value="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Branch Name</label>
                                    <input type="text" name="branch_name" id="branch_name" class="form-control" value="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" id="account_number" class="form-control" value="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Account Number</label>
                                    <input type="text" name="confirm_account_number" id="confirm_account_number" class="form-control" value="">
                                    <div class=" text-danger help-block"></div>
                                </div>

                                <div class="content-footer-part text-center">
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal cstpnwarea fade" id="viewBank" tabindex="-1" aria-labelledby="viewBankLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBankLabel">View Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
        </button>
            </div>
            <div class="modal-body">
                <div class="main_dashbord_area">
<!--                    <div class="earings_box">
                        <div class="earning_txt">
                            <h4 class="text_uppercase mb-0">View Bank Details</h4>
                        </div>
                    </div>-->
                    <div class="view-box view-as-grid">
                        <div class="dashboard_grid dashborad_listbx">

                            <div class="form-group">
                                <label>Account Holder Name</label>
                                <input type="text" name="holder_name" id="holder_name" class="form-control" value="">
                                <div class=" text-danger help-block"></div>
                            </div>

                            <div class="form-group">
                                <label>Name of bank</label>
                                <input type="text" name="bank_name" id="bank_names" class="form-control" value="">
                                <div class=" text-danger help-block"></div>
                            </div>

                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" name="branch_name" id="branch_names" class="form-control" value="">
                                <div class=" text-danger help-block"></div>
                            </div>

                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" name="account_number" id="account_numbers" class="form-control" value="">
                                <div class=" text-danger help-block"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal cstpnwarea fade" id="RequestedModal" tabindex="-1" aria-labelledby="RequestedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RequestedModalLabel">Withdrawal Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
        </button>
            </div>
            <div class="modal-body">
                <div class="main_dashbord_area">
                    <div class="view-box view-as-grid">
                        <div class="dashboard_grid dashborad_listbx">
                            <form id="withDrawalRequest" action="{{ Route('requestWithdrawalAmount')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Enter Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control" value="">
                                    <div class=" text-danger help-block"></div>
                                </div>
                                <div class="content-footer-part text-center">
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
    function add_bank() {
        $('#addBank').modal('show');
    }

    $(document).ready(function() {
        getBankDetails();
    });

    //ajax for contacts to load
    function getBankDetails() {
        ajaxindicatorstart();
        $.ajax({
            url: full_path + "getAllBankDetails",
            success: function(response) {
                $('#bankDetailsSection').html('');
                $("#bankDetailsSection").append(response.content);
                ajaxindicatorstop();
            }
        });
    }

    function getPaid() {
        ajaxindicatorstart();
        $.ajax({
            url: full_path + "checkAllDetails",
            success: function(response) {
                if (response.success) {
                    $('#RequestedModal').modal('show');
                    ajaxindicatorstop();
                }
            },
            error: function(err) {
                ajaxindicatorstop();
                notie.alert({
                    type: "error",
                    text: '<i class="fa fa-times"></i> ' +
                        err.responseJSON.message,
                    time: 6,
                });
            }
        });
    }

    $("#withDrawalRequest").on("submit", function(e) {
        e.preventDefault();
        ajaxindicatorstart();
        var csrf_token = $("input[name=_token]").val();
        let formdata = new FormData($("#withDrawalRequest")[0]);
        $.ajax({
            url: $(this).attr("action"),
            data: formdata,
            type: $(this).attr("method"),
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            success: function(result) {
                $('#RequestedModal').modal('hide');
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + result.message,
                    time: 3,
                });
                $("#withDrawalRequest")[0].reset();

                ajaxindicatorstop();
            },
            error: function(resp) {
                $('#RequestedModal').modal('hide');
                notie.alert({
                    type: "error",
                    text: '<i class="fa fa-times"></i>' + resp.responseJSON.message,
                    time: 3,
                });
                $("#withDrawalRequest")[0].reset();
                ajaxindicatorstop();
            },
        });
    });
</script>
@stop