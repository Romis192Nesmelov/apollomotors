function oul_settings(margin, nav, timeout, responsive) {
    let navButtonBlack1 = '<img src="/storage/images/arrow_left.svg" />',
        navButtonBlack2 = '<img src="/storage/images/arrow_right.svg" />';

    return {
        margin: margin,
        loop: true,
        nav: nav,
        autoplay: true,
        autoplayTimeout: timeout,
        dots: !nav,
        responsive: responsive,
        navText: [navButtonBlack1, navButtonBlack2]
    }
}
