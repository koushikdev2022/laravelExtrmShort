@extends('layouts.main')
@include('partials.dashboard.header')
@section('content')
<div class="user-dash-right">
    @include('partials.dashboard.topright')
    <div class="clearfix">
        <div class="dash-bottom-part pb-0">
            <div class="justify-content-center">
                <div class="col-md-12">
                    <div class="main_dashbord_area">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">Tax Residence</h4>
                            </div>
                            <div class="view_gropad">
                                <a href="javascript:void(0)" onclick="editResidence()" class="edit_btn"><i class="icofont-ui-edit"></i></a>
                            </div>
                        </div>
                        <div class="area_content">
                            <p>This address will be displayed on invoices.</p>
                            <h5>Address</h5>
                            @if($data != '')
                            <p>{{ $data->state}},
                                {{$data->address}}<br>
                                {{$data->city}}<br>
                                {{$data->zip}}<br>
                                {{ $data->country}}
                            </p>
                            @else
                            No Data Found
                            @endif
                        </div>
                    </div>

                    <div class="main_dashbord_area" id="residence_edit_form">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">Tax Residence</h4>
                            </div>
                            <!-- <div class="view_gropad">
                                <a href="#" class="edit_btn"><i class="icofont-ui-edit"></i></a>
                            </div> -->
                        </div>
                        <div class="area_content">
                            <p>This address will be displayed on invoices.</p>
                            <p><a href="javascript:void(0)" onclick="profileAddress()">Use my profile address</a></p>
                            <form id="residenceSaveRequest" action="{{Route('saveResidence')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $data!='' ? $data->id : ''}}" name="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>

                                            <select class="form-control" name="country" id="country">
                                                @forelse($country as $c)
                                                <option value="{{ $c->country_name}}" @if($data!='' ){{ $data->country == $c->country_name ? 'selected' : ''}} @endif>{{ $c->country_name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <div class=" text-danger help-block"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" name="address" id="address" rows="3">{{ $data!='' ?  $data->address : ''}}</textarea>
                                            <div class=" text-danger help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="city" value="{{ $data!='' ?  $data->city : ''}}" id="city" value=""></input>
                                            <div class=" text-danger help-block"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" name="state" value="{{ $data!='' ?  $data->state : ''}}" id="state" value=""></input>
                                            <div class=" text-danger help-block"></div>

                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">City</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>Options</option>
                                                <option>Options</option>
                                                <option>Options</option>
                                                <option>Options</option>
                                                <option>Options</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">State</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>Options</option>
                                                <option>Options</option>
                                                <option>Options</option>
                                                <option>Options</option>
                                                <option>Options</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="zip">ZIP Code</label>
                                            <input class="form-control" name="zip" id="zip" value="{{ $data!='' ?  $data->zip : ''}}">
                                            <div class=" text-danger help-block"></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="content-footer-part">
                                    <input type="button" value="Cancel">
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                    @if($data != '')
                    @if( $data->country == 'United States')
                    <div class="main_dashbord_area">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">W-9</h4>
                            </div>
                            <div class="view_gropad">
                                <a href="javascript:void(0)" class="edit_btn"><i class="icofont-ui-edit"></i></a>
                            </div>
                        </div>
                        <div class="area_content">
                            <p>To collect the right information, indicate if you are a <a href="javascript:void(0)">U.S. person</a> :</p>
                            <form class="saveTaxRequest" action="{{ Route('saveUSTaxData')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$data->id}}" name="id">
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" id="non_us_w9" name="us_person" value="No" class="custom-control-input">
                                    <label class="custom-control-label" for="non_us_w9"> I am not a U.S. person</label>
                                </div>
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" id="us_w9" name="us_person" value="Yes" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="us_w9">I am a U.S person</label>
                                </div>
                               
                                <p>Before withdrawing funds, all <a href="javascript:void(0)">U.S. persons</a> must provide their W-9 tax information.</p>

                                <!-- <p class="mt-3">Before withdrawing funds, all non-U.S. persons must provide their W-8BEN tax information.</p> -->
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Legal Name of Taxpayer</label>
                                    <input type="text" class="form-control" value="{{ $data->legal_payer_name }}" name="legal_payer_name" id="exampleFormControlSelect1">
                                    <p class="text-muted m-0">Provide the same name as shown on your tax return.</p>
                                    <div class=" text-danger help-block"></div>

                                </div>

                                <!-- <h5>Legal Name of Taxpayer</h5>
                                <p>Lorem, ipsum</p>

                                <h5>Federal Tax Classification</h5>
                                <p>Individual/sole proprietor or single-member LLC</p> -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Federal Tax Classification</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="federation_tax_classification">
                                            <option value=''>Select Option</option>
                                            <option value="1" {{ $data->federation_tax_classification == '1' ? 'selected' : ''}}>Options1</option>
                                                <option value="2" {{ $data->federation_tax_classification == '2' ? 'selected' : ''}}>Options2</option>
                                               
                                            </select>
                                            <div class=" text-danger help-block"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Federal Tax Classification</label>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="customRadio1" name="identification_type" {{ $data->identification_type == 'SSN' ? 'checked' : ''}} value="SSN" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1"> Social Security Number (SSN)</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="customRadio2" name="identification_type" value="EIN" {{ $data->identification_type == 'EIN' ? 'checked' : ''}}  class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Employer Identification Number (EIN) <span class="tooltip2" data-toggle="tooltip" data-placement="top" title='An employer identification number (EIN) is a U.S. tax identification number (TIN) issued to businesses. For Additional information, or to apply for an EIN, you may visit.'><i class="icofont-info-circle tooltip2"></i></span></label>
                                    </div>
                                    <div class=" text-danger help-block"></div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">SSN/EIN #</label>
                                            <input class="form-control" id="exampleFormControlSelect1" value="{{ $data->identification_number}} " name="identification_number">
                                        </div>
                                        <div class=" text-danger help-block"></div>

                                    </div>
                                </div>
                                <div class="custom-control custom-checkbox form-group">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" value="1" name="chk_tax_certification" {{ $data->chk_tax_certification!= '' ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customCheck1">I certify, under penalties of perjury, that the representations in this <a href="javascript:void(0)">Tax Certificate</a> are true and correct.</label>
                                    <div class=" text-danger help-block"></div>

                                </div>

                                <!-- <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">I certify, under penalties of perjury, that the representations in this <a href="#">Tax Certificate</a> are true and correct.</label>
                                </div> -->

                                <div class="content-footer-part">
                                    <a href="{{ Route('dashboard') }}" ><input type="button" value="Cancel"></a>
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="main_dashbord_area">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">W-8BEN</h4>
                            </div>
                        </div>
                        <div class="area_content">
                            <p>To collect the right information, indicate if you are a <a href="javascript:void(0)">U.S. person</a> :</p>
                            <form class="saveTaxRequest" action="{{ Route('saveNonUSTaxData')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$data->id}}" name="id">
                               
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" id="customRadio1" name="us_person" value="No" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio1"> I am not a U.S. person</label>
                                </div>
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" id="customRadio2" name="us_person" value="Yes" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">I am a U.S person</label>
                                </div>

                                <p class="mt-3">Before withdrawing funds, all non-U.S. persons must provide their W-8BEN tax information.</p>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Leagal Name of Taxpayer</label>
                                    <input type="text" class="form-control" value="{{ $data->legal_payer_name }}" name="legal_payer_name" id="exampleFormControlSelect1">
                                    <p class="text-muted m-0">Provide the same name as shown on your tax return.</p>
                                    <div class=" text-danger help-block"></div>

                                </div>
                                <div class="custom-control custom-checkbox form-group">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" value="1" name="chk_tax_certification" {{ $data->chk_tax_certification!= '' ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customCheck1">I certify, under penalties of perjury, that the representations in this <a href="#">Tax Certificate</a> are true and correct.</label>
                                    <div class=" text-danger help-block"></div>

                                </div>
                                <div class="content-footer-part">
                                <a href="{{ Route('dashboard') }}" ><input type="button" value="Cancel"></a>
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    @endif
                    <!-- 
                    <div class="main_dashbord_area">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">W-9</h4>
                            </div>
                            <div class="view_gropad">

                            </div>
                        </div>
                        <div class="area_content">
                            <p>To collect the right information, indicate if you are a <a href="#">U.S. person</a> :</p>



                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio1"> I am not a U.S. person</label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2">I am a U.S person</label>
                            </div>


                            <p class="mt-3">Before withdrawing funds, all non-U.S. persons must provide their W-9 tax information.</p>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Leagal Name of Taxpayer</label>
                                <input class="form-control" id="exampleFormControlSelect1">
                                <p class="text-muted m-0">Provide the same name as shown on your tax return.</p>
                            </div>
                        </div>

                    </div> -->
                </div>
                <!-- col-lg-12 end -->
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).ready(function() {
        $('#residence_edit_form').css('display', 'none');
    });

    function editResidence() {
        $('#residence_edit_form').css('display', 'block');
    }

    function profileAddress() {
        ajaxindicatorstart();
        $.ajax({
            url: full_path + "profileAddress",
            success: function(response) {
                $("#country").val(response.country).change();
                $('#address').val(response.address_line1);
                $("#state").val(response.state);
                $("#city").val(response.city);
                $("#zip").val(response.zipcode);
                ajaxindicatorstop();
            }
        });
    }

    $("#residenceSaveRequest").on("submit", function(e) {
        ajaxindicatorstart();
        e.preventDefault();
        let formdata = new FormData($("#residenceSaveRequest")[0]);
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: formdata,
            dataType: $(this).data("type"),
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                ajaxindicatorstop();

                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + response.message,
                    time: 3,
                });
                location.reload();
            },
            error: function(response) {
                ajaxindicatorstop();
                $.each(response.responseJSON.errors, function(key, val) {
                    $("#residenceSaveRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                    $("#residenceSaveRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .addClass("has-error");
                });
                if (response.responseJSON.error !== undefined) {
                    notie.alert({
                        type: "error",
                        text: '<i class="fa fa-times"></i> ' +
                            response.responseJSON.error.message,
                        time: 6,
                    });
                }
            },
        });
    });

    $(".saveTaxRequest").on("submit", function(e) {
        ajaxindicatorstart();
        e.preventDefault();
        let formdata = new FormData($(".saveTaxRequest")[0]);
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: formdata,
            dataType: $(this).data("type"),
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                ajaxindicatorstop();

                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + response.message,
                    time: 3,
                });
                location.reload();
            },
            error: function(response) {
                ajaxindicatorstop();
                $.each(response.responseJSON.errors, function(key, val) {
                    $(".saveTaxRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                    $(".saveTaxRequest")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .addClass("has-error");
                });
                if (response.responseJSON.error !== undefined) {
                    notie.alert({
                        type: "error",
                        text: '<i class="fa fa-times"></i> ' +
                            response.responseJSON.error.message,
                        time: 6,
                    });
                }
            },
        });
    });
</script>
@stop