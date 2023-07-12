$(window).on('load', function () {
    $('input[name=phone]').mask("+7(999)999-99-99");

    setTimeout(function () {
        windowResize();
        $('#loader').remove();
    },1000);

    $(window).resize(function() {
        windowResize();
    });

    // Move on feedback-plate
    let feedbackPlate = $('#feedback-plate');
    feedbackPlate.css('top',-1 * (feedbackPlate.height() + 10));
    setTimeout(function(){
        feedbackPlate.animate({'top':'50%'},'slow');
        fixingMainMenu();
    }, 2000);

    $(window).scroll(function() {
        fixingMainMenu();
    });

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

    rescaleBrandsLogos();
    $(window).resize(function() {
        rescaleBrandsLogos();
    });

    // Click to open feedback modal
    $('a.get-consult, a.action-record').click(function (e) {
        e.preventDefault();
        let requestModal = $('#request-modal'),
            discountBlock = requestModal.find('.request-form-discount'),
            requestTypeInput = requestModal.find('input[name=type]'),
            actionIdInput = requestModal.find('input[name=action_id]')

        if ($(this).hasClass('get-consult')) {
            var newHad = window.getConsultHead;
            requestTypeInput.val('request_for_consultation');
            actionIdInput.val('');
            discountBlock.show();
        } else {
            newHad = window.onlineRecordHead;
            requestTypeInput.val('online_record');
            actionIdInput.val($(this).attr('action-id'));
            discountBlock.hide();
        }
        requestModal.find('h2').html(newHad);
        requestModal.modal('show');
    });

    // Click to nav-link
    $('.nav-link.brands').click(function (e) {
        e.preventDefault();
        let brandsModal = $('#brands-modal'),
            route = $(this).attr('route');

        brandsModal.find('a.brand').each(function () {
            $(this).attr('href', route + '/' + $(this).attr('brand'));
        });
        brandsModal.modal('show');
    });

    // Click to brand
    $('#brands-block a').click(function (e) {
        e.preventDefault();
        let navModal = $('#nav-modal'),
            brand = $(this).attr('brand');

        navModal.find('.menu-nav').each(function () {
            $(this).attr('href', $(this).attr('route') + '/' + brand);
        });
        navModal.modal('show');
    });
});

function fixingMainMenu() {
    let mainMenuFix = $('#main-nav');
    if ($(window).scrollTop() > 250) {
        mainMenuFix.css({
            'position':'fixed',
            'top':0
        });
    } else {
        mainMenuFix.css({
            'position':'relative',
            'top':'auto'
        });
    }
}

function rescaleBrandsLogos() {
    let logos = $('#brands-modal .brand-logo'),
        windowWidth = $(window).width();
    if (windowWidth >= 768) {
        logos.css({
            'width':100/logos.length+'%',
            'margin-top':0
        });
    } else if (windowWidth >= 520) {
        logos.css({
            'width':'50%',
            'margin-top':15
        });
    } else {
        logos.css({
            'width':'100%',
            'margin-top':15
        });
    }
}

function windowResize() {
    maxHeight($('.article-announcement'), 50);
    maxHeight($('.action-list .action'), 30);
}

function maxHeight(objs, padBottom) {
    if ($(window).width() > 650) {
        var maxHeight = 0;
        objs.each(function() {
            if (maxHeight < $(this).height()) maxHeight = $(this).height();
        });
    } else {
        maxHeight = 'auto';
    }
    if (padBottom) maxHeight += padBottom;
    objs.css('height',maxHeight);
}
