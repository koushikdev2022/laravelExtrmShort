$(document).ready(function() {
    //HEADER
    $(window).on('scroll', function() {
        var _fixed_height = $('.site-header').height();
        var _win_scoll = $(this).scrollTop();
        var _header = $('.site-header');
        if (_win_scoll > _fixed_height && !_header.hasClass('sticky')) {
            _header.addClass('sticky');
        } else if (_win_scoll <= _fixed_height && _header.hasClass('sticky')) {
            _header.removeClass('sticky');
        }
    });
    //VIDEO PLAY HOVER
    $('.video-box').on('mouseover mouseout', function(e) {
        const evt = e.type;
        if (evt === 'mouseover') {
            $(this).find('.video-link').children("video").trigger('play');
        }
        if (evt === 'mouseout') {
            $(this).find('.video-link').children("video").trigger('pause');
        }
    });
    //TESTIMONIAL SLIDER
    $('.testimonial-slider').owlCarousel({
        loop:true,
        margin:30,
        autoplay:false,
        autoplayHoverPause: true,
        smartSpeed: 1000,
        autoplayTimeout: 3000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:2
            }
        }
    });
    //PASSWORD SOW HIDE
    $('.pass-holder span').click(function(){
        $(this).parent().toggleClass('pass-show');
        if($('.pass-holder').hasClass('pass-show')){
            $(this).parent('.pass-holder').find('input').attr("type", "text");
        }else{
            $(this).parent('.pass-holder').find('input').attr("type", "password");
        }
    });
    //FILTER
    $('.filter-box h4').on('click',function(){
        $(this).closest('.filter-box').toggleClass('filter-closed');
    });

    //MODAL
    $(window).on('load', function() {
        $('#topic').modal('show');
    });
});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})