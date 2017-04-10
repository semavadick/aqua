$(function() {

    var slider = $('.gallery-tabs .gallery').bxSlider({
        pager: true,
        controls: true,
        maxSlides: 1,
        auto: false,
        adaptiveHeight: true,
        minSlides: 1,
        moveSlides: 1,
        speed: 500
    });

    $('.gallery-tabs .gallery li').click(function(){
        var _index = $(this).index();
        var _len = $(this).closest('.gallery').find('li').length;
        $('.gallery-tabs .gallery').each(function() {
            if(_index < _len - 2){
                slider.goToSlide(_index);
            } else {
                slider.goToSlide(0);
            }
        });
    });

});
