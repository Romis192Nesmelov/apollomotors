$(document).ready(function() {
    setTimeout(function () {
        arrowAngel($('#indicator > .dial.left .arrow'),60, 120, true);
        arrowAngel($('#indicator > .dial.right .arrow'),0, window.timeIndicator, false);
    }, 2000);
});

function arrowAngel(arrow, startAnge, angel, test) {
    var deg = 0;
    var rotation = setInterval(function () {
        if (deg <= angel) {
            arrow.css('transform','rotate(' + (startAnge + deg) + 'deg)');
            deg++;
        } else {
            clearInterval(rotation);
            if (test) console.log(deg)
        }
    }, 0.2);;
}
