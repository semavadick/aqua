$(function() {

    $('.advantages-tech .gallery').bxSlider({
        pager: true,
        controls: false,
        maxSlides: 1,
        auto: false,
        minSlides: 1,
        moveSlides: 1,
        speed: 1500,
    });

    // Consultation
    (function() {
        var $modal = $('#consult-modal');
        $modal.myModal();

        $('.consult-btn').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#consult-form').on('beforeSubmit', function() {
            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                success: function(responseText) {
                    $form.addClass('success');
                    setTimeout(function() {
                        $modal.close();
                    }, 4000);
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                }
            });
            return false;
        });
    })();

    // FAQ
    (function() {
        $('.answers .columns a').on('click  touchstart', function (e) {
            var self = $(this);
            var currentMenu = $(this).closest('li').find('.answer');
            $('li .answer').not(currentMenu).slideUp();
            currentMenu.slideToggle();
            $(this).not( $(' a.active')).toggleClass('active');
            $('.answers .columns a').not(self).removeClass('active');
            return false;
        });

        var $modal = $('#question-modal');
        $modal.myModal();

        $('.question-btn').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#question-form').on('beforeSubmit', function() {
            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                success: function(responseText) {
                    $form.addClass('success');
                    setTimeout(function() {
                        $modal.close();
                    }, 4000);
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                }
            });
            return false;
        });
    })();

});
