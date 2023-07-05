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

    let navButtonBlack1 = '<img src="/storage/images/arrow_left.svg" />',
        navButtonBlack2 = '<img src="/storage/images/arrow_right.svg" />';

    //Carousel brands
    $('#brands-block').owlCarousel({
        margin: 10,
        loop: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 2000,
        dots: false,
        responsive: {
            0: {
                items: 3
            },
            768: {
                items: 5
            },
            1000: {
                items: 8
            }
        },
        navText:[navButtonBlack1,navButtonBlack2]
    });

    //Carousel clients
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
    let moreOffersRepair = $('.more-offers-repair'),
        showMoreOffersRepair = $('#show-more-offers-repair'),
        collapseMoreOffersRepair = $('#collapse-more-offers-repair');

    showMoreOffersRepair.click(function() {
        moreOffersRepair.fadeIn();
        $(this).addClass('d-none');
        collapseMoreOffersRepair.removeClass('d-none');
    });

    collapseMoreOffersRepair.click(function() {
        moreOffersRepair.fadeOut();
        $(this).addClass('d-none');
        showMoreOffersRepair.removeClass('d-none');
    });

    // Move on feedback-plate
    let feedbackPlate = $('#feedback-plate');
    feedbackPlate.css('top',-1 * (feedbackPlate.height() + 10));
    setTimeout(function(){
        feedbackPlate.animate({'top':'50%'},'slow');
        fixingMainMenu();
    }, 1000);

    $(window).scroll(function() {
        fixingMainMenu();
    });
});

function fixingMainMenu() {
    let mainMenuFix = $('#main-nav-fix');
    if ($(window).scrollTop() > 323) mainMenuFix.css('top',0);
    else mainMenuFix.css('top',-73);
}
