
            // fixed header //

            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll >= 100) {
                    $(".navbar").removeClass("navbar-transparent").addClass("navbar-default");
                    $(".navbar").addClass("animated");
                    $(".navbar").addClass("fadeInDown");
                } else if (scroll <= 1) {
                    $(".navbar").removeClass("navbar-default").addClass("navbar-transparent");
                    $(".navbar").removeClass("animated");
                    $(".navbar").removeClass("fadeInDown");
                }
            });


            jQuery(document).ready(function ($) {

        // scroll to top //

        $(window).scroll(function () {
if ($(this).scrollTop() > 100) {
$('#scroll_top').show();
        } else {
$('#scroll_top').hide();
        }
});
        $('#scroll_top').click(function () {
$("html, body").animate({scrollTop: 0}, 1500);
        return false;
        });
            });

$(document).ready(function () {
        $(".header-menu #nav-toggle").click(function () {
$(".header-menu .heder_menuarea").slideToggle('slow');
        $("#navigation-icon").toggle();
        $("#times-icon").toggle();
        });
        
        $(".datepicker").datepicker({
                dateFormat: "dd/mm/yy",
                beforeShow: function (input, inst) {
                    setTimeout(function () {
                        inst.dpDiv.css({
                            top: $(".datepicker").offset().top + 45,
                            left: $(".datepicker").offset().left
                        });
                    }, 0);
                }
            });
});

$(document).ready(function () {
        $(".header-top-menu #menu-toggletwo").click(function () {
$(".header-top-menu .hd-top-menu").slideToggle('slow');
        $("#navigation-icontwo").toggle();
        $("#times-icontwo").toggle();
        });
});


    $(document).ready(function () {
        $('.navbar-light .dmenu').hover(function () {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function () {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });
    });
    $(document).ready(function () {
        $(".megamenu").on("click", function (e) {
            e.stopPropagation();
        });
        $('.navbar-light .dmenu').on("click", function (e) {
            e.stopPropagation();
        });
    });


$(document).ready(function () {
        $('.navbar-light .dmenu').hover(function () {
$(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function () {
$(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });
});
$(document).ready(function () {
        $(".megamenu").on("click", function (e) {
e.stopPropagation();
        });
});

function checkValue(element) {
// check if the input has any value (if we've typed into it)
        if ($(element).val())
        $(element).addClass('has-value');
        else
        $(element).removeClass('has-value');
}

$(document).ready(function () {
// Run on page load
        $('.form-control').each(function () {
checkValue(this);
        })
// Run on input exit
        $('.form-control').blur(function () {
checkValue(this);
        });
});



/* global notie, full_path, grecaptcha */
function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #4179eb;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
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

function notification(msg, showtime) {
    notie.alert({
        type: 'success',
        text: '<i class="fa fa-check"></i> ' + msg,
        time: (showtime !== null) ? showtime : 4
    });
}
function err_msg(msg, showtime) {
    notie.alert({
        type: 'error',
        text: '<i class="fa fa-times"></i> ' + msg,
        time: (showtime !== null) ? showtime : 4
    });
}

function ajaxindicatorwithtextstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #4179eb;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i><br /><div>Please wait uploading is on process...</div></div><div class="bg"></div></div>');
    }else{
		jQuery('body').find('#resultLoading').remove();
		jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #4179eb;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i><br /><div>Please wait uploading is on process...</div></div><div class="bg"></div></div>');
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
        'width': '340px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '18px',
        'z-index': '10',
        'color': '#000'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

// $(document).ready(function(){
//         var img ='/storage/uploads/frontend/profile_picture/original/';
//         var default_img='/storage/frontend/images/profile_user.png';
//         $("#addUserAutocomplete").autocomplete({
//            source: function( request, response ) {
//              $.ajax({
//                url: full_path+"add-user-autocomplete",
//                dataType: "json",
//                data: {
//                  q: request.term
//                },
//                success: function( data ) {
//                  response( data );
                 
//                }
//              });
//            },
//            minLength: 2,
//            scroll:true,
//            select: function( event, ui ) {
//             //  var link = ui.item.link;
//             //  window.location.href = link;
//             $("#txtAllowSearchMessageID").val(ui.item.id);
//            },
//            open: function() {
//              $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
//            },
//            close: function() {
//              $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
//            }
//          });
//          $("#addUserAutocomplete").autocomplete( "instance" )._renderItem = function( ul, item ) {
//             if(!item.img)
//             {
//                if(item.value=='No Record Found.')
//                {
//                    var image_div="";
//                }
//                else{
//                    var image_div="<img src="+default_img+" style=height:40px;width:40px;border-radius:50%;>";
//                }
               
//             }else{

//                var image_div="<img src="+img+item.img+" style=height:40px;width:40px;border-radius:50%;>";
//             }
//            return $( "<li>" )
//              .append( "<div>"+image_div+""+' '+ item.value + "</div>" )
//              .appendTo( ul );
//          }; 
// });

function search_button(){
    ajaxindicatorstart();
}


