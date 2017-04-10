$(function() {

    // Filters
    (function() {
        var $filters = $('.category-chooser input:radio[name="filters"]');
        $filters.iCheck({
            checkboxClass: 'check',
            radioClass: 'radio',
            increaseArea: '20%' // optional
        });
        $filters.on('ifChecked', function(event) {
            document.location.href = $(event.target).data('url');
        });
    })();

    // Help
    (function() {
        var $modal = $('#help-modal');
        $modal.myModal();

        $('.btn-help').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#help-form').on('beforeSubmit', function() {
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

    // Catalog
    (function() {
        var $modal = $('#store-catalog-modal');
        $modal.myModal();

        $('.store-catalog-btn').on('click', function() {
            $modal.open();
            return false;
        });

        /**
         * Send the form
         */
        $('#store-catalog-form').on('beforeSubmit', function() {
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

    $(document).on('click', '.wiev-choose a', function(){
        var grid_view = $(this).attr('data-grid-view');
        if(!$(this).parent().hasClass('active')) {
            var active = $(this).closest('.wiev-choose').find('.active');
            active.removeClass('active');
            $(this).closest('.wiev-choose').find('.active').removeClass('active');
            $(this).parent().addClass('active');
            $('.catalog').addClass(grid_view).removeClass(active.find('a').attr('data-grid-view'));

            $.get('/store/grid-view/'+grid_view);
        }
        return false;
    })

    $(document).on('change', '.amount input', function(){
        $(this).closest('.holder').find('.btn-basket').data('params').quantity = this.value;
    })

});
