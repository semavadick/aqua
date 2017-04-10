$(function() {

    $('.amount input').on('change', function() {
        var $input = $(this);
        var val = parseInt($input.val());
        if(!val || val <= 0) {
            val = 1;
        }
        $input.val(val);
        var $btn = $('.info .add-to-cart');
        $btn.data('params')['quantity'] = val;
    });

    $('.tabset li a').on('click', function(){
        var thisHold = $(this).closest(".tabs-container, .gallery-tabs, .tab-map, .info");
        var _ind = $(this).closest('li').index();
        thisHold.children('.tab-body').children(".tab").removeClass('active');
        thisHold.children('.tab-body').children("div.tab:eq("+_ind+")").addClass('active');
        $(this).closest("ul").find(".active").removeClass("active");
        $(this).parent().addClass("active");
        return false;
    });

    $('.catalog-group .gallery').bxSlider({
        pager: true,
        controls: false,
        maxSlides: 1,
        auto: false,
        minSlides: 1,
        moveSlides: 1,
        pagerCustom: '#bx-pager',
        speed: 1500,
    });

    // Figure
    (function() {
        var $modal = $('#figure-modal');
        if(!$modal.length) {
            return;
        }
        $modal.myModal();

        $('.btn-figure').on('click', function() {
            $modal.open();
            return false;
        });
    })();

    // Draft
    (function() {
        var $modal = $('#draft-modal');
        if(!$modal.length) {
            return;
        }
        $modal.myModal();

        $('.btn-draft').on('click', function() {
            $modal.open();
            return false;
        });
    })();

    // Circuit
    (function() {
        var $modal = $('#circuit-modal');
        if(!$modal.length) {
            return;
        }
        $modal.myModal();

        $('.btn-circuit').on('click', function() {
            $modal.open();
            return false;
        });
    })();



});
