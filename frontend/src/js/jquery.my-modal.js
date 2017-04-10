$.fn.myModal = function() {
    var $modal = this;
    var onBeforeClose = null,
        onAfterClose = null;

    $modal.open = function() {
        $modal.addClass('my-modal--opened');
    };
    $modal.close = function() {
        if(typeof onBeforeClose == 'function') {
            onBeforeClose.call(this);
        }
        $modal.removeClass('my-modal--opened');
        if(typeof onAfterClose == 'function') {
            onAfterClose.call(this);
        }
    };
    $modal.setOnBeforeClose = function(onCloseCallback) {
        onBeforeClose = onCloseCallback;
    };
    $modal.setOnAfterClose = function(onCloseCallback) {
        onAfterClose = onCloseCallback;
    };
    $modal.find('.my-modal__close').on('click', function() {
        $modal.close();
        return false;
    });

    $modal.on('click', function(e) {
        var $target = $(e.target);
        if($target.hasClass('my-modal')) {
            $modal.close();
            return false;
        }
    });
    return $modal;
};