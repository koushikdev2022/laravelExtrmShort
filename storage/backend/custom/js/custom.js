var contentLoader = '<div class="text-center insideLoader" style="margin: 5%;"><i style="font-size: 46px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div>';
$(document).ready(function() {
    $('#add-product-form').submit(function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function() {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $.each(resp.error, function(key, val) {
                        if (key.indexOf('.') != -1) {
                            var reskey = key.split('.');
                            var fieldname = reskey[0];
                            var fieldid = reskey[1];
                            $('#add-product-form').find('select[name^="' + fieldname + '"]').each(function(index) {
                                if (fieldid == index) {
                                    $(this).closest('.error').find('.help-block').html(val);
                                }
                            });
                            $('#add-product-form').find('input[name^="' + fieldname + '"]').each(function(index) {
                                if (fieldid == index) {
                                    $(this).closest('.error').find('.help-block').html(val);
                                }
                            });
                        } else {
                            $('#add-product-form').find('[name="' + key + '"]').closest('.error').find('.help-block').html(val);
                        }
                    });
                }
                ajaxindicatorstop();
            }
        });
    });


    $('#edit-product-form').submit(function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function() {
                        window.location.href = resp.link;
                    }, 2000);

                } else {
                    $.each(resp.error, function(key, val) {
                        if (key.indexOf('.') != -1) {
                            var reskey = key.split('.');
                            var fieldname = reskey[0];
                            var fieldid = reskey[1];
                            $('#edit-product-form').find('select[name^="' + fieldname + '"]').each(function(index) {
                                if (fieldid == index) {
                                    $(this).closest('.error').find('.help-block').html(val);
                                }
                            });
                            $('#edit-product-form').find('input[name^="' + fieldname + '"]').each(function(index) {
                                if (fieldid == index) {
                                    $(this).closest('.error').find('.help-block').html(val);
                                }
                            });
                        } else {
                            $('#edit-product-form').find('[name="' + key + '"]').closest('.error').find('.help-block').html(val);
                        }
                    });
                }
                ajaxindicatorstop();
            }
        });
    });

    $('#category-management-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: full_path + 'admin-category',
        order: [
            [3, "desc"]
        ],
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'category_name', name: 'category_name' },
            { data: 'title', name: 'title' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $(document).on('submit', '#Create-Category-From', function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {

                if (resp.status && resp.status === 400) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#Create-Category-From').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#Create-Category-From').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });


    $(document).on('submit', '#Update-Category-Form', function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {

                if (resp.status && resp.status === 400) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#Update-Category-Form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#Update-Category-Form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $(document).on('submit', '#AdminBillUpdateForm', function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {

                if (resp.status && resp.status === 400) {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                } else if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                if (resp.link) {
                    setTimeout(function() {
                        window.location.href = resp.link;
                    }, 4000);
                }

                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#AdminBillUpdateForm').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#AdminBillUpdateForm').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    if ($("#admin-show-notification").length > 0) {
        setInterval(function() {
            admin_show_notifications();
        }, 4000);
    }

    $(document).on('click', '.all-notofication-control', function() {
        var prop = $(this).prop('checked');
        if (prop === true) {
            $('.custom-notification-checkbox').prop('checked', true);
        } else {
            $('.custom-notification-checkbox').prop('checked', false);
        }
    });


    $(document).on('click', '.markAsinactive', function() {
        var url = full_path + 'admin-markAsInactive';
        var type = ($(this).hasClass('for1')) ? 1 : 0;
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var ids = [];
        $('.custom-notification-checkbox:checked').each(function(key, element) {
            ids.push($(element).data('id'));
        });
        if (ids.length <= 0) {
            Lobibox.notify('error', {
                continueDelayOnInactiveTab: false,
                position: 'bottom right',
                delayIndicator: false,
                msg: 'Sorry! You do not have any notification.'
            });
            return false;
        }
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            data: { ids: ids, type: type },
            success: function(resp) {
                Lobibox.notify('success', {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: resp.msg
                });
                $.each(ids, function(hey, id) {
                    $('.custom-notification-checkbox[data-id="' + id + '"]').closest('li').remove();
                });
                admin_load_all_notifications(0);
            },
        });
    });

    $(document).on('submit', '#CreateBlogForm', function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {

                if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = full_path + 'admin-blog-index';
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#CreateBlogForm').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#CreateBlogForm').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $(document).on('submit', '#UpdateBlogForm', function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: $(this).attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {

                if (resp.msg) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                }

                window.location.href = full_path + 'admin-blog-index';
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#UpdateBlogForm').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#UpdateBlogForm').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });


    // Bill JS Section

    // $('#add-card-submit-form-modal').submit(function (event) {
    //     event.preventDefault();
    //     ajaxindicatorstart();
    //     $('.help-block').html('').closest('.form-group').removeClass('has-error');
    //     var url = $(this).attr('action');
    //     var csrf_token = $('input[name=_token]').val();
    //     var data = new FormData($(this)[0]);
    //     $.ajax({
    //         url: url,
    //         headers: {'X-CSRF-TOKEN': csrf_token},
    //         type: 'POST',
    //         dataType: 'json',
    //         processData: false,
    //         contentType: false,
    //         data: data,
    //         success: function (resp) {
    //             if(resp.status=="200")
    //             {
    //                 notie.alert({
    //                     type: 'success',
    //                     text: '<i class="fa fa-check"></i> ' + resp.msg,
    //                     time: 3
    //                 });
    //             fetch_my_cards();
    //             }else{
    //                 notie.alert({
    //                     type: 'error',
    //                     text: '<i class="fa fa-times"></i> ' + resp.msg,
    //                     time: 3
    //                 });
    //             }
    //             ajaxindicatorstop();
    //         },
    //         error: function (resp) {
    //             $.each(resp.responseJSON.errors, function (key, val) {
    //                 $('#add-card-submit-form-modal').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
    //                 $('#add-card-submit-form-modal').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
    //             });
    //             ajaxindicatorstop();
    //         }
    //     })
    // });



    $('#upload-bill-submit-form').submit(function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                $('#bill_upload_step_1').attr('style', 'display:none');
                $('#dynamic_section_content').append(resp.content);
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
                    $('#upload-bill-submit-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#upload-bill-submit-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');

                    if (key == 'filepond') {
                        console.log(key);
                        $('#upload-bill-submit-form').find('#bill_image_error').html(val[0]);
                    }
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#extend-expire-date').submit(function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name=csrf-token]').attr('content');
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                $('#extend_plan_modal').modal('hide');
                if (resp.status === 200) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.message
                    });
                    window.location.reload();
                } else {
                    Lobibox.notify('error', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.message
                    });
                    window.location.reload();
                }

                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.error, function(key, val) {
                    $('#extend-expire-date').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#extend-expire-date').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#add-category-form').submit(function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var pointer = $(this);
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                Lobibox.notify('success', {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: resp.msg
                });

                setTimeout(function() {
                    window.location.href = resp.link;
                }, 2000);
                ajaxindicatorstop();
            },
            error: function(resp) {
                let multicont = [];
                $.each(resp.responseJSON.errors, function(key, val) {
                    if (key.indexOf('.') !== -1) {
                        let newkey = key.split('.');
                        let newvalue = val[0].replace(newkey[0] + '.', '');
                        pointer.find('[name="' + newkey[0] + '[' + newkey[1] + ']"]').closest('.form-group').find('.help-block').html(newvalue);
                        pointer.find('[name="' + newkey[0] + '[' + newkey[1] + ']"]').closest('.form-group').addClass('has-error');
                        if ($.inArray(newkey[0], multicont) === -1) {
                            multicont.push(newkey[0]);
                        }
                    } else {
                        pointer.find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        pointer.find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    }
                });
                ajaxindicatorstop();
            }
        });
    });

    //     $(document).on('click', '#paginate_section_by_bills .pagination a', function (event) {
    //     event.preventDefault();
    //     if ($(this).attr('href') != '#') {
    //         fetch_my_bills($(this).attr('href'));
    //     }
    // });

    // Bill JS Section End

    /*

        $('#add-category-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('');
            var url = $(this).attr('action');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

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
                    if (resp.type == 'success') {
                        Lobibox.notify('success', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                        setTimeout(function () {
                            window.location.href = resp.link;
                        }, 2000);

                    } else {
                        $(this).addClass('was-validated');
                        $.each(resp.error, function (key, val) {
                            $(".err-" + key).html(val);
                        });
                    }
                    ajaxindicatorstop();
                }
            });
        });
        $('#edit-order-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('');
            var url = $(this).attr('action');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
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
                    if (resp.type == 1) {
                        Lobibox.notify('success', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                        setTimeout(function () {
                            window.location.href = resp.link;
                        }, 2000);

                    } else if (resp.type == 2) {
                        Lobibox.notify('error', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                    } else {
                        $(this).addClass('was-validated');
                        $.each(resp.error, function (key, val) {
                            $(".err_" + key).html(val);
                        });
                    }
                    ajaxindicatorstop();
                }
            });
        });
        $('#edit-wallet-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('');
            var url = $(this).attr('action');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
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
                    if (resp.type == 1) {
                        Lobibox.notify('success', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                        setTimeout(function () {
                            window.location.href = resp.link;
                        }, 2000);

                    } else if (resp.type == 2) {
                        Lobibox.notify('error', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                    } else {
                        $(this).addClass('was-validated');
                        $.each(resp.error, function (key, val) {
                            $(".err_" + key).html(val);
                        });
                    }
                    ajaxindicatorstop();
                }
            });
        });
        $('#add-coupon-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('');
            var url = $(this).attr('action');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
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
                    if (resp.type == 'success') {
                        Lobibox.notify('success', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                        setTimeout(function () {
                            window.location.href = resp.link;
                        }, 2000);

                    } else {
                        $.each(resp.error, function (key, val) {
                            $('#add-coupon-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val);
                        });
                    }
                    ajaxindicatorstop();
                }
            })
        });
        $('#edit-subscriber-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('');
            var url = $(this).attr('action');
            var csrf_token = $('input[name="csrf-token"]').val();
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
                    if (resp.status === 200) {
                        Lobibox.notify('success', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                        setTimeout(function () {
                            window.location.href = resp.link;
                        }, 2000);

                    } else {
                        $.each(resp.errors, function (key, val) {
                            $('#edit-subscriber-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val);
                        });
                    }
                    ajaxindicatorstop();
                }
            })
        });

        $('#add-blogcategory-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('');
            var url = $(this).attr('action');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

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
                    if (resp.type == 'success') {
                        Lobibox.notify('success', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                        setTimeout(function () {
                            window.location.href = resp.link;
                        }, 2000);

                    } else {
                        $(this).addClass('was-validated');
                        $.each(resp.error, function (key, val) {
                            $(".err-" + key).html(val);
                        });
                    }
                    ajaxindicatorstop();
                }
            });
        });

        $('#tire-product-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('').closest('.form-group').removeClass('has-error');
            var url = $(this).attr('action');
            var csrf_token = $('input[name=_token]').val();
            var data = new FormData($(this)[0]);
            var desc = CKEDITOR.instances['ckeditor'].getData();
            data.append('description', desc);
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: data,
                success: function (resp) {
                    // Lobibox.notify('success', {
                    //     continueDelayOnInactiveTab: false,
                    //     position: 'bottom right',
                    //     delayIndicator: false,
                    //     msg: resp.msg
                    // });

                        window.location.href = resp.link;
                    ajaxindicatorstop();
                },
                error: function (resp) {
                    $.each(resp.responseJSON.errors, function (key, val) {
                        $("#tire-product-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $("#tire-product-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    });
                    ajaxindicatorstop();
                }
            });
        });

        $('#tire-product-update-form').submit(function (event) {
            event.preventDefault();
            ajaxindicatorstart();
            $('.help-block').html('').closest('.form-group').removeClass('has-error');
            var url = $(this).attr('action');
            var csrf_token = $('input[name=_token]').val();
            var data = new FormData($(this)[0]);
            var desc = CKEDITOR.instances['ckeditor'].getData();
            data.append('description', desc);
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: data,
                success: function (resp) {
                    // Lobibox.notify('success', {
                    //     continueDelayOnInactiveTab: false,
                    //     position: 'bottom right',
                    //     delayIndicator: false,
                    //     msg: resp.msg
                    // });

                        window.location.href = resp.link;
                    ajaxindicatorstop();
                },
                error: function (resp) {
                    $.each(resp.responseJSON.errors, function (key, val) {
                        $("#tire-product-update-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $("#tire-product-update-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    });
                    ajaxindicatorstop();
                }
            });
        });


        $('#add-blog-form').submit(function (event) {
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
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });

                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);
                    ajaxindicatorstop();
                },
                error: function (resp) {
                    $.each(resp.responseJSON.errors, function (key, val) {
                        $("#add-blog-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $("#add-blog-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    });
                    ajaxindicatorstop();
                }
            });
        });
        $('#add-shop-form').submit(function (event) {
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
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });

                    setTimeout(function () {
                        window.location.href = resp.link;
                    }, 2000);
                    ajaxindicatorstop();
                },
                error: function (resp) {
                    $.each(resp.responseJSON.errors, function (key, val) {
                        $("#add-shop-form").find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                        $("#add-shop-form").find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    });
                    ajaxindicatorstop();
                }
            });
        });

        $('#shop-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'admin-shop',
            order: [[4, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'shop_image', name: 'shop_image'},
                {data: 'first_name', name: 'first_name'},
                {data: 'shop_name', name: 'shop_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#order-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'order',
            order: [[7, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'title', name: 'title'},
                {data: 'item_price', name: 'item_price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#wallet-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'wallet',
            order: [[1, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'user_id', name: 'user_id'},
                {data: 'amount', name: 'amount'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#cancelorderrequest-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'cancel-order-request',
            order: [[7, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'order_id', name: 'order_id'},
                {data: 'item_price', name: 'item_price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#blogcategories-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'admin-blogcategories-list-datatable',
            order: [[3, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#blogs-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'adminblog',
            order: [[4, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image'},
                {data: 'title', name: 'title'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#subscribers-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'subscriber',
            order: [[4, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $(document).on('change', '.toggle-switch', function (e) {
            ajaxindicatorstart();
            var id = $(this).data('id');
            var status = $(this).prop('checked');
            $.ajax({
                url: full_path + 'admin-showcategoryfront',
                type: 'GET',
                dataType: 'json',
                data: {status: status, id: id},
                success: function (resp) {
                    if (resp.status === 200) {
                        $(this).prop('checked', status);
                        Lobibox.notify('success', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                    } else {
                        $(e.target).prop('checked', false);
                        Lobibox.notify('error', {
                            continueDelayOnInactiveTab: false,
                            position: 'bottom right',
                            delayIndicator: false,
                            msg: resp.msg
                        });
                    }
                    ajaxindicatorstop();
                }
            });
        });*/

    /*$(document).on('change', '#category', function () {
        var product_id = $(this).data('product_id');
        $.get(full_path + 'admin-subcategory-list', {category_id: $(this).val(), product_id: product_id}, function (resp) {
            $('.sub_category_render').html(resp.html);
        }, 'json');
    });*/


    if ($('.datatable').length > 0) {

        $('#user-management').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-user-list-datatable',
            order: [
                [5, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                {
                    data: 'user_verifications',
                    name: 'user_verifications',
                    render: function(data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">No</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Yes</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else {
                            return '';
                        }
                    }
                },
                { data: 'created_at', name: 'created_at' },
                { data: 'last_login', name: 'last_login' },

                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#professional-management').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-professional-list-datatable',
            order: [
                [6, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                // { data: 'type_id', name: 'type_id' },
                { data: 'name', name: 'name' },
                // { data: 'last_name', name: 'last_name' },
                { data: 'phone', name: 'phone' },
                { data: 'city', name: 'city' },
                { data: 'active', name: 'active' },
                { data: 'verified', name: 'verified' },
                { data: 'created_at', name: 'created_at' },
                { data: 'expire_date', name: 'expire_date' },
                { data: 'subscription_payments', name: 'subscription_payments' },
                { data: 'tasks', name: 'tasks' },
                { data: 'accepted', name: 'accepted' },
                { data: 'reviews', name: 'reviews' },
                { data: 'totalspent', name: 'totalspent' },
                { data: 'paid_unpaid', name: 'paid_unpaid' },
                // { data: 'deactivate', name: 'deactivate' },
                // {
                //     data: 'status', name: 'status', render: function (data, type, row) {
                //         if (data == '0') {
                //             return '<span class="label label-sm label-warning">Inactive</span>';
                //         } else if (data == '1') {
                //             return '<span class="label label-sm label-success">Active</span>';
                //         } else if (data == '3') {
                //             return '<span class="label label-sm label-danger">Delete</span>';
                //         } else {
                //             return '';
                //         }
                //     }
                // },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#location-table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [3, "desc"]
            ],
            ajax: full_path + 'location',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'is_restrict', name: 'is_restrict' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $('#support-table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [4, "desc"]
            ],
            ajax: full_path + 'admin-support',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'ticket', name: 'ticket' },
                { data: 'user_master.first_name', name: 'user_master.first_name' },
                { data: 'subject', name: 'subject' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $('#disput-table').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [4, "desc"]
            ],
            ajax: full_path + 'admin-disput',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'disput_id', name: 'disput_id' },
                { data: 'projects.title', name: 'projects.title' },
                { data: 'milestone_amount', name: 'milestone_amount' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // $('#type').on('change',function() {
        // var type = this.value;
        // var pid = $('#Category-table').data('pid');
        $('#Category-table').DataTable({
            "bPaginate": false,
            processing: false,
            serverSide: true,
            "bDestroy": true,
            // ajax: full_path + (pid != "" ? 'admin-category?pid=' + pid : 'admin-category'),
            ajax: {
                "url": full_path + 'admin-category',
                // "url":full_path + (pid != "" ? 'admin-category?pid=' + pid : 'admin-category'),
                // "data":{
                //     'type':type
                // }
            },
            order: [
                [3, "asc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                // { data: 'parent_category_name', name: 'parent_category_name',searchable: false},
                { data: 'translation_categories.category_name', name: 'translation_categories.category_name' },
                { data: 'categories.created_at', name: 'categories.created_at' },
                { data: 'categories.status', name: 'categories.status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });
        // });

        var pid = $('#pid').val();
        $('#subcategory-table').DataTable({
            "bPaginate": false,
            processing: false,
            serverSide: true,
            "bDestroy": true,
            // ajax: full_path + (pid != "" ? 'admin-category?pid=' + pid : 'admin-category'),
            ajax: {
                "url": full_path + 'admin-subcategory',
                // "url":full_path + (pid != "" ? 'admin-category?pid=' + pid : 'admin-category'),
                "data": {
                    'pid': pid
                }
            },
            order: [
                [2, "asc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                // { data: 'parent_category_name', name: 'parent_category_name',searchable: false},
                { data: 'translation_categories.category_name', name: 'translation_categories.category_name' },
                { data: 'categories.created_at', name: 'categories.created_at' },
                { data: 'categories.status', name: 'categories.status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });


        var prjectbl = $('#Project-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-project',
            order: [
                [5, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'tag', name: 'tag' },
                { data: 'user_id', name: 'user_id' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });
        $(document).on('change', '#search_by_project_tag', function() {
            prjectbl.column(2).search($(this).val()).draw();
        });


        $('#user-document-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'user-documents',
            order: [
                [4, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'user_id', name: 'user_id' },
                { data: 'document_type', name: 'document_type' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });
        $('#Skill-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-skill',
            order: [
                [2, "desc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'skill', name: 'skill' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });

        $('#transaction-management').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'transaction',
            order: [
                [6, "DESC"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'user_master.first_name', name: 'user_master.first_name' },
                { data: 'courses.title', name: 'courses.title' },
                { data: 'total_amount', name: 'total_amount' },
                { data: 'pay_amount', name: 'pay_amount' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $('#orders-management').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-orders-list-datatable',
            order: [
                [6, "DESC"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'order_id', name: 'order_id' },
                { data: 'user_master.first_name', name: 'user_master.first_name' },
                { data: 'products.title', name: 'products.title' },
                { data: 'amount', name: 'amount' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $('#withdrawal-management').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-withdrawal',
            order: [
                [5, "DESC"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'transaction_id', name: 'transaction_id' },
                { data: 'user_master.first_name', name: 'user_master.first_name' },
                { data: 'amount', name: 'amount' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#plans-management').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-subplans-list-datatable',
            order: [
                [4, "asc"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'interval_period', name: 'interval_period' },
                { data: 'status', name: 'status' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });
        var cuid = $('#usercourses-management').data('uid');
        $('#usercourses-management').DataTable({
            processing: true,
            serverSide: true,
            ajax: full_path + 'admin-user-course/' + cuid,
            order: [
                [5, "DESC"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'courses.title', name: 'courses.title' },
                { data: 'states.name', name: 'states.name' },
                { data: 'user_subscription_plans.package_name', name: 'user_subscription_plans.package_name' },
                { data: 'payment_details.pay_amount', name: 'payment_details.pay_amount' },
                { data: 'user_subscription_plans.start_date', name: 'user_subscription_plans.start_date' },
                { data: 'user_subscription_plans.end_date', name: 'user_subscription_plans.end_date' },
                { data: 'user_subscription_plans.status', name: 'user_subscription_plans.status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]

        });
    }

    $('#shop-update-form').submit(function(event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                if (resp.type == 'success') {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    setTimeout(function() {
                        window.location = resp.link;
                    }, 3000);
                } else if (resp.type == 'failure') {
                    $.each(resp.error, function(key, val) {
                        $('#shop-update-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val);
                    });
                } else {

                }
                ajaxindicatorstop();
            }
        });
    });

    $(document).on('click', '#t_project_store_btn', function(event) {
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
            headers: { 'X-CSRF-TOKEN': csrf_token },
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function(resp) {
                if (resp.status === 200) {
                    Lobibox.notify('success', {
                        continueDelayOnInactiveTab: false,
                        position: 'bottom right',
                        delayIndicator: false,
                        msg: resp.msg
                    });
                    $('#project_store_form')[0].reset();
                    if (resp.link) {
                        setTimeout(function() {
                            window.location.href = resp.link;
                        }, 4000);
                    }
                }
                ajaxindicatorstop();
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(key, val) {
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

});

function change_year(value) {
    var url = full_path + 'admin-change_year/' + value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Brand----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].brand_id + "'>" + data[i].b_name + "</option>";
                }
                $("#show-brand-data").html(htmldesign);
            }
        }
    });
}


function change_brand(obj) {

    var url = full_path + 'admin-change_brand/' + $(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Model----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].id + "'>" + data[i].model_name + "</option>";
                }
                $("#show-model-data").html(htmldesign);
            }
        }
    });
}


function change_model(obj) {
    var url = full_path + 'admin-change_model/' + $(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Body----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                }
                $("#show-body-data").html(htmldesign);
            }
        }
    });
}

function change_body(value) {
    var url = full_path + 'admin-change_body/' + value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Trim----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                }
                $("#show-trim-data").html(htmldesign);
            }
        }
    });
}

// function change_trim(value)
// {
//     var url= full_path + 'admin-change_trim/'+value;
//     $.ajax({
//         url: url,
//         dataType: 'json',
//         // processData: false,
//         // contentType: false,
//         success: function (resp) {
//             if (resp.status == 'success') {
//                 var data=resp.model;
function tire_change_brand(obj) {

    var url = full_path + 'admin-change_brand/' + $(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Model----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].id + "'>" + data[i].model_name + "</option>";
                }
                $("#show-model-data").html(htmldesign);
            }
        }
    });
}


function tire_change_model(obj) {
    var url = full_path + 'admin-change_model/' + $(obj).val();
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Body----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                }
                $("#show-body-data").html(htmldesign);
            }
        }
    });
}

function tire_change_body(value) {
    var url = full_path + 'admin-change_body/' + value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Trim----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                }
                $("#show-trim-data").html(htmldesign);
            }
        }
    });
}


function change_category(value) {
    var url = full_path + 'admin-change_category/' + value;
    $.ajax({
        url: url,
        dataType: 'json',
        // processData: false,
        // contentType: false,
        success: function(resp) {
            if (resp.status == 'success') {
                var data = resp.model;
                var htmldesign = "";
                htmldesign += "<option value=''>-----Select Subcategory----</option>";
                for (i = 0; i < data.length; i++) {
                    htmldesign += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                }
                $("#subcategory_list").html(htmldesign);
            }
        }
    });
}

function deleteBlogCategory(obj) {
    $.confirm({
        title: 'Delete Blog Category',
        content: 'Are you sure to delete this blog category?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function() {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function() {}
        }
    });
}

function deleteSubscriber(obj) {
    $.confirm({
        title: 'Delete Subscriber',
        content: 'Are you sure to delete this Subscriber?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function() {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function() {}
        }
    });
}

function deleteCategory(obj) {
    $.confirm({
        title: 'Delete Category',
        content: 'Are you sure to delete this category?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function() {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function() {}
        }
    });
}

function changenotistatus(id, obj) {
    var location = $(obj).data('location');
    $.ajax({
        url: full_path + 'changenotistatus',
        type: 'get',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            if (data.value == "success") {
                window.location.href = location;
            }
        }
    });
}

function loadmorenoti() {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val())
    var rowperpage = 15;
    row = row + rowperpage;
    console.log(row);
    if (row <= allcount) {
        var csrf_token = $('input[name=_token]').val();
        $("#row").val(row);
        $.ajax({
            url: full_path + 'load-notification',
            type: 'get',
            dataType: 'json',
            data: { row: row },
            beforeSend: function() {
                $("#loadmore").text("Loading...");
            },
            success: function(resp) {

                $("#loadnoti").append(resp.html);
                setTimeout(function() {
                    var rowno = row + rowperpage;
                    if (rowno >= allcount) {
                        $('#loadmore').hide();
                    } else {
                        $("#loadmore").text("Load more");
                    }
                }, 2000);

            }
        });
    }
}

function readImageURL(input) {
    $('[name="screenshot"]').val(0);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(input).closest('.row').find('.show-photo').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// function deleteCategory(obj) {
//     $.confirm({
//         title: 'Delete Category',
//         content: 'Are you sure to delete this category?',
//         type: 'red',
//         typeAnimated: true,
//         buttons: {
//             confirm: {
//                 text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
//                 btnClass: 'btn-red',
//                 action: function () {
//                     window.location.href = $(obj).attr('data-href');
//                 }
//             },
//             cancel: function () {}
//         }
//     });
// }

function loadMagnifier() {
    $('.imagegallery').magnificPopup({
        delegate: 'div.for-all', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            enabled: false
        },
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
}

function changenotistatus(id, obj) {
    var location = $(obj).data('location');
    $.ajax({
        url: full_path + 'changenotistatus',
        type: 'get',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            if (data.value == "success") {
                window.location.href = location;
            }
        }
    });
}

function loadmorenoti() {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val())
    var rowperpage = 15;
    row = row + rowperpage;
    console.log(row);
    if (row <= allcount) {
        var csrf_token = $('input[name=_token]').val();
        $("#row").val(row);
        $.ajax({
            url: full_path + 'load-notification',
            type: 'get',
            dataType: 'json',
            data: { row: row },
            beforeSend: function() {
                $("#loadmore").text("Loading...");
            },
            success: function(resp) {

                $("#loadnoti").append(resp.html);
                setTimeout(function() {
                    var rowno = row + rowperpage;
                    if (rowno >= allcount) {
                        $('#loadmore').hide();
                    } else {
                        $("#loadmore").text("Load more");
                    }
                }, 2000);

            }
        });
    }
}

function admin_show_notifications() {
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    // var csrf_token = $('input[name=_token]').val();
    $.ajax({
        url: full_path + 'admin-get-notifications',
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'POST',
        dataType: 'json',
        success: function(resp) {
            $('#admin-show-notification').html(resp.content);
            if (resp.total_unread_notification > 0) {
                $('.showadminnoticount').html(resp.total_unread_notification);
            } else {
                $('.showadminnoticount').html('0');
            }
        }
    });
}

function admin_load_all_notifications() {
    if (notification_offset == 0) {
        $('[name="notification_offset"]').val(notification_offset);
    }
    $('.custom-notification-list').append(contentLoader);
    var notification_offset = $('input[name="notification_offset"]').val();
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    // var csrf_token = $('input[name=_token]').val();
    $.ajax({
        type: 'GET',
        headers: { 'X-CSRF-TOKEN': csrf_token },
        url: full_path + 'admin-notification',
        dataType: 'json',
        data: { notification_offset: notification_offset },
        success: function(resp) {
            $('.custom-notification-list').find('.insideLoader').remove();
            $('.custom-notification-list').append(resp.content);
            $('[name="notification_offset"]').val(resp.notification_offset);
            $('[name="notification_total"]').val(resp.notification_total);
        }
    });
}

function pay_installment(installment_id) {
    $.confirm({
        title: 'Pay Installment',
        content: 'Are you sure to pay this installment?',
        type: 'green',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-green',
                action: function() {
                    ajaxindicatorstart();
                    var url = full_path + "pay-installment";
                    var csrf_token = $('meta[name=csrf-token]').attr('content')
                    var data = new FormData();
                    data.append("installment_id", installment_id);
                    $.ajax({
                        url: url,
                        headers: { 'X-CSRF-TOKEN': csrf_token },
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data,
                        success: function(resp) {
                            if (resp.status && resp.status === 200) {
                                Lobibox.notify('success', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                                window.location.href = resp.link;
                            } else if (resp.status && resp.status === 400) {
                                Lobibox.notify('error', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                            } else {
                                $.each(resp.errors, function(key, val) {
                                    $('#express-checkout-form-submit').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                                    $('#express-checkout-form-submit').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                                });
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: function() {}
        }
    });

}

// Bill JS Section
function show_addCard_modal(obj) {
    // console.log($('#select_card').find(":selected").val());
    var value = $(obj).find(":selected").val();
    if (value == '') {
        $('#add-card-submit-form-modal').trigger("reset");
        $('#add-card-submit-form-modal').find('span').empty();
        $('#add-card-submit-form-modal').find('div').removeClass('has-error');
        $('#addCardModal').modal("show");
    } else if (value == 2) {
        $('#addCardModal').modal("hide");
    } else {
        $('#addCardModal').modal("hide");
    }
}

function show_customAmount_field(obj) {
    var value = $(obj).find(":selected").val();
    if (value == '') {
        $('#custom_amount_field').attr("style", "display:block");
        $('#my_avaliable_balance').attr("style", "display:none");
    } else {
        // $('#my_avaliable_balance').attr("style","display:block");
        $('#custom_amount_field').attr("style", "display:none");
    }
}

function show_customDate_field(obj) {
    var value = $(obj).find(":selected").val();
    if (value == 1) {
        $(obj).parent().find("p").html("<i class='icofont-info-circle'></i> This bill will be scheduled to be paid as soon as it's been processed.");
        $('#custom_date_field').attr("style", "display:none");
    } else if (value == '') {
        $(obj).parent().find("p").html("");
        $('#custom_date_field').attr("style", "display:block");
    }
}

function cancel_card_save_modal() {
    $('#add-card-submit-form-modal').trigger("reset");
    $('#add-card-submit-form-modal').find('span').empty();
    $('#add-card-submit-form-modal').find('div').removeClass('has-error');
    $('#addCardModal').modal("hide");
}

function fetch_my_cards() {
    //    console.log('fetch_my_cards');
    $.ajax({
        url: full_path + 'fetch-my-cards',
        type: 'GET',
        dataType: 'json',
        success: function(resp) {
            if (resp) {
                $('#addCardModal').modal("hide");
                //                console.log(resp.content);
                $('#my_cards_dropdown').html(resp.content);
                $('select').selectpicker();
            }
        }
    });
}

function back_to_bill_step_1() {

    $('#bill_upload_step_1').attr('style', 'display:block');
    $("#bill_upload_step_2").remove();
    // $('#dynamic_section_content').append(resp.content);
}

function store_bill() {
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var data = new FormData($('#upload-bill-submit-form')[0]);
    ajaxindicatorstart();
    $.ajax({
        url: full_path + 'admin-store-bill-details',
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function(resp) {
            Lobibox.notify('success', {
                continueDelayOnInactiveTab: false,
                position: 'bottom right',
                delayIndicator: false,
                msg: resp.msg
            });
            $('#upload-bill-submit-form')[0].reset();
            window.location.href = resp.link;
            ajaxindicatorstop();
        }
    });
}

function fetch_my_bills(url) {
    var filter = $('#bills_filter_option').find(":selected").val();
    // console.log(filter);
    if (url == null) {
        url = full_path + 'get-my-bills-ajax';
    }
    // var csrf_token = $('meta[name=csrf-token]').attr('content');
    ajaxindicatorstart();
    $.ajax({
        url: url,
        // headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'GET',
        data: { filter: filter },
        dataType: 'json',
        success: function(resp) {
            $('#dynamic_bill_list').html(resp.content);
            if (resp.links == "") {
                $("#paginate_section_by_bills").addClass("d-none");
            } else {
                $("#paginate_section_by_bills").removeClass("d-none");
                $("#paginate_section_by_bills").html(resp.links);
            }
            ajaxindicatorstop();
        }
    });

}

function show_warning_modal(msg) {
    $('#warning_message').text(msg);
    $('#show_warning_modal').modal('show');
}

function confirmApproveOrReject(obj) {
    var title = $(obj).data('title');
    var url = $(obj).data('href');
    $.confirm({
        title: title,
        content: 'Are you sure to ' + title + ' ?',
        type: 'green',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-green',
                action: function() {
                    ajaxindicatorstart();
                    var csrf_token = $('meta[name=csrf-token]').attr('content');
                    $.ajax({
                        url: url,
                        headers: { 'X-CSRF-TOKEN': csrf_token },
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(resp) {
                            if (resp.status === 200) {
                                Lobibox.notify('success', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                                window.location.reload();
                            } else {
                                Lobibox.notify('error', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: function() {}
        }
    });
}

function deleteUser(obj) {
    $.confirm({
        title: 'Delete User',
        content: 'Are you sure to delete this user?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function() {
                    window.location.href = $(obj).attr('data-href');
                }
            },
            cancel: function() {}
        }
    });
}

function extend_plan(obj) {
    $user_id = $(obj).attr('data-id')
    $subscription_id = $(obj).attr('data-subscription')
    $('#extend_plan_modal').modal('show');
    $('#user_id').val($user_id);
    $('#subscription_id').val($subscription_id);
}


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
                action: function() {
                    ajaxindicatorstart();
                    var csrf_token = $('meta[name=csrf-token]').attr('content');
                    $.ajax({
                        url: url,
                        headers: { 'X-CSRF-TOKEN': csrf_token },
                        type: 'DELETE',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(resp) {
                            if (resp.status === 200) {
                                Lobibox.notify('success', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                                ajaxindicatorstop();

                                $('#location_id' + resp.id).addClass('d-none')

                                window.location.reload();
                                if (!empty(tbl)) {
                                    $('#' + tbl + '-table').DataTable().ajax.reload();
                                }

                            } else {
                                Lobibox.notify('error', {
                                    continueDelayOnInactiveTab: false,
                                    position: 'bottom right',
                                    delayIndicator: false,
                                    msg: resp.msg
                                });
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: function() {}
        }
    });
}


function paid_unpaid_plan(subscription_id, user_id, payment_status) {
    var subscription_id = subscription_id;
    var user_id = user_id;
    var payment_status = payment_status;
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var url = full_path + 'paid_unpaid_subscription';
    var data = { user_id: user_id, subscription_id: subscription_id, payment_status: payment_status };
    ajaxindicatorstart();
    $.ajax({
        url: url,
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: "POST",
        dataType: "json",
        //processData: false,
        //contentType: false,
        data: data,
        success: function(resp) {
            if (resp.status == "200") {
                Lobibox.notify('success', {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: resp.message
                });
            } else {
                console.log(resp);
                Lobibox.notify('error', {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: resp.message
                });
            }
            setTimeout(function() {
                location.reload();
            }, 2000);
            ajaxindicatorstop();
        },
    });
}

function initMap() {
    var input = document.getElementById('searchMapInput');
    var input1 = document.getElementById('searchMapInput1');
    var input2 = document.getElementById('searchMapInput2');
    var input3 = document.getElementById('searchMapInput3');
    var input4 = document.getElementById('searchMapInput4');
    var input5 = document.getElementById('searchMapInput5');


    if (input != '') {
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.setComponentRestrictions({ 'country': ['isr'] });

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
    if (input1 != '') {
        var autocomplete1 = new google.maps.places.Autocomplete(input1);

        autocomplete1.setComponentRestrictions({ 'country': ['isr'] });

        autocomplete1.addListener('place_changed', function() {
            var place1 = autocomplete1.getPlace();

            document.getElementById('location-snap1').value = place1.formatted_address;
            document.getElementById('lat-span1').value = place1.geometry.location.lat();
            document.getElementById('lon-span1').value = place1.geometry.location.lng();
        });
    }
    if (input2 != '') {
        var autocomplete2 = new google.maps.places.Autocomplete(input2);

        autocomplete2.setComponentRestrictions({ 'country': ['isr'] });

        autocomplete2.addListener('place_changed', function() {
            var place2 = autocomplete2.getPlace();

            document.getElementById('location-snap2').value = place2.formatted_address;
            document.getElementById('lat-span2').value = place2.geometry.location.lat();
            document.getElementById('lon-span2').value = place2.geometry.location.lng();
        });
    }
    if (input3 != '') {
        var autocomplete3 = new google.maps.places.Autocomplete(input3);

        autocomplete3.setComponentRestrictions({ 'country': ['isr'] });

        autocomplete3.addListener('place_changed', function() {
            var place3 = autocomplete3.getPlace();

            document.getElementById('location-snap3').value = place3.formatted_address;
            document.getElementById('lat-span3').value = place3.geometry.location.lat();
            document.getElementById('lon-span3').value = place3.geometry.location.lng();
        });


    }
    if (input4 != '') {
        var autocomplete4 = new google.maps.places.Autocomplete(input4);

        autocomplete4.setComponentRestrictions({ 'country': ['isr'] });

        autocomplete4.addListener('place_changed', function() {
            var place4 = autocomplete4.getPlace();

            document.getElementById('location-snap4').value = place4.formatted_address;
            document.getElementById('lat-span4').value = place4.geometry.location.lat();
            document.getElementById('lon-span4').value = place4.geometry.location.lng();
        });
    }
    if (input5 != '') {
        var autocomplete5 = new google.maps.places.Autocomplete(input5);

        autocomplete5.setComponentRestrictions({ 'country': ['isr'] });

        autocomplete5.addListener('place_changed', function() {
            var place5 = autocomplete5.getPlace();

            document.getElementById('location-snap5').value = place5.formatted_address;
            document.getElementById('lat-span5').value = place5.geometry.location.lat();
            document.getElementById('lon-span5').value = place5.geometry.location.lng();
        });
    }


}

$('#category_id').on('change', function() {
    var category_id = $(this).val();
    var csrf_token = $('meta[name="csrf-token"]').attr("content");
    var url = full_path + "admin-signup-subcategory";
    var values = $('#show-signup-subcategory').val();

    // console.log(category_id);
    var data = {
        category_id: category_id,
        values: values
    };
    ajaxindicatorstart();
    // var hidden_city = $('#hidden_city').val($('#show-signup-subcategory').val());
    // var def= $('#show-signup-subcategory').select2().val($('#hidden_city').val());
    // console.log(def);
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
                // $.each($("#show-signup-subcategory"), function(){
                //     $(this).select2('val', values);
                // });
            } else {
                ajaxindicatorstop();

            }

        },
    });

});




// function WillNotReview()
// {
//     $('#bill_review_request_modal').modal('hide');
//     store_bill();
// }

// function WillReview()
// {
//     $('#bill_review_request_modal').modal('hide');
//     var csrf_token = $('input[name=_token]').val();
//     var data = new FormData($('#upload-bill-submit-form')[0]);
//     data.append('is_review_requested', '1');
//     ajaxindicatorstart();
//     $.ajax({
//         url: full_path + 'store-bill-details',
//         headers: {'X-CSRF-TOKEN': csrf_token},
//         type: 'POST',
//         dataType: 'json',
//         processData: false,
//         contentType: false,
//         data: data,
//         success: function (resp) {
//             notie.alert({
//                     type: 'success',
//                     text: '<i class="fa fa-check"></i> ' + resp.msg,
//                     time: 3
//                 });
//             $('#upload-bill-submit-form')[0].reset();
//             window.location.href = resp.link;
//             ajaxindicatorstop();
//         }
//     });
// }

// function show_review_request_modal() {
//     $('#bill_review_request_modal').modal('show');
// }

// function dicard_the_bill(bill_id){
//     var csrf_token = $('input[name=_token]').val();
//     ajaxindicatorstart();
//     $.ajax({
//         url: full_path + 'discard-the-bill',
//         headers: {'X-CSRF-TOKEN': csrf_token},
//         type: 'POST',
//         dataType: 'json',
//         data: {'bill_id':bill_id},
//         success: function (resp) {
//             notie.alert({
//                     type: 'success',
//                     text: '<i class="fa fa-check"></i> ' + resp.msg,
//                     time: 3
//                 });
//             window.location.href = resp.link;
//             ajaxindicatorstop();
//         }
//     });
// }

// function confirm_the_bill(bill_id){
//     var csrf_token = $('input[name=_token]').val();
//     // console.log(bill_id);
//     // return false;
//     ajaxindicatorstart();
//     $.ajax({
//         url: full_path + 'accept-review-bill',
//         headers: {'X-CSRF-TOKEN': csrf_token},
//         type: 'POST',
//         dataType: 'json',
//         data: {'bill_id':bill_id},
//         success: function (resp) {
//             notie.alert({
//                     type: 'success',
//                     text: '<i class="fa fa-check"></i> ' + resp.msg,
//                     time: 3
//                 });
//             window.location.href = resp.link;
//             ajaxindicatorstop();
//         }
//     });
// }


// Bill JS Section End