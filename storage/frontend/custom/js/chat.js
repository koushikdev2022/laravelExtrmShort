/* global full_path, mejs, contentLoader, ModelOnlineInterval, checkModelOnline */
var chatInterval, pertialChatInterval;
var prependrequest = null;
var messagerequest = null;
var prependpartialrequest = null;
var currentRequest = null;
var checkDisconnectOrNotVar = null;
var ModelOnlineInterval = null;
//var CallComingOrNot = null;
var smallLoader = '<i style="font-size: 16px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i>';
var contentLoader = '<div class="text-center insideLoader" style="margin: 5%;"><i style="font-size: 46px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div>';
$(document).ready(function () {

    clearInterval(ModelOnlineInterval);
    if (logged_in == 1 && location.host !== '127.0.0.1:8000') {
        lastOnlineTime = setInterval(function () {
            lastOnlineTimeUpdate();
        }, 8000);
    }
    /*CallComingOrNot = setInterval(function () {
     checkCallComingOrNot();
     }, 6000);*/

    // $(".cust-scroll-table").niceScroll({touchbehavior: false, cursorcolor: "#B7001F", cursoropacitymax: 0.7, cursorwidth: 5, background: "#fff", cursorborder: "none", cursorborderradius: "5px", autohidemode: false});
    // $(window).scroll(function () {
    //     $(".cust-scroll-table").getNiceScroll().resize();
    // });
    // $(window).resize(function () {
    //     $(".cust-scroll-table").getNiceScroll().resize();
    // });
    // var nicesx = $(".field-scroll").niceScroll(".field-scroll div", {touchbehavior: true, cursorcolor: "#B7001F", cursoropacitymax: 0.6, cursorwidth: 24, usetransition: true, hwacceleration: true, autohidemode: "hidden"});
    // $(window).scroll(function () {
    //     $(".field-scroll").getNiceScroll().resize();
    // });
    // $(window).resize(function () {
    //     $(".field-scroll").getNiceScroll().resize();
    // });

    $(document).on('keyup', "#filterReceipent", function () {
        var filter = $(this).val(), count = 0;
        // Loop through the comment list
        $("#contacts li .user_info").each(function () {
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).closest('li').fadeOut();

                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).closest('li').show();
                count++;
            }
        });
    });

    // $(document).on('click', '.attachement-file-box', function () {
    //     $('#file-input').trigger('click');
    // });

    $(document).on('click', 'a.manageuserstatus', function () {
        var state = 'block';
        var pointer = $(this);
        var connectionid = $('#connection_id').val();
        var reciverid = $('#send_receiver_id').val();
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        if (pointer.hasClass('unblockuser')) {
            state = 'unblock';
        }
        pointer.addClass('disabled');
        pointer.find('i').addClass('fa fa-spinner fa-spin').removeClass('icofont-ui-block');

        $.ajax({
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf_token },
            url: full_path + 'manager-connection-status/' + state,
            dataType: 'json',
            data: { connectionid: connectionid, reciverid: reciverid, state: state },
            success: function (resp) {
                if (resp.status === 200) {
                    if (state == 'block') {
                        $('#send-msg-form').addClass('d-none');
                        pointer.removeClass('blockuser').addClass('unblockuser').html('<i class="icofont-ui-block"></i> Unblock');
                    } else {
                        $('#send-msg-form').removeClass('d-none');
                        pointer.removeClass('unblockuser').addClass('blockuser').html('<i class="icofont-ui-block"></i> Block');
                    }
                } else {
                    pointer.find('i').addClass('icofont-ui-block').removeClass('fa fa-spinner fa-spin');
                }
                pointer.removeClass('disabled');
                ajaxindicatorstop();
            }
        });
    });

    $(document).on('click', 'li.recipient-box', function () {
        $('.manageuserstatus').removeClass('unblockuser disabled').html('<i class="icofont-ui-block"></i> Block');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('#scroll_offset').val(0);
            $('#scroll_total').val(0);
            $('.msg_card_body').html('');
            $('.message-body-content').addClass('d-none');
            $('.contact-profile').addClass('d-none');
            $('.shwblkmsg').addClass('d-none');
            $('#send-msg-form').find('#send_receiver_id').val('');
            $('#send-msg-form').find('#connection_id').val('');
            $('[name="last_message_id"]').val('');
            clearInterval(chatInterval);
            if (prependrequest !== null) {
                prependrequest.abort();
            }
        } else {
            $('li.recipient-box').not(this).removeClass('active');
            $('.contact-profile').removeClass('d-none');
            $(this).addClass('active');
            var username = $(this).find('.user_info').text();
            var user_id = $(this).data('id');
            var profile_link = window.location.origin + '/user-profile/' + btoa(user_id);
            $(this).find('.preview').removeAttr('style');
            $('.userptofilelink').attr('href', profile_link);
            $('.active-chat-user-name').text(username);
            $('.msg_card_body').html(contentLoader);
            $('.active-chat-user-img').attr('src', $(this).find('.connection-img img').attr('src'));
            $('.call_anchor').attr('data-userId', user_id);
            $('.message-body-content').removeClass('d-none');
            fetchMessages();
            clearInterval(chatInterval);
            chatInterval = setInterval(updateMessages, 4000);
        }
    });

    /********************Fatch Load More Content On scroll***************/

    if ($("#chat-history").length > 0) {
        $("#chat-history").scrollTop($("#chatBox")[0].scrollHeight);
    }

    $('#chat-history').scroll(function () {
        var scroll_offset = $('#scroll_offset').val();
        var scroll_total = $('#scroll_total').val();
       console.log(scroll_offset, scroll_total,$('#chat-history').scrollTop(),Number(scroll_total),Number(scroll_offset));
       
        if ($('#chat-history').scrollTop() === 0 && (Number(scroll_total) >= Number(scroll_offset))) {
            var fetch_id = $('li.recipient-box').data('id');
            var connectionid = $('li.recipient-box').data('connection');
            var csrf_token = $('meta[name=csrf-token]').attr('content');
            prependrequest = $.ajax({
                url: full_path + 'prepend-message',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                dataType: 'json',
                data: {fetch_id: fetch_id, connectionid: connectionid, scroll_offset: scroll_offset},
                success: function (resp) {
                    if (resp.c_status == 2 && resp.connection_update_id != fetch_id) {
                        $('.message-body-content').addClass('d-none');
                        $('.shwblkmsg').removeClass('d-none');
                        $('.block_rgt_bx').removeClass('d-none');
                        $('.block_rgt_bx').find('.manageuserstatus').addClass('unblockuser').html('<i class="icofont-ui-block"></i> Unblock');
                    } else if (resp.c_status == 2) {
                        $('.shwblkmsg').removeClass('d-none');
                        $('.message-body-content').addClass('d-none');
                        $('#send-msg-form').find('#send_receiver_id').val('');
                        $('#send-msg-form').find('#connection_id').val('');
                        $('.block_rgt_bx').addClass('d-none');
                    } else if (resp.c_status == 1) {
                        $('.shwblkmsg').addClass('d-none');
                        $('.message-body-content').removeClass('d-none');
                        $('.block_rgt_bx').removeClass('d-none');
                    } else {
                        $('.block_rgt_bx').addClass('d-none');
                        $('.message-body-content').addClass('d-none');
                    }

                    if (resp.status && resp.status === 200) {
                        $('.msg_card_body').prepend(resp.html);

                        $('#chat-history').scrollTop(30);
                    }
                    $('#scroll_offset').val(resp.offset);
                    $('#scroll_total').val(resp.totalMsg);
                    $('#chatBox').scrollTop(30); // Scroll alittle way down, to allow user to scroll more
                }
            });
        }
    });
   
 

    if ($('#getcode').val() != "") {
        var code = $('#getcode').val();
        setTimeout(function () {
            $('[data-bcode="' + code + '"]').trigger('click');
        }, 1000);
    }

    // $(document).on('keyup keydown', '[ref="message_box"]', function (e) {
    //     console.log(e.which)
    //     if (e.which == 13) {
    //         sendMsg();
    //     }
    // });

    $('#send-msg-form').submit(function (e) {
        e.preventDefault();
    });
    autGrowMessageBox();
    $(document).on('click', '.filesendtoopponent', function () {
        $('.modal').modal('hide');
        $('.file-upload-wrapper').attr('data-text', 'Upload Here');
        $('#upload_media_modal').modal('show');
    });
    $('#mySendFiles').bind('change', function () {

        //this.files[0].size gets the size of your file.
        if (this.files.length > 5) {
            err_msg('The maximum files added upto 5.');
            $('#mySendFiles').val('');
            return false;
        }
        $('.file-upload-wrapper').attr('data-text', 'Upload Here');
        // alert(this.files.length);

    });
    $(document).on('submit', '#send_upload_msg_form', function (e) {
        e.preventDefault();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        if ($('[name="upload_file_names[]"]').length == 0) {
            error_msg('Please upload a file.');
        }
        var data = new FormData($('#send_upload_msg_form')[0]);
        data.append('connection_id', $('#connection_id').val());
        data.append('receiver_id', $('#send_receiver_id').val());
        data.append('last_message_as', $('[name="last_message_as"]').val());
        $('.upbtn').addClass('disabled');
        ajaxindicatorstart();
        $('.upbtn').find('i').addClass('fa fa-spinner fa-spin').removeClass('icofont-paper-plane');
        messagerequest = $.ajax({
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf_token },
            url: full_path + 'post-message',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function () {
                if (messagerequest !== null) {
                    messagerequest.abort();
                }
                clearInterval(chatInterval);
            },
            success: function (resp) {

                $('.upbtn').removeClass('disabled');
                $('.upbtn').find('i').addClass('icofont-paper-plane').removeClass('fa fa-spinner fa-spin');
                ajaxindicatorstop();
                if (resp.status === 200 && resp.message) {
                    $('#upload_media_modal').modal('hide');
                    var id = 0;
                    $('#send_upload_msg_form')[0].reset();
                    $('.msg_card_body').append(resp.message);
                    // initVideoPLayer();
                    if ($('.message-content-part').length > 0) {
                        id = $('.message-content-part:last-child').data('id');
                        $('[name="last_message_as"]').val($('.message-content-part:last-child').data('as'));
                    }
                    $('[name="last_message_id"]').val(id);
                    $("#messagesonrtetc").animate({
                        scrollTop: $("#messagesonrtetc").prop("scrollHeight")
                    }, 1500);
                    // $(".messages-box").animate({
                    //     scrollTop: $(".messages-box")[0].scrollHeight
                    // }, 2000);
                }
                $('#upload-2-queue').html('');
                chatInterval = setInterval(updateMessages, 4000);
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#send_upload_msg_form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#send_upload_msg_form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
                $('.upbtn').removeClass('disabled');
                $('.upbtn').find('i').addClass('icofont-paper-plane').removeClass('fa fa-spinner fa-spin');
            }
        }).fail(function () {
            ajaxindicatorstop();
            $('.upbtn').removeClass('disabled');
            $('.upbtn').find('i').addClass('icofont-paper-plane').removeClass('fa fa-spinner fa-spin');
        });
    });

    /********************Fatch Load More Content On scroll***************/

    if ($("#chatBox").length > 0) {
        $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
    }

    $(document).bind('scroll', '#chatBox', function () {
        var scroll_offset = $('#scroll_offset').val();
        var scroll_total = $('#scroll_total').val();
        //        console.log(scroll_offset, scroll_total);
        if ($('#chatBox').scrollTop() === 0 && (Number(scroll_total) >= Number(scroll_offset))) {
            var fetch_id = $('li.recipient-box').data('id');
            var connectionid = $('li.recipient-box').data('connection');
            var csrf_token = $('meta[name=csrf-token]').attr('content');
            if (prependrequest !== null) {
                return false;
            }
            prependrequest = $.ajax({
                url: full_path + 'prepend-message',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf_token },
                dataType: 'json',
                data: { fetch_id: fetch_id, connectionid: connectionid, scroll_offset: scroll_offset },
                beforeSend: function () {
                    if (prependrequest !== null) {
                        prependrequest.abort();
                    }
                },
                success: function (resp) {
                    if (resp.c_status == 2 && resp.connection_update_id != fetch_id) {
                        $('.message-body-content').addClass('d-none');
                        $('.shwblkmsg').removeClass('d-none');
                        $('.block_rgt_bx').removeClass('d-none');
                        $('.block_rgt_bx').find('.manageuserstatus').addClass('unblockuser').html('<i class="icofont-ui-block"></i> Unblock');
                    } else if (resp.c_status == 2) {
                        $('.shwblkmsg').removeClass('d-none');
                        $('.message-body-content').addClass('d-none');
                        $('#send-msg-form').find('#send_receiver_id').val('');
                        $('#send-msg-form').find('#connection_id').val('');
                        $('.block_rgt_bx').addClass('d-none');
                    } else if (resp.c_status == 1) {
                        $('.shwblkmsg').addClass('d-none');
                        $('.message-body-content').removeClass('d-none');
                        $('.block_rgt_bx').removeClass('d-none');
                    } else {
                        $('.block_rgt_bx').addClass('d-none');
                        $('.message-body-content').addClass('d-none');
                    }

                    if (resp.status && resp.status === 200) {
                        $('.msg_card_body').prepend(resp.html);
                        initVideoPLayer();

                        $('#chatBox').scrollTop(30);
                    }
                    $('#scroll_offset').val(resp.offset);
                    $('#scroll_total').val(resp.totalMsg);
                    $('#chatBox').scrollTop(30); // Scroll alittle way down, to allow user to scroll more
                }
            });
        }
    });

});

function checkModelOnline() {
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: full_path + 'check-host-online',
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'POST',
        dataType: 'json',
        success: function (resp) {
        }
    });
}

function lastOnlineTimeUpdate() {
    clearInterval(ModelOnlineInterval);
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: full_path + 'lastOnlineTimeUpdate',
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'GET',
        dataType: 'json',
        success: function (resp) {
            var activeUserId = $('li.recipient-box').data('id');
            $('span.unread-msg').html(resp.total_unread_msg);
            $.each(resp.users, function (key, val) {
                $('.contact_status' + key).removeClass('online').removeClass('offline').addClass(val.status);
                $('.contact_status' + key).parents('.ligrp_bx').find('p.preview').remove();
                if (!$('.contact_status' + key).parents('.ligrp_bx').find('div.media-body').hasClass('hasSmall')) {
                    $('.contact_status' + key).parents('.ligrp_bx').find('div.media-body').append(val.msg);
                }
                $('.contact_status' + key).parents('.ligrp_bx').find('div.media-body .show-time').html(val.time);
                $('.contact_status' + key).parents('.ligrp_bx').find('.unread-num-msg').html(val.unread);
                //                if (key == activeUserId) {
                //                    $('.pf-online').removeClass('offline online').addClass(val.status);
                //                }
            });
        },
        error: function (resp) {
        }
    });
}

function showNumberofImageSelect(input) {
    if (input.files && input.files.length > 0) {
        sendMsg();
    }
}


function fetchMessages() {
    var fatch_id = $('li.recipient-box.active').data('id');
    $('#send-msg-form').find('#send_receiver_id').val(fatch_id);
    $('#send-msg-form').find('#connection_id').val($('li.recipient-box.active').data('connection'));
    var connectionid = $('li.recipient-box.active').data('connection');
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'fetch-messages',
        dataType: 'json',
        data: {fatch_id: fatch_id, connectionid: connectionid},
        success: function (resp) {
            $('.msg_card_body').html(resp.html);
			$('.block_rgt_bx').find('.sendtips').attr('onclick', 'openSendTipsModal("'+resp.encode_model_id+'", "Message Tips", "","'+connectionid+'")');
            if (resp.c_status == 2 && resp.connection_update_id != fatch_id) {
                $('.message-body-content').addClass('d-none');
                $('.shwblkmsg').removeClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');                
                
                $('.block_rgt_bx').find('.manageuserstatus').addClass('unblockuser').html('<i class="icofont-ui-block"></i> Unblock');
            } else if (resp.c_status == 2) {
                $('.shwblkmsg').removeClass('d-none');
                $('.message-body-content').addClass('d-none');
                $('#send-msg-form').find('#send_receiver_id').val('');
                $('#send-msg-form').find('#connection_id').val('');
                $('.block_rgt_bx').addClass('d-none');
            } else if (resp.c_status == 1) {
                $('.shwblkmsg').addClass('d-none');
                $('.message-body-content').removeClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');
            } else {
                $('.block_rgt_bx').addClass('d-none');
                $('.message-body-content').addClass('d-none');
            }
            if (resp.usemode != 3) {
                $('#send-msg-form').addClass('d-none');
            } else {
                $('#send-msg-form').removeClass('d-none');
            }

            $(".chat-history").animate({
                scrollTop: $(".messages")[0].scrollHeight}, 1500);
            var id = 0;
            if ($('.message-content-part').length > 0) {
                console.log($('#chatBox li:last').data('id'));
                id = $('#chatBox li:last').data('id');
                $('[name="last_message_as"]').val($('.message-content-part:last-child').data('as'));
            }
            $('#scroll_offset').val(0);
            $('#scroll_total').val(resp.total_msg);
            $('[name="last_message_id"]').val(id);
        }
    });
}
function updateMessages() {
    var fatch_id = $('li.recipient-box.active').data('id');
    var user_name = $('li.recipient-box.active').find('.name').text();
    var last_id = $('[name="last_message_id"]').val();
    var connectionid = $('li.recipient-box.active').data('connection');
    $('#send-msg-form').find('#send_receiver_id').val(fatch_id);
    $('#send-msg-form').find('#sender-id').val(fatch_id);
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var last_as = $('[name="last_message_as"]').data('as');
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'append-message',
        dataType: 'json',
        data: {fatch_id: fatch_id, last_id: last_id, connectionid: connectionid, last_as: last_as},
        success: function (resp) {
            $('.msg_card_body').find('.insideLoader').remove();
            if (resp.c_status == 2 && resp.connection_update_id != fatch_id) {
                $('.shwblkmsg').removeClass('d-none').html('<i>Oops, you cannot anymore write to <strong>'+user_name+'</strong> , because you have blocked him / her. <a href="javascript:void(0)" class="unblock-text manageuserstatus unblockuser">Unblock?</a></i>');
                $('.message-body-content').addClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');
                $('.block_rgt_bx').find('.manageuserstatus').addClass('unblockuser').html('<i class="icofont-ui-block"></i> Unblock');
            }else if (resp.c_status == 2 && resp.connection_update_id == fatch_id) {
                $('.shwblkmsg').removeClass('d-none').html('<i>Oops, you cannot write to <strong>'+user_name+'</strong> ,  because he / she has blocked you.</i>');
                $('.message-body-content').addClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');
                $('#send-msg-form').find('#send_receiver_id').val('');
                $('#send-msg-form').find('#connection_id').val('');
            }
             else if (resp.c_status == 2) {
                $('.shwblkmsg').removeClass('d-none');
                $('.message-body-content').addClass('d-none');
                $('#send-msg-form').find('#send_receiver_id').val('');
                $('#send-msg-form').find('#connection_id').val('');
                $('.block_rgt_bx').addClass('d-none');
            } else if (resp.c_status == 1) {
                $('.shwblkmsg').addClass('d-none');
                $('.message-body-content').removeClass('d-none');
                $('.block_rgt_bx').removeClass('d-none');
            } else {
                $('.block_rgt_bx').addClass('d-none');
                $('.message-body-content').addClass('d-none');
            }
            if (resp.usemode != '3') {
                $('#send-msg-form').addClass('d-none');
            }

            if (resp.status && resp.status === 200) {
                $('.msg_card_body').append(resp.html);
                initVideoPLayer();
                if (prependrequest != null) {
                    $(".messages").animate({scrollTop: $(".messages")[0].scrollHeight}, 2000);
                }
                var id = 0;
                if ($('.message-content-part').length > 0) {
                    id = $('.message-content-part:last-child').data('id');
                    $('[name="last_message_as"]').val($('.message-content-part:last-child').data('as'));
                }
                $(".chat-history").animate({
                    scrollTop: $(".messages")[0].scrollHeight}, 2000);
                $('[name="last_message_id"]').val(id);
            }
        }
    });
}

function sendMsg() {
    if ($('[ref="message_box"]').val() == '' && $('[name="upload_file_names[]"]').length == 0) {
        return false;
    }
    $('#send-msg-form').submit(function (e) {
        e.preventDefault();
    });
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var data = new FormData($('#send-msg-form')[0]);
    messagerequest = $.ajax({
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf_token },
        url: full_path + 'post-message',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        beforeSend: function () {
            if (messagerequest !== null) {
                messagerequest.abort();
            }
            $('.sendmsgbtn').attr('disabled', true);
            $('.sendmsgbtn').addClass('disabled');
            $('.sendmsgbtn').find('i').addClass('fa-spinner fa-spin').removeClass('fa-paper-plane');
            clearInterval(chatInterval);
        },
        success: function (resp) {
            $('.sendmsgbtn').attr('disabled', false);
            $('.sendmsgbtn').removeClass('disabled');
            $('.sendmsgbtn').find('i').addClass('fa-paper-plane').removeClass('fa-spinner fa-spin');
            $('#send-msg-form').find('[name="file_name"]').val('');
            $('#send-msg-form').find('[name="file_type"]').val('');

            if (resp.status === 200 && resp.message) {
                $('#upload_media_modal').modal('hide');
                $('#send_upload_msg_form')[0].reset();
                $('#send-msg-form')[0].reset();
                var id = 0;
                $('#send-msg-form').find('[name="message"]').val('');
                autGrowMessageBox();
                $('.emoji-wysiwyg-editor').html('');
                $('.msg_card_body').append(resp.message);
                initVideoPLayer();
                if ($('.message-content-part').length > 0) {
                    id = $('.message-content-part:last-child').data('id');
                    $('[name="last_message_as"]').val($('.message-content-part:last-child').data('as'));
                }
                $('[name="last_message_id"]').val(id);
                $("#messagesonrtetc").animate({
                    scrollTop: $("#messagesonrtetc").prop("scrollHeight")
                }, 1500);
            }
            $('#upload-2-queue').html('');
            chatInterval = setInterval(updateMessages, 4000);
        },
        error: function (resp) {
            $('.sendmsgbtn').attr('disabled', false);
            $('.sendmsgbtn').removeClass('disabled');
            $('.sendmsgbtn').find('i').addClass('fa-paper-plane').removeClass('fa-spinner fa-spin');
        }
    }).fail(function () {
        $('.sendmsgbtn').attr('disabled', false);
        $('.sendmsgbtn').removeClass('disabled');
        $('.sendmsgbtn').find('i').addClass('fa-paper-plane').removeClass('fa-spinner fa-spin');
    });
}

function autGrowMessageBox() {
    $('.messagetext').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight);
    }).find('textarea').change();
}

function loadPlayerAndIframe() {
    $('iframe').on('load', function () {
        $("iframe").contents().find("img").css({ 'width': '100%', 'height': '150px', 'object-fit': 'cover' });
    });
    $('audio').mediaelementplayer();
}

function showLoader(percentComplete) {
    $('.message-body-content').addClass('d-none');
    $("#progressOuter1").show();
    $("#progressBar1").css("width", Math.round(percentComplete) + "%");
    $("#progressBar1").html(Math.round(percentComplete) + "%");
}
function closeLoader() {
    $("#progressOuter1").hide();
    $('.message-body-content').removeClass('d-none');
    $("#progressBar1").css("width", "0%");
    $("#progressBar1").html("0%");
}


function imgError(image) {
    image.onerror = "";
    image.src = full_path + "public/frontend/images/user.png";
    return true;

}

function initVideoPLayer() {
    //    var mediaElements = document.querySelectorAll('video');
    //    for (var i = 0, total = mediaElements.length; i < total; i++) {
    //        new MediaElementPlayer(mediaElements[i], {
    //            previewMode: true,
    //            muteOnPreviewMode: true,
    //            fadeOutAudioInterval: 200,
    //            fadeOutAudioStart: 10,
    //            fadePercent: 0.02,
    //            features: ['playpause', 'current', 'progress', 'duration', 'volume', 'fullscreen', 'preview'],
    //        });
    //    }

}

function checkDisconnectOrNot() {
    var url = full_path + 'check-disconnect-or-not';
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: url,
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: '',
        success: function (resp) {
            if (resp.reload == 'true') {
                notification('Call Disconnected..');
                setTimeout(function () {
                    window.location.href = resp.url;
                }, 3000);
                clearInterval(checkDisconnectOrNotVar);
            }
        },
        error: function (resp) {

        }
    });
}


function makeVideoCall(obj) {
    var type = $(obj).data('type');
    var to_user_id = $(obj).data('userid');
    var url = full_path + 'make-video-call';
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    ajaxindicatorstart();
    $.ajax({
        url: url,
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'POST',
        dataType: 'json',
        //      processData: false,
        //      contentType: false,
        data: { type: type, to_user_id: to_user_id },
        success: function (resp) {
            ajaxindicatorstop();
            if (resp.calling == 'true') {
                $("#calling_modal .calling_img").attr("src", resp.profile_image);
                $("#calling_modal .calling_text").html(resp.calling_text);
                $('#calling_modal').modal();
            }
        },
        error: function (resp) {
            ajaxindicatorstop();
        }
    });
}

function answerCall(obj) {
    var url = $(obj).data('url');
    notification('Call Connected..');
    setTimeout(function () {
        window.location.href = url;
    }, 1000);
}

function disconnectAndReloadCall() {
    var url = full_path + 'disconnect-call';
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        url: url,
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: '',
        success: function (resp) {
            if (resp.res == 1) {
                notification('Call disconnected')
                setTimeout(function () {
                    window.location.href = resp.url;
                }, 1000);
            }
        },
        error: function (resp) {

        }
    });
}

$(document).ready(function () {
    $('#MessageAddConnection').submit(function(event){
        ajaxindicatorstart();
        event.preventDefault();
        var data = new FormData($('#MessageAddConnection')[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: full_path+'create-message-connection',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data:data,
        success: function (resp) {
             notie.alert({
                type: 'success',
                text: '<i class="fa fa-check"></i> ' + resp.message,
                time: 3,
            });
            //$('#changeBillingAddress').modal('hide');
            $('#add-user').modal('hide');

            setTimeout(function() {
               location.reload();
             }, 2000); 
            // $('#add-education-content').html(resp.htmlContent);
            ajaxindicatorstop();
            
        },
        error: function (resp) {
            //console.log(resp);
            $.each(resp.responseJSON.error, function (key, value) {
                    $('#MessageAddConnection').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(value[0]);
                    $('#MessageAddConnection').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
            });
            // $('#billingForm').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(value[0]);
            // $('#billingForm').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
            ajaxindicatorstop();
        }
       });
    });
});


$(document).ready(function(){
    var img ='/storage/uploads/frontend/profile_picture/original/';
    var default_img='/storage/frontend/images/profile_user.png';
    $("#addUserAutocomplete").autocomplete({
       source: function( request, response ) {
         $.ajax({
           url: full_path+"add-user-autocomplete",
           dataType: "json",
           data: {
             q: request.term
           },
           success: function( data ) {
             response( data );
             
           }
         });
       },
       minLength: 2,
       scroll:true,
       select: function( event, ui ) {
        //  var link = ui.item.link;
        //  window.location.href = link;
        $("#txtAllowSearchMessageID").val(ui.item.id);
       },
       open: function() {
         $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
       },
       close: function() {
         $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
       }
     });
     $("#addUserAutocomplete").autocomplete( "instance" )._renderItem = function( ul, item ) {
        if(!item.img)
        {
           if(item.value=='No Record Found.')
           {
               var image_div="";
           }
           else{
               var image_div="<img src="+default_img+" style=height:40px;width:40px;border-radius:50%;>";
           }
           
        }else{

           var image_div="<img src="+img+item.img+" style=height:40px;width:40px;border-radius:50%;>";
        }
       return $( "<li>" )
         .append( "<div>"+image_div+""+' '+ item.value + "</div>" )
         .appendTo( ul );
     }; 
});