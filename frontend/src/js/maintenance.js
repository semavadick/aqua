$(function() {
    var $modal = $('#maintenance-modal');
    $modal.myModal();

    $('.btn-order-cat').on('click', function() {
        $modal.open();
        return false;
    });

    /**
     * Send the form
     */
    $('#maintenance-form').on('beforeSubmit', function() {
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
});
