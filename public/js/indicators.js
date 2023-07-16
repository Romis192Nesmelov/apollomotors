$(document).ready(function() {
    setTimeout(function () {
        arrowAngel($('#indicator > .dial.left .arrow'),60, window.priceIndicator);
        arrowAngel($('#indicator > .dial.right .arrow'),0, window.timeIndicator);
    }, 2000);
});

function arrowAngel(arrow, startAnge, angel) {
    var deg = 0;
    var rotation = setInterval(function () {
        if (deg < angel - 3) {
            arrow.css('transform','rotate(' + (startAnge + deg) + 'deg)');
            deg++;
        } else {
            clearInterval(rotation);
        }
    }, 1);
}
