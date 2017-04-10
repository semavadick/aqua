$(function() {

    // Slider
    (function() {
        $('#main .gallery-main').bxSlider({
            pager: true,
            controls: false,
            maxSlides: 1,
            auto: true,
            minSlides: 1,
            moveSlides: 1,
            speed: 800,
            pause: 4500,
        });
    })();

    // Catalog
    (function() {
        var $modal = $('#catalog-modal');
        $modal.myModal();

        $('.order-catalog .btn').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#catalog-form').on('beforeSubmit', function() {
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

    // Contact a manager
    (function() {
        var $modal = $('#manager-contact-modal');
        $modal.myModal();

        $('.contact-manager').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#manager-contact-form').on('beforeSubmit', function() {
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
