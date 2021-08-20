//articles-carousel
$(document).ready(function() {
    $('.articles-carousel').owlCarousel({
        loop: false,
        margin: 10,
        rtl: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    })



    //  hide alert success
    $('div.alert').not('.alert-danger').delay(3000).fadeOut(350);

});