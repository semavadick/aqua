$(function() {

    // Certificates
    (function() {
        $('.fancy').fancybox();

        var slider= $('.sert .gallery').bxSlider({
            pager: true,
            controls: false,
            maxSlides: 4,
            auto: false,
            minSlides: 4,
            moveSlides: 1,
            slideWidth:362,
            slideMargin: 48,
            speed: 1500,
        });

        $(window).load(function(){
            if($('.sert .gallery').size()) {
                if ($(window).width() < 1220) {
                    slider.reloadSlider({
                        pager: true,
                        controls: false,
                        maxSlides: 3,
                        auto: false,
                        minSlides: 3,
                        moveSlides: 1,
                        slideWidth:362,
                        slideMargin: 48,
                        speed: 1500,
                    });
                } else {
                    slider.reloadSlider({
                        pager: true,
                        controls: false,
                        maxSlides: 4,
                        auto: false,
                        minSlides: 4,
                        moveSlides: 1,
                        slideWidth:362,
                        slideMargin: 48,
                        speed: 1500,
                    });
                };
                if ($(window).width() < 960) {
                    slider.reloadSlider({
                        pager: true,
                        controls: false,
                        maxSlides: 2,
                        auto: false,
                        minSlides: 2,
                        moveSlides: 1,
                        slideWidth:362,
                        slideMargin: 48,
                        speed: 1500,
                    });
                }
            }

        });

        $(window).resize(function(){
            if($('.sert .gallery').size()) {
                if ($(window).width() < 1220) {
                    slider.reloadSlider({
                        pager: true,
                        controls: false,
                        maxSlides: 3,
                        auto: false,
                        minSlides: 3,
                        moveSlides: 1,
                        slideWidth:362,
                        slideMargin: 48,
                        speed: 1500,
                    });
                } else {
                    slider.reloadSlider({
                        pager: true,
                        controls: false,
                        maxSlides: 4,
                        auto: false,
                        minSlides: 4,
                        moveSlides: 1,
                        slideWidth:362,
                        slideMargin: 48,
                        speed: 1500,
                    });
                };
                if ($(window).width() < 960) {
                    slider.reloadSlider({
                        pager: true,
                        controls: false,
                        maxSlides: 2,
                        auto: false,
                        minSlides: 2,
                        moveSlides: 1,
                        slideWidth:362,
                        slideMargin: 48,
                        speed: 1500,
                    });
                }
            }
        });
    })();

});
