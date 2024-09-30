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
});

