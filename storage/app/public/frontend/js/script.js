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
        "z-index": "10000000",
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
            if (result.success) {
                notie.alert({
                    type: "success",
                    text: '<i class="fa fa-check"></i>' + result.message,
                    time: 3,
                });
                $("#signupRequest")[0].reset();
            }
            ajaxindicatorstop();
            window.location.href = full_path + result.link;
        },
        error: function(resp) {
            $.each(resp.responseJSON.errors, function(key, val) {
                $("#signupRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-floating")
                    .find(".help-block")
                    .html(val[0]);
                $("#signupRequest")
                    .find('[name="' + key + '"]')
                    .closest(".form-floating")
                    .addClass("has-error");
            });
            ajaxindicatorstop();
        },
    });
});