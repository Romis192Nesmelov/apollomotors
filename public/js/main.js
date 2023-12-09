// window.stop();
$(window).on('load', function () {
    $('input[name=phone]').mask("+7(999)999-99-99");

    setTimeout(function () {
        windowResize();
        bigTablesScroll();
        $('body').removeAttr('style');
        removeLoader();
    },1000);

    $(window).resize(function() {
        windowResize();
        bigTablesScroll();
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

	// Adding icon to fancybox block
    $('.image').each(function() {
		if ($(this).find('a.fancybox').length) $(this).prepend($('<i></i>').addClass('icon-search4'));
	});


    // Carousel actions
    $('#actions-block').owlCarousel(owl_settings(
        10,
        false,
        6000,
        {0: {items: 1}}
    ));

    // Carousel brands
    $('#brands-block').owlCarousel(owl_settings(
        10,
        true,
        5000,
        {
            0: {
                items: 3
            },
            768: {
                items: 5
            },
            1000: {
                items: 8
            }
        }
    ));

    // Carousel actions brands
    $('#actions-brand-block').owlCarousel(owl_settings(
        3,
        false,
        5000,
        {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    ));

    // Carousel clients
    $('#clients-block').owlCarousel(owl_settings(
        10,
        true,
        3000,
        {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    ));

    // Carousel repair images
    $('#repair-images').owlCarousel(owl_settings(
        10,
        true,
        3000,
        {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    ));

    // Fancybox init
    bindFancybox();

    // Show add content
    showHideContent($('section.add-content'));

    // Show parts content
    showHideContent($('section.parts-content'));

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
        } else if ($(this).hasClass('action-record')) {
            newHad = window.onlineRegForPromo;
            requestTypeInput.val('online_registration_for_the_promotion');
            actionIdInput.val($(this).attr('action-id'));
            discountBlock.hide();
        } else if ($(this).hasClass('repair-record')) {
            newHad = window.onlineRegForRepair;
            requestTypeInput.val('online_appointment_for_repairs');
            discountBlock.show();
        } else {
            newHad = window.onlineRegForMaintenance;
            requestTypeInput.val('online_appointment_for_maintenance');
            discountBlock.show();
        }
        requestModal.find('h4').html(newHad);
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
        $('#another-brand').attr('href', route);
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
    // maxHeight($('.action-list .action'), 30);
    maxHeight($('#actions-brand-block table'), 0);
}

function bigTablesScroll() {
    window.bigTable = $('.big-table-container');
    if (window.bigTable.length && $(window).width() <= 1024) {
        window.bigTable.mCustomScrollbar({
            axis: 'x',
            theme: 'light-3',
            alwaysShowScrollbar: 2,
            advanced: {
                autoExpandHorizontalScroll: true
            }
        });

        $(window).scroll(function () {
            var offset = window.pageYOffset-bigTable.offset().top;
            offset = offset < 0 ? 0 : offset;
            $('.mCSB_scrollTools.mCSB_scrollTools_horizontal').css('top',offset);
        });
    } else if (window.bigTable) {
        window.bigTable.mCustomScrollbar('destroy');
    }
}

function startTimer(actionTime) {
    setInterval(function() {
        let t = parseInt(actionTime) - Math.round(Date.now()/1000)-(60*60*3),
            seconds = Math.floor(t % 60),
            minutes = Math.floor((t/60) % 60),
            hours = Math.floor((t/(60*60)) % 24),
            days = Math.floor(t/(60*60*24));

        if (seconds.toString().length == 1) seconds = '0'+seconds;
        if (minutes.toString().length == 1) minutes = '0'+minutes;
        if (hours.toString().length == 1) hours = '0'+hours;

        $('#timer .days .digits').html(days);
        $('#timer .hours .digits').html(hours);
        $('#timer .minutes .digits').html(minutes);
        $('#timer .seconds .digits').html(seconds);
    }, 1000);
}

function showHideContent(section) {
    let fullContent = section.find('.full-content'),
        shortContent = section.find('.short-content'),
        showMore = section.find('.show-more'),
        hideMore = section.find('.hide-more');

    showMore.click(function() {
        fullContent.fadeIn();
        if (shortContent.length) shortContent.fadeOut();
        $(this).addClass('d-none');
        hideMore.removeClass('d-none');
    });

    hideMore.click(function() {
        fullContent.fadeOut();
        if (shortContent.length) shortContent.fadeIn();
        $(this).addClass('d-none');
        showMore.removeClass('d-none');
    });
}
