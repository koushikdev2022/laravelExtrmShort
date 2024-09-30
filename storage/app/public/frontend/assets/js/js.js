$(document).ready(function() {
    $('.js-example-basic-single').select2({
        placeholder: 'Select an option'
    });    
});
$(document).ready(function() {
    $('.category_search').select2({
        
    });    
});
$(document).ready(function() {
    $('.job_types').select2({
        
    });    
});

$('#home-slider').owlCarousel({
    loop:true,
    margin:15,
    nav:true,
    slideSpeed : 100,
    singleItem:true,
    dots:false,
    autoPlay : false,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        },
        1300:{
            items:4
        }
    }
})

$('#portfolio-slider').owlCarousel({
    loop:true,
    margin:15,
    nav:true,
    slideSpeed : 100,
    singleItem:true,
    dots:false,
    autoPlay : false,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        },
        1300:{
            items:3
        }
    }
})

$('#project-slider').owlCarousel({
    loop:true,
    margin:15,
    nav:true,
    dots:false,
    slideSpeed : 100,
    singleItem:true,
    autoPlay : false,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        },
        1300:{
            items:4
        }
    }
})

$('#testi-slider').owlCarousel({
    loop:true,
    margin:15,
    nav:false,
    dots:true,
    slideSpeed : 100,
    // singleItem:true,
    autoPlay : false,
    // navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
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
})


