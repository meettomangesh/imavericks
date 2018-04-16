jQuery(document).ready(function ($) {

    $('.wpllc-wrapper').each(function (index) {

        var carousel_id = $(this).attr('id');
        var wpllc_conf = $.parseJSON($(this).closest('.wpl-logo-carousel-free-area').find('.wpl-lc-conf').text());


        if ( carousel_id != '') {

            jQuery('#' + carousel_id).slick({
                dots: (wpllc_conf.dots) == "true" ? true : false,
                infinite: true,
                slidesToShow: parseInt(wpllc_conf.column_number),
                slidesToScroll: 1,
                autoplay: (wpllc_conf.auto_play) == "true" ? true : false,
                arrows: (wpllc_conf.nav) == "true" ? true : false,
                autoplaySpeed: parseInt(wpllc_conf.autoplay_speed),
                speed: parseInt(wpllc_conf.pagination_speed),
                pauseOnHover: (wpllc_conf.pause_on_hover) == "true" ? true : false,
                swipe: (wpllc_conf.swipe) == "true" ? true : false,
                draggable: (wpllc_conf.draggable) == "true" ? true : false,
                rtl: (wpllc_conf.rtl) == "true" ? true : false,
                prevArrow: "<div class=\'slick-prev\'><i class=\'fa fa-angle-left\'></i></div>",
                nextArrow: "<div class=\'slick-next\'><i class=\'fa fa-angle-right\'></i></div>",
                responsive: [
                    {
                        breakpoint: 1280,
                        settings: {
                            slidesToShow: parseInt(wpllc_conf.column_number_dt)
                        }
                    },
                    {
                        breakpoint: 980,
                        settings: {
                            slidesToShow: parseInt(wpllc_conf.column_number_smdt)
                        }
                    },
                    {
                        breakpoint: 736,
                        settings: {
                            slidesToShow: parseInt(wpllc_conf.column_number_tablet)
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: parseInt(wpllc_conf.column_number_mobile)
                        }
                    }
                ]
            });
        }
    });
});