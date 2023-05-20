$(document).ready(function () {
    $('#owl-demo').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })

    $("#owl-demo2").owlCarousel({

        nav: true, // Show next and prev buttons
        autoplaySpeed: 300,
        navSpeed: 400,
        items: 1

    });

    $('#owl-demo3').owlCarousel({
        center: true,
        items: 2,
        loop: true,
        margin: 10,
        responsive: {
            600: {
                items: 4
            }
        }
    });

    $('#owl-demo4').owlCarousel({
        margin: 10,
        loop: false,
        autoWidth: true,
        items: 4
    });
});