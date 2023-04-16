$('.carousel-feedback').owlCarousel({
    loop:true,
    stagePadding: 150,
    margin:20,
    responsiveClass:true,
    responsive:{
        480:{
            items:1,
        },
        768:{
            items:1,
        },
        1024:{
            items:3
        }
    }
});