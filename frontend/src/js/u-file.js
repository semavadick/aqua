$(function() {
    $('.u-file').each(function() {
        var $cont = $(this);
        var $fInput = $cont.find('[type=file]');
        var $label = $cont.find('.u-file__label');
        var labelText = $label.text();
        var $btn = $cont.find('.u-file__btn');

        var centerBtn = function() {
            var labelHeight = $label.outerHeight();
            var btnMargin = labelHeight - $btn.outerHeight();
            btnMargin /= 2;
            if(btnMargin < 0) {
                btnMargin = 0;
            }
            $btn.parent().css({
                paddingTop: btnMargin
            });
        };

        $fInput.on('change', function() {
            var fName = this.files.length > 0 ? this.files[0].name : labelText;
            $label.text(fName);
            centerBtn();
        });

        $btn.on('click', function() {
            $fInput.click();
            return false;
        });
        $(window).on('resize', centerBtn);
        centerBtn();
    });
});