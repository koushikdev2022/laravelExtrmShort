/* global notie, full_path, grecaptcha */
function ajaxindicatorstart() {
    if (jQuery("body").find("#resultLoading").attr("id") != "resultLoading") {
        jQuery("body").append(
            '<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #4179eb;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>'
        );
    }
    jQuery("#resultLoading").css({
        width: "100%",
        height: "100%",
        position: "fixed",
        "z-index": "9999 !important",
        top: "0",
        left: "0",
        right: "0",
        bottom: "0",
        margin: "auto",
    });
    jQuery("#resultLoading .bg").css({
        background: "#ffffff",
        opacity: "0.8",
        width: "100%",
        height: "100%",
        position: "absolute",
        top: "0",
    });
    jQuery("#resultLoading>div:first").css({
        width: "250px",
        height: "75px",
        "text-align": "center",
        position: "fixed",
        top: "0",
        left: "0",
        right: "0",
        bottom: "0",
        margin: "auto",
        "font-size": "16px",
        "z-index": "10",
        color: "#ffffff",
    });
    jQuery("#resultLoading .bg").height("100%");
    jQuery("#resultLoading").fadeIn(300);
    jQuery("body").css("cursor", "wait");
}

function ajaxindicatorstop() {
    jQuery("#resultLoading .bg").height("100%");
    jQuery("#resultLoading").fadeOut(300);
    jQuery("body").css("cursor", "default");
}

$("form#changePassword:first").on("submit", function(e) {
    e.preventDefault();
    ajaxindicatorstart();
    var $this = $(this);
    $.ajax({
        type: $this.attr("method"),
        url: $this.attr("action"),
        data: $this.serializeArray(),
        dataType: $this.data("type"),
        success: function(response) {
            if (response.message) {
                ajaxindicatorstop();

                $("#password_msgs").html(
                    '<div class="alert alert-success text-center" role="alert" id="password_msgs">' +
                    response.message +
                    "</div>"
                );
                location.reload();
            }
        },
        error: function(response) {
            ajaxindicatorstop();

            $.each(response.responseJSON.errors, function(key, val) {
                $("#changePassword")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#changePassword")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .addClass("has-error");
            });

            if (response.responseJSON.error !== undefined) {
                $("#password_msgs").html(
                    '<div class="alert alert-danger text-center" role="alert" id="password_msgs">' +
                    response.responseJSON.error +
                    "</div>"
                );
            }
        },
    });
});

$("#signupRequest").on("submit", function(e) {
    e.preventDefault();
    ajaxindicatorstart();
    var csrf_token = $("input[name=_token]").val();
    let formdata = new FormData($("#signupRequest")[0]);
    $.ajax({
        url: $(this).attr("action"),
        data: formdata,
        type: $(this).attr("method"),
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        success: function(result) {
            notie.alert({
                type: "success",
                text: '<i class="fa fa-check"></i>' + result.message,
                time: 3,
            });
            $("#signupRequest")[0].reset();
            ajaxindicatorstop();
            window.location.href = full_path + result.link;
        },
        error: function(resp) {
            $.each(resp.responseJSON.errors, function(key, val) {
                $("#signupRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#signupRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .addClass("has-error");
            });
            ajaxindicatorstop();
        },
    });
});

function deleteVideo(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "project-delete/" + id,
        success: function(response) {
            notie.alert({
                type: "success",
                text: '<i class="fa fa-check"></i>' + response.message,
                time: 6,
            });
            ajaxindicatorstop();
            location.reload();
        },
    });
}

function changeNotificationStatus(id) {
    ajaxindicatorstart();

    $.ajax({
        type: "GET",
        url: full_path + "changeNotificationStatus/" + id,

        success: function(response) {
            window.location.reload();
            ajaxindicatorstop();
        },
        error: function(response) {
            ajaxindicatorstop();
        },
    });
}

$("#loginRequest").on("submit", function(e) {
    ajaxindicatorstart();
    e.preventDefault();
    var csrf_token = $("input[name=_token]").val();
    let formdata = new FormData($("#loginRequest")[0]);
    $.ajax({
        url: $(this).attr("action"),
        data: formdata,
        type: $(this).attr("method"),
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        success: function(result) {
            notie.alert({
                type: "success",
                text: '<i class="fa fa-check"></i> ' + result.message,
                time: 3,
            });
            $("#loginRequest")[0].reset();
            ajaxindicatorstop();
            window.location.href = result.link;
        },
        error: function(resp) {
            $.each(resp.responseJSON.errors, function(key, val) {
                $("#loginRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#loginRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .addClass("has-error");
            });
            notie.alert({
                type: "error",
                text: '<i class="fa fa-times"></i> ' + resp.responseJSON.message,
                time: 3,
            });
            ajaxindicatorstop();
        },
    });
});

$("#forgotRequest").on("submit", function(e) {
    e.preventDefault();
    ajaxindicatorstart();
    var csrf_token = $("input[name=_token]").val();
    let formdata = new FormData($("#forgotRequest")[0]);
    $.ajax({
        url: $(this).attr("action"),
        data: formdata,
        type: $(this).attr("method"),
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        success: function(result) {
            notie.alert({
                type: "success",
                text: '<i class="fa fa-check"></i>' + result.message,
                time: 3,
            });
            $("#forgotRequest")[0].reset();
            ajaxindicatorstop();
            window.location.href = result.link;
        },
        error: function(resp) {
            $.each(resp.responseJSON.errors, function(key, val) {
                $("#forgotRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#forgotRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .addClass("has-error");
            });
            ajaxindicatorstop();
        },
    });
});

$("#resetPassword").on("submit", function(e) {
    e.preventDefault();
    ajaxindicatorstart();
    var csrf_token = $("input[name=_token]").val();
    let formdata = new FormData($("#resetPassword")[0]);
    $.ajax({
        url: $(this).attr("action"),
        data: formdata,
        type: $(this).attr("method"),
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        success: function(result) {
            notie.alert({
                type: "success",
                text: '<i class="fa fa-check"></i>' + result.message,
                time: 3,
            });
            $("#resetPassword")[0].reset();
            ajaxindicatorstop();
            window.location.href = result.link;
        },
        error: function(resp) {
            $.each(resp.responseJSON.errors, function(key, val) {
                $("#resetPassword")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#resetPassword")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .addClass("has-error");
            });
            ajaxindicatorstop();
        },
    });
});

$("form#updateProfile:first").on("submit", function(e) {
    ajaxindicatorstart();
    e.preventDefault();
    let formdata = new FormData($("#updateProfile")[0]);

    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formdata,
        dataType: $(this).data("type"),
        cache: false,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.message) {
                ajaxindicatorstop();

                $("#profile_msgs").html(
                    '<div class="alert alert-success text-center" role="alert" id="profile_msgs">' +
                    response.message +
                    "</div>"
                );
                location.reload();
            }
        },
        error: function(response) {
            ajaxindicatorstop();

            $.each(response.responseJSON.errors, function(key, val) {
                $("#updateProfile")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#updateProfile")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .addClass("has-error");
            });

            if (response.responseJSON.error !== undefined) {
                $("#profile_msgs").html(
                    '<div class="alert alert-danger text-center" role="alert" id="profile_msgs">' +
                    response.responseJSON.error +
                    "</div>"
                );
            }
        },
    });
});

function showPreview(id, event, oldId) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById(id);
        var old_preview = document.getElementById(oldId);
        preview.src = src;
        preview.style.display = "block";
        old_preview.style.display = "none";
    }
}

$(document).ready(function() {
    var item = $("#searchKeyword").val();
    var type = "searchVal";
    sortByCategory(item, type);
});

function getPopular(status, type) {
    sortByCategory(status, type);
}

function categorySearch(status, type) {
    sortByCategory(status, type);
}

function formatSearch(status, type) {
    sortByCategory(status, type);
}

$("#dateSelections").on("change", function() {
    var item = $("#dateSelections").val();
    var type = "dateSelection";
    sortByCategory(item, type);
});

$("#searchKeyword").on("keyup", function() {
    var item = $("#searchKeyword").val();
    var type = "searchVal";
    sortByCategory(item, type);
});

function compositionSearch(status, type) {
    sortByCategory(status, type);
}

function sortByCategory(item, type) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "searchVideo",
        data: {
            item: item,
            type: type,
        },
        success: function(result) {
            $("#cardView").html("");
            $("#cardView").append(result.content);
            $("#gridView").html("");
            $("#gridView").append(result.gridcontent);
            $("#getTotalCount").html("");
            $("#getTotalCount").append(result.TotalCount + " Video Footage");
            ajaxindicatorstop();
        },
        error: function(result) {
            alert("Some Error");
            ajaxindicatorstop();
        },
    });
}

function uploadStory() {
    $("#storyUploaderModal").modal("show");
}

$("#uploadStoryRequest").on("submit", function(e) {
    ajaxindicatorstart();
    e.preventDefault();
    let formdata = new FormData($("#uploadStoryRequest")[0]);
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
            $("#uploadStoryRequest")[0].reset();
            $("#storyUploaderModal").modal("hide");
        },
        error: function(response) {
            ajaxindicatorstop();
            if (response.responseJSON.error !== undefined) {
                notie.alert({
                    type: "error",
                    text: '<i class="fa fa-times"></i> ' +
                        response.responseJSON.error,
                    time: 6,
                });
            }
            $.each(response.responseJSON.errors, function(key, val) {
                $("#uploadStoryRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#uploadStoryRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .addClass("has-error");
            });
        },
    });
});

function likeProject(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "likeProject",
        type: "GET",
        data: { id: id },
        success: function(result) {
            if (result.success) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + result.message,
                    time: 3,
                });
            }
            ajaxindicatorstop();
            location.reload();
        },
        error: function(result) {
            ajaxindicatorstop();
        },
    });
}

function saveProject(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "saveProject",
        type: "GET",
        data: { id: id },
        success: function(result) {
            if (result.success) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + result.message,
                    time: 3,
                });
            }
            ajaxindicatorstop();
            location.reload();
        },
        error: function(result) {
            ajaxindicatorstop();
        },
    });
}

function showVideo(id) {
    $.ajax({
        url: full_path + "getVideoInfo/" + id,
        success: function(res) {
            video =
                '<video width="320" height="240" width="100%" height="auto" controls controlsList="nodownload" id="videoPlayer">' +
                "<source src = " +
                full_path +
                "public/uploads/frontend/project/video/" +
                res.video +
                '  type = "video/mp4" >' +
                "Your browser does not support the video tag." +
                "</video>";
            $("#videoPlayer").html(video);
            $('.videoPlayerdetails').attr("id", res.id)
        },
    });
    $("#showVideo").modal("show");
}

$('.videoPlayerdetails').on('click', function() {
    var id = $('.videoPlayerdetails').attr('id')
    location.href = full_path + "details/" + btoa(id);
});

$(document).ready(function() {
    $('#contact-us-form-submit').submit(function(event) {
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
            success: function(resp) {
                console.log(resp)
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.msg,
                    time: 3
                });
                $('#contact-us-form-submit')[0].reset();
                ajaxindicatorstop();
            },
            error: function(resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#contact-us-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#contact-us-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
});

$(document).ready(function() {
    $('#career-form-submit').submit(function(event) {
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
            success: function(resp) {
                console.log(resp)
                notie.alert({
                    type: 'success',
                    text: '<i class="fa fa-check"></i> ' + resp.msg,
                    time: 3
                });
                $('#career-form-submit')[0].reset();
                ajaxindicatorstop();
            },
            error: function(resp) {
                console.log(resp);
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#career-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#career-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
});

function reportProject(id) {
    $("#report_project_id").val(id);
    $("#ReportModal").modal("show");
}

$("#ReportRequest").on("submit", function(e) {
    ajaxindicatorstart();
    e.preventDefault();
    let formdata = new FormData($("#ReportRequest")[0]);
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
            $("#ReportRequest")[0].reset();
            $("#ReportModal").modal("hide");
        },
        error: function(response) {
            ajaxindicatorstop();

            $.each(response.responseJSON.errors, function(key, val) {
                $("#ReportRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#ReportRequest")
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

function followUser(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "followuser",
        type: "GET",
        data: { user_id: id },
        success: function(result) {
            if (result.success) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + result.message,
                    time: 3,
                });
            }
            ajaxindicatorstop();
            location.reload();
        },
        error: function(result) {
            ajaxindicatorstop();
        },
    });
}

function purchaseVideo(id) {
    ajaxindicatorstart();
    var quality = $("input[type=radio][name=quality]:checked").val();
    if (quality === undefined) {
        quality = "";
    }
    $.ajax({
        url: full_path + "saveOrder",
        type: "GET",
        data: { project_id: id, info_id: quality },
        success: function(result) {
            ajaxindicatorstop();
            location.href = full_path + result.link;
        },
        error: function(result) {
            notie.alert({
                type: "error",
                text: '<i class="fa fa-times"></i> ' +
                    result.responseJSON.message,
                time: 6,
            });
            ajaxindicatorstop();
        },
    });
}

$("#addBankRequest").on("submit", function(e) {
    ajaxindicatorstart();
    e.preventDefault();
    let formdata = new FormData($("#addBankRequest")[0]);
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
            getBankDetails();
            $("#addBankRequest")[0].reset();
            $("#addBank").modal("hide");
        },
        error: function(response) {
            ajaxindicatorstop();

            $.each(response.responseJSON.errors, function(key, val) {
                $("#addBankRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#addBankRequest")
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

function editBankData(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "getBankDetails",
        data: { id: id },
        success: function(response) {
            $('#bank_id').val(response.id);
            $('#bank_holder_name').val(response.holder_name);
            $('#bank_name').val(response.bank_name);
            $('#branch_name').val(response.branch_name);
            $('#account_number').val(response.account_number);
            $('#confirm_account_number').val(response.account_number);
            $("#editBank").modal("show");
            ajaxindicatorstop();
        },
        error: function(response) {
            ajaxindicatorstop();
        }
    });
}

$("#editBankRequest").on("submit", function(e) {
    ajaxindicatorstart();
    e.preventDefault();
    let formdata = new FormData($("#editBankRequest")[0]);
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
            getBankDetails();
            $("#editBankRequest")[0].reset();
            $("#editBank").modal("hide");
        },
        error: function(response) {
            ajaxindicatorstop();

            $.each(response.responseJSON.errors, function(key, val) {
                $("#editBankRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-group")
                    .find(".help-block")
                    .html(val[0]);
                $("#editBankRequest")
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

function viewBankData(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "getBankDetails",
        data: { id: id },
        success: function(response) {
            $('#holder_name').val(response.holder_name);
            $('#bank_names').val(response.bank_name);
            $('#branch_names').val(response.branch_name);
            $('#account_numbers').val(response.account_number);
            $("#viewBank").modal("show");
            ajaxindicatorstop();
        },
        error: function(response) {
            ajaxindicatorstop();
        }
    });
}

function deleteBankData(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "deleteDetails",
        data: { id: id },
        success: function(response) {
            notie.alert({
                type: "success",
                text: '<i class="fa fa-check"></i>' + response.message,
                time: 3,
            });
            getBankDetails();
            ajaxindicatorstop();
        }
    });
}

function primaryAccount(id) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + "setPrimaryAccount",
        data: { id: id },
        success: function(response) {
            notie.alert({
                type: "success",
                text: '<i class="fa fa-check"></i>' + response.message,
                time: 3,
            });
            getBankDetails();
            ajaxindicatorstop();
        }
    });
}