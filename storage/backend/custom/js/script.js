function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

function getLeadChart(obj) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + 'admin-get-leadchart',
        type: 'GET',
        dataType: 'json',
        data: { year: $(obj).val() },
        success: function(resp) {
            if (resp.status && resp.status === 200) {
                $('#leadchartContainer').html(resp.content);
            }
            ajaxindicatorstop();
        }
    });
}

function getSubscriptionChart(obj) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + 'admin-get-subscriptionchart',
        type: 'GET',
        dataType: 'json',
        data: { year: $(obj).val() },
        success: function(resp) {
            if (resp.status && resp.status === 200) {
                $('#subscriptionchartContainer').html(resp.content);
            }
            ajaxindicatorstop();
        }
    });
}