$(document).ready(function () {
    $('.user_check').change(function() {
        if(this.checked) {
            $(this).parent().children().eq(1).html('<i class="icofont-check"></i> Selected');
        }else{
            $(this).parent().children().eq(1).html('Follow');
        }
    });

    $("#follow-all").on("click",function(){
       $('.user_check').trigger('click');
    });

    $("#username").on("keyup",function(event){
        event.preventDefault();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = full_path+"check-username";
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($("#unique-handle-submit-form")[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if(resp.status=="200")
                {
                    $(".avalable").removeClass('d-none');
                    $(".not_avilable").addClass('d-none');
                }else{
                    if(resp.username==null)
                    {
                        $(".avalable").addClass('d-none');
                        $(".not_avilable").addClass('d-none');
                    }else{
                        $(".avalable").addClass('d-none');
                        $(".not_avilable").removeClass('d-none');
                    }
                }
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#registration-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#registration-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#registration-form-submit').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                console.log(resp);
                notification(resp.msg,3);
                $('#registration-form-submit')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#registration-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#registration-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })


    });

    $('#user-login-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        // console.log(url);return false;
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                console.log(resp);
                if(resp.msg!="other")
                {
                   notification(resp.msg,3);
                }
                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('.help-block').attr("style","display : block");
                    $('#user-login-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#user-login-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#forgot-password-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                notification(resp.msg,3);
                $('#forgot-password-form')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#forgot-password-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#forgot-password-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
    });

    });


    $('#reset-password-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                notification(resp.msg,3);
                $('#reset-password-form')[0].reset();
                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#reset-password-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#reset-password-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#addon-form-submit').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if(resp.status=="200")
                {
                    window.location.href = resp.link;
                }else{
                    $.each(resp.errors, function (key, val) {
                        $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    });
                }
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $('#unique-handle-submit-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if(resp.status=="200")
                {
                    window.location.href = resp.link;
                }else{
                    $.each(resp.errors, function (key, val) {
                        $('#unique-handle-submit-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $('#unique-handle-submit-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    });
                }
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $('#follow-user-submit').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if(resp.status=="200")
                {
                    notification(resp.msg,3);
                    window.location.href = resp.link;
                }else{
                    $.each(resp.errors, function (key, val) {
                        $('#unique-handle-submit-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $('#unique-handle-submit-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    });
                }
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#addon-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });


    $(document).on('click', '#t_project_store_btn', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $('#project_store_form').attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var data = new FormData($('#project_store_form')[0]);
        // data.append('description', $('[name="description"]').val());
        // data.append('status', $('[name="status"]:checked').val() ? $('[name="status"]:checked').val() : '');
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.status === 200) {
                    notie.alert({
                        type: 'success',
                        text: '<i class="fa fa-check"></i> ' + resp.msg,
                        time: 8
                    });
                    $('#project_store_form')[0].reset();
                    if (resp.link) {
                        setTimeout(function () {
                            window.location.href = resp.link;
                        }, 4000);
                    }
                }
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    if (key == 'AllImages') {
                        $('.help-allimgaes').html(val[0]);
                        $('#project_store_form .allim').addClass('has-error');
                    } else if (key == 'status') {
                        $('.help-status').html(val[0]);
                        $('.help-status').closest('.form-group').addClass('has-error');
                    } else {
                        $('#project_store_form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $('#project_store_form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    }

                });
                ajaxindicatorstop();
            }
        });
    });

    $("#store-proposal").submit(function(event) {
        ajaxindicatorstart();
        event.preventDefault();
        var data = new FormData($("#store-proposal")[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: full_path + "store-proposal",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i> ' + resp.message,
                    time: 3,
                });
                $("#proposalModal").modal("hide");
                if (resp.check == "update") {
                    $("#proposal_btn").addClass("d-none");
                    $("#proposal_edit_btn").removeClass("d-none");
                    setTimeout(function() {
                        window.location.href = resp.link;
                    }, 2000);
                } else if (resp.check == "create") {
                    $("#proposal_btn").addClass("d-none");
                    $("#proposal_edit_btn").removeClass("d-none");
                    setTimeout(function() {
                        window.location.href = resp.link;
                    }, 2000);
                }
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.error, function(key, val) {
                    $("#store-proposal")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                    // $('#store-proposal').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            },
        });
    });


    // $("#add-review-form").submit(function(event) {
    //     ajaxindicatorstart();
    //     event.preventDefault();
    //     var data = new FormData($("#add-review-form")[0]);
    //     $.ajaxSetup({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //     });
    //     $.ajax({
    //         url: full_path + "user/add-review",
    //         type: "POST",
    //         dataType: "json",
    //         processData: false,
    //         contentType: false,
    //         data: data,
    //         success: function(resp) {
    //             if(resp.status=='success')
    //             {
    //                 notie.alert({
    //                     type: "success",
    //                     text: '<i class="fa fa-check"></i> ' + resp.msg,
    //                     time: 3,
    //                 });
    //                 $('#add-review').modal('hide');
    //                 setTimeout(function() {
    //                     location.reload();
    //                 }, 2000);
    //             }else{
    //                 notie.alert({
    //                     type: "error",
    //                     text: '<i class="fa fa-times-circle-o"></i> ' + resp.msg,
    //                     time: 3,
    //                 });
    //                 $('#add-review').modal('hide');
    //             }
    //             ajaxindicatorstop();
    //         },
    //         error: function(resp) {
    //             $.each(resp.responseJSON.error, function(key, val) {
    //                 $("#add-review-form")
    //                     .find('[name="' + key + '"]')
    //                     .closest(".form-group")
    //                     .find(".help-block")
    //                     .html(val[0]);
    //             });
    //             ajaxindicatorstop();
    //         },
    //     });
    // });

    $("#add-report-form").submit(function(event) {
        ajaxindicatorstart();
        event.preventDefault();
        var data = new FormData($("#add-report-form")[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: full_path + "user/add-report",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                if(resp.status=='success')
                {
                    notie.alert({
                        type: "success",
                        text: '<i class="fa fa-check"></i> ' + resp.msg,
                        time: 3,
                    });
                    $('#add-report').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }else{
                    notie.alert({
                        type: "error",
                        text: '<i class="fa fa-times-circle-o"></i> ' + resp.msg,
                        time: 3,
                    });
                    $('#add-report').modal('hide');
                }
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.error, function(key, val) {
                    $("#add-report-form")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                });
                ajaxindicatorstop();
            },
        });
    });

    $("#add-review-form").submit(function(event) {
        ajaxindicatorstart();
        event.preventDefault();
        var data = new FormData($("#add-review-form")[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: full_path + "user/add-review",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                if(resp.status=='success')
                {
                    notie.alert({
                        type: "success",
                        text: '<i class="fa fa-check"></i> ' + resp.msg,
                        time: 3,
                    });
                    $('#add-review').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }else{
                    notie.alert({
                        type: "error",
                        text: '<i class="fa fa-times-circle-o"></i> ' + resp.msg,
                        time: 3,
                    });
                    $('#add-review').modal('hide');
                }
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.error, function(key, val) {
                    $("#add-review-form")
                        .find('[name="' + key + '"]')
                        .closest(".form-group")
                        .find(".help-block")
                        .html(val[0]);
                });
                ajaxindicatorstop();
            },
        });
    });


});

function upgrade_plan(subscription_id) {
    var url = full_path + "user/upgrade-plan";
    var csrf_token = $('meta[name="csrf-token"]').attr("content");
    var data = { subscription_id: subscription_id };
    ajaxindicatorstart();
    $.ajax({
        url: url,
        headers: { "X-CSRF-TOKEN": csrf_token },
        type: "POST",
        dataType: "json",
        //processData: false,
        //contentType: false,
        data: data,
        success: function(resp) {
            ajaxindicatorstop();
            if (resp.status == "success") {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-times"></i> ' + resp.message,
                    time: 3,
                });
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {
                console.log(resp);
                notie.alert({
                    type: "error",
                    text: '<i class="fa fa-times"></i> ' + resp.errors,
                    time: 3,
                });
            }
        },
    });
}

function select_cat(category_id) {
    var type = category_id;
    var csrf_token = $('meta[name="csrf-token"]').attr("content");
    var url = full_path + "fetch-subcategory";
    var data = { type: type };
    ajaxindicatorstart();
    $.ajax({
        url: url,
        headers: { "X-CSRF-TOKEN": csrf_token },
        type: "POST",
        dataType: "json",
        //processData: false,
        //contentType: false,
        data: data,
        success: function(resp) {
            ajaxindicatorstop();
            if (resp.status == "success") {
                // notie.alert({
                //     type: "success",
                //     text: '<i class="fa fa-times"></i> ' + resp.message,
                //     time: 3,
                // });
                $("#show-subcategory").html(resp.content);
            } else {
                console.log(resp);
                // notie.alert({
                //     type: "error",
                //     text: '<i class="fa fa-times"></i> ' + resp.errors,
                //     time: 3,
                // });
            }
        },
    });
}



$('#type').on('change',function() {
    var type = this.value;
    var csrf_token = $('meta[name="csrf-token"]').attr("content");
    var url = full_path + "fetch-subcategory";
    var data = { type: type };
    ajaxindicatorstart();
    $.ajax({
        url: url,
        headers: { "X-CSRF-TOKEN": csrf_token },
        type: "POST",
        dataType: "json",
        //processData: false,
        //contentType: false,
        data: data,
        success: function(resp) {
            ajaxindicatorstop();
            if (resp.status == "success") {
                // notie.alert({
                //     type: "success",
                //     text: '<i class="fa fa-times"></i> ' + resp.message,
                //     time: 3,
                // });
                $("#show-subcategory").html(resp.content);
            } else {
                console.log(resp);
                // notie.alert({
                //     type: "error",
                //     text: '<i class="fa fa-times"></i> ' + resp.errors,
                //     time: 3,
                // });
            }
        },
    });

});


$('#searh_category').on('change',function() {
    var category_id = this.value;
    var csrf_token = $('meta[name="csrf-token"]').attr("content");
    var url = full_path + "searh-fetch-subcategory";
    var data = { category_id: category_id };
    ajaxindicatorstart();
    $.ajax({
        url: url,
        headers: { "X-CSRF-TOKEN": csrf_token },
        type: "POST",
        dataType: "json",
        data: data,
        success: function(resp) {
            ajaxindicatorstop();
            if (resp.status == "success") {
                $("#searh-show-subcategory").html(resp.content);
            } else {
                console.log(resp);
            }
        },
    });
});


function initMap() {
    var input = document.getElementById('searchMapInput');
    var input1 = document.getElementById('searchMapInput1');
    var input2 = document.getElementById('searchMapInput2');
    var input3 = document.getElementById('searchMapInput3');
    var input4 = document.getElementById('searchMapInput4');
    var input5 = document.getElementById('searchMapInput5');


    if(input!='')
    {
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.setComponentRestrictions({'country': ['isr']});

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            // $('#location-snap').val(place.formatted_address);
            // $('#lat-span').val(place.geometry.location.lat());
            // $('#lon-span').val(place.geometry.location.lng());
            document.getElementById('location-snap').value = place.formatted_address;
            document.getElementById('lat-span').value = place.geometry.location.lat();
            document.getElementById('lon-span').value = place.geometry.location.lng();

            Livewire.emit('getLatitudeForInput', place.geometry.location.lat());
            Livewire.emit('getLogitudeForInput', place.geometry.location.lng());
            Livewire.emit('getAddressForInput', place.formatted_address);
        });

    }
    if(input1 != '')
    {
        var autocomplete1 = new google.maps.places.Autocomplete(input1);

        autocomplete1.setComponentRestrictions({'country': ['isr']});

        autocomplete1.addListener('place_changed', function() {
            var place1 = autocomplete1.getPlace();

            document.getElementById('location-snap1').value = place1.formatted_address;
            document.getElementById('lat-span1').value = place1.geometry.location.lat();
            document.getElementById('lon-span1').value = place1.geometry.location.lng();
        });
    }
    if(input2 != '')
    {
        var autocomplete2 = new google.maps.places.Autocomplete(input2);

        autocomplete2.setComponentRestrictions({'country': ['isr']});

        autocomplete2.addListener('place_changed', function() {
            var place2 = autocomplete2.getPlace();

            document.getElementById('location-snap2').value = place2.formatted_address;
            document.getElementById('lat-span2').value = place2.geometry.location.lat();
            document.getElementById('lon-span2').value = place2.geometry.location.lng();
        });
    }
    if(input3 != '')
    {
        var autocomplete3 = new google.maps.places.Autocomplete(input3);

        autocomplete3.setComponentRestrictions({'country': ['isr']});

        autocomplete3.addListener('place_changed', function() {
            var place3 = autocomplete3.getPlace();

            document.getElementById('location-snap3').value = place3.formatted_address;
            document.getElementById('lat-span3').value = place3.geometry.location.lat();
            document.getElementById('lon-span3').value = place3.geometry.location.lng();
        });


    }
    if(input4 != '')
    {
        var autocomplete4 = new google.maps.places.Autocomplete(input4);

        autocomplete4.setComponentRestrictions({'country': ['isr']});

        autocomplete4.addListener('place_changed', function() {
            var place4 = autocomplete4.getPlace();

            document.getElementById('location-snap4').value = place4.formatted_address;
            document.getElementById('lat-span4').value = place4.geometry.location.lat();
            document.getElementById('lon-span4').value = place4.geometry.location.lng();
        });
    }
    if(input5 != '')
    {
        var autocomplete5 = new google.maps.places.Autocomplete(input5);

        autocomplete5.setComponentRestrictions({'country': ['isr']});

        autocomplete5.addListener('place_changed', function() {
            var place5 = autocomplete5.getPlace();

            document.getElementById('location-snap5').value = place5.formatted_address;
            document.getElementById('lat-span5').value = place5.geometry.location.lat();
            document.getElementById('lon-span5').value = place5.geometry.location.lng();
        });
    }


}

$(document).ready(function() {
    // alert("hello");
    // var img = "/storage/uploads/frontend/profile_picture/original/";
    // var default_img = "/storage/frontend/images/profile/dummyProfile.jpg";

    $(".main-search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: full_path + "search-autocomplete",
                dataType: "json",
                data: {
                    q: request.term,
                },
                success: function(data) {
                    response(data);
                },
            });
        },
        minLength: 2,
        scroll: true,
        select: function(event, ui) {
            var link = ui.item.link;
            // window.location.href = link;
            $(".txtAllowSearchProjectID").val(ui.item.id);
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        },
    });
    $(".main-search").autocomplete("instance")._renderItem = function(
        ul,
        item
    ) {
        return $("<li>")
            .append("<div>" + " " + item.value + "</div>")
            .appendTo(ul);
    };
});


$('#category_id').on('change', function() {

// alert("hello");
    var category_id = $(this).val();
    var csrf_token = $('meta[name="csrf-token"]').attr("content");
    var url = full_path + "signup-subcategory";
    var values = $('#show-signup-subcategory').val();


    var data = {
        category_id: category_id,
        values : values
    };
    ajaxindicatorstart();
    // var hidden_city = $('#hidden_city').val($('#show-signup-subcategory').val());
    // var def= $('#show-signup-subcategory').select2().val($('#hidden_city').val());
    // console.log(data);
    $.ajax({
        url: url,
        headers: {
            "X-CSRF-TOKEN": csrf_token
        },
        type: "POST",
        dataType: "json",

        data: data,
        success: function(resp) {
            ajaxindicatorstop();
            if (resp.status == "success") {
                $("#show-signup-subcategory").html(resp.content);

                if(resp.cat == 0)
                {
                    $('#finishAddress').addClass('d-none');
                    $('#chk-hide').addClass('d-none');
                }
                else{
                    $('#finishAddress').removeClass('d-none');
                    $('#chk-hide').removeClass('d-none');
                    // $('#transportationReturn').addClass('d-none');
                }
                // $.each($("#show-signup-subcategory"), function(){
                //     $(this).select2('val', values);
                // });
            } else {
                ajaxindicatorstop();

            }

        },
    });

});


function deleteObject(obj) {
    var title = $(obj).data('title');
    var url = $(obj).data('href');
    var tbl = $(obj).data('tbl');
    $.confirm({
        title: 'Delete ' + title,
        content: 'Are you sure to delete this ' + title + ' ?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    ajaxindicatorstart();
                    var csrf_token = $('meta[name=csrf-token]').attr('content');
                    $.ajax({
                        url: url,
                        headers: { 'X-CSRF-TOKEN': csrf_token },
                        type: 'DELETE',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function (resp) {
                            if (resp.status === 200) {
                                notie.alert({
                                    type: "success",
                                    text: '<i class="fa fa-times"></i> ' + resp.msg,
                                    time: 3,
                                });
                                $('#id'+resp.id).addClass('d-none')
                            } else {
                                notie.alert({
                                    type: "error",
                                    text: '<i class="fa fa-times"></i> ' + resp.msg,
                                    time: 3,
                                });
                            }

                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: function () { }
        }
    });
}


function submit_proposal(project_id) {
    if (project_id) {
        var url = full_path + "get-details-project";
        var csrf_token = $('meta[name="csrf-token"]').attr("content");
        var data = { project_id: project_id };
        ajaxindicatorstart();
        $.ajax({
            url: url,
            headers: { "X-CSRF-TOKEN": csrf_token },
            type: "POST",
            dataType: "json",
            //processData: false,
            //contentType: false,
            data: data,
            success: function(resp) {
                ajaxindicatorstop();
                if (resp.status == "success") {
                    $("#proposalModal").modal("show");
                    // $("#htmleditteamplay").remove();
                    $("#htmleditproposal").html(resp.content);

                    // save();
                } else {
                    console.log(resp);
                    notie.alert({
                        type: "error",
                        text: '<i class="fa fa-times"></i> ' + resp.errors,
                        time: 3,
                    });
                }
            },
        });
    }
}

function add_favorite(project_id,id,favorite_type){
    var favorite_type=favorite_type;
    if(favorite_type==1)
    {
        if(id){
            ajaxindicatorstart();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: full_path + 'user/add-favorite',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    method:'POST',
                    data:{
                        user_id:id,
                        project_id:project_id
                    },
                   success:function(data){
                       if(data.success)
                       {
                           $("#remove-favorite"+id).removeClass('d-none');
                           $("#add-favorite"+id).addClass('d-none');
                       }
                       ajaxindicatorstop();
                   }
                });
         }

    }
    if(favorite_type==0)
    {
        if(id){
            ajaxindicatorstart();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: full_path + 'user/add-favorite',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    method:'POST',
                    data:{
                        user_id:id,
                        project_id:project_id
                    },
                   success:function(data){
                       if(data.success)
                       {
                           $("#remove-favorite"+id).addClass('d-none');
                           $("#add-favorite"+id).removeClass('d-none');
                       }
                       ajaxindicatorstop();
                   }
                });
         }
    }

}


$(document).ready(function () {
    $('#contact-us-form-submit').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        // var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        // console.log(data);return false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            // headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                console.log(resp)
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.msg,
                    time: 3
                });
                $('#contact-us-form-submit')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#contact-us-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#contact-us-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
});

$(document).ready(function () {
    $('#career-form-submit').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        // var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        // console.log(data);return false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            // headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                console.log(resp)
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.msg,
                    time: 3
                });
                $('#career-form-submit')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#career-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#career-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
});


function add_review(review_value)
{
    $('#review_value').val(review_value);
}

function add_report(report_value)
{
    $('#report_value').val(report_value);
}


$(document).ready(function() {
    $("#showfilter").click(function() {
        if ($(".filter").hasClass("d-none")) {
            $(".filter").removeClass("d-none");
        } else {
            $(".filter").addClass("d-none");
        }
    });
});


// $('#show-signup-subcategory').on('change', function() {
//     var data = $('#show-signup-subcategory').val();
//     $('#hidden_city').val(data);
// });
