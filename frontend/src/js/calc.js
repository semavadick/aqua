$(function() {

    // Figure
    (function() {
        var $modal = $('#calc-modal');
        if(!$modal.length) {
            return;
        }
        $modal.myModal();

        $('.btn-calc').on('click', function() {
            $modal.open();
            return false;
        });
    })();

});