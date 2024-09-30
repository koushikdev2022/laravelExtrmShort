$('#testi-slider').owlCarousel({
    loop:true,
    margin:15,
    nav:false,
    dots:true,
    // rtl:true,
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

