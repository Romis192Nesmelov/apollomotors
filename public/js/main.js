$(window).on('load', function () {
    $('input[name=phone]').mask("+7(999)999-99-99");

    //fancybox init
    $('.fancybox').fancybox({
        'autoScale': true,
        'touch': false,
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 500,
        'speedOut': 300,
        'autoDimensions': true,
        'centerOnScroll': true
    });


    //Carousel actions
    $('#actions-block').owlCarousel({
        margin: 10,
        loop: true,
        nav: false,
        autoplay: true,
        autoplayTimeout: 5000,
        dots: true,
        items: 1,
        smartSpeed: 1200,
        // navText:[navButtonBlack1,navButtonBlack2]
    });

    //Carousel clients
    let navButtonBlack1 = '<img src="/storage/images/arrow_left.svg" />',
        navButtonBlack2 = '<img src="/storage/images/arrow_right.svg" />';
    $('#clients-block').owlCarousel({
        margin: 10,
        loop: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 3000,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        },
        navText:[navButtonBlack1,navButtonBlack2]
    });

    // Show more offers repairs
    $('#show-more-offers-repair').click(function() {
        $('.more-offers-repair').fadeIn();
        $(this).remove();
    });

    // Move on feedback-plate
    let feedbackPlate = $('#feedback-plate');
    feedbackPlate.css('top',-1 * (feedbackPlate.height() + 10));
    setTimeout(function(){
        feedbackPlate.animate({'top':'50%'},'slow');
    }, 1000);
});
