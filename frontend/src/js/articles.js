$(function() {

    $('.sl1').on('change', function() {
        document.location.href = $(this).find(':selected').data('url');
    });

});
