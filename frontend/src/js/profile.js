$(function() {

    $('.order-modal-btn').on('click', function() {
        var modalId = $(this).data('id');
        var $modal = $('#' + modalId);
        $modal.myModal();
        $modal.open();
        return false;
    });
    $('.order-details .modal-form__btn').on('click', function() {
        var prodsData = $(this).data('products');
        var cart = MyCart.Cart.getInstance();
        $.each(prodsData, function(i, prodData) {
            if(prodData.type) {
                if(prodData.options != undefined) {
                    cart.addProduct(prodData.id, prodData.name, prodData.price, prodData.quantity, prodData.sku, prodData.type, prodData.options, prodData.discount);
                } else {
                    cart.addProduct(prodData.id, prodData.name, prodData.price, prodData.quantity, prodData.sku, prodData.type, undefined, prodData.discount);
                }
            } else {
                cart.addProduct(prodData.id, prodData.name, prodData.price, prodData.quantity, prodData.sku, prodData.type, undefined, prodData.discount);
            }

            cart.open();
        });
        return false;
    });

    /**
     * Send the profile form
     */
    $('#profile-form').on('beforeSubmit', function() {
        var $form = $(this);
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: $form.serialize(),
            success: function(responseText) {
                $form.addClass('success');
                setTimeout(function() {
                    $form.removeClass('success');
                }, 4000);
            },
            error: function(jqXHR) {
                alert(jqXHR.responseText);
            }
        });
        return false;
    });


});
