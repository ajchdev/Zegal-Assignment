jQuery(document).ready(function($){
    "use scrict";

    // Menu
    $('#primary-menu .menu-item-has-children > a').after('<button class="child-menu-toggle"><svg class="svg-inline--fa fa-chevron-down fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path></svg></button>');

    $('.menu-item-has-children .child-menu-toggle, .page_item_has_children .child-menu-toggle').click(function(){
        $(this).toggleClass('active');
        $(this).siblings('.sub-menu').slideToggle();
        $(this).siblings('.children').slideToggle();
    });

    // Remove Toggle class on window resize more that 600
    $(window).on('resize', function() {
        if ($(window).width() > 600) {
            $('#site-navigation').removeClass('toggled');
        }
    });

    // $('.menu-toggle')
    $('.menu-toggle-close, .menu-toggle').click(function(){
        $('#site-navigation').toggleClass('toggled');

        if( $('#site-navigation').hasClass('toggled') ){

            setTimeout(function () {
                $('.menu-toggle-close').focus();
            }, 100);

        }else{

            setTimeout(function () {
                $('.menu-toggle').focus();
            }, 100);

        }

    });

    $('.home-banner-action').slick({
        slidesToShow: 4,
        arrows: true,
        dots: false,
        nextArrow: '<span class="carousel-next-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8 fa-3x"><path fill="currentColor" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg></span>',
        prevArrow: '<span class="carousel-prev-arrow"><svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 fa-3x"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg></span>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    

});