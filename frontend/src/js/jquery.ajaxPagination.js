$.fn.ajaxPagination = function() {
    var $spinner = $(this);

    /**
     * Массив с контейнерами
     * для итемов
     *
     * @type {Array}
     */
    var containers = [];
    $.each($spinner.data('containers'), function(i, container) {
        if(!container.selector || !container.itemsSelector)
            return true;

        // Если условие для контейнера не проходит
        if(typeof container.condition != 'undefined' && !eval(container.condition))
            return true;

        container.$element = $(container.selector);
        containers.push(container);
    });

    /**
     * Текущая страница
     * @type {int}
     */
    var curPage = $spinner.data('cur-page');

    /**
     * Кол-во страниц
     * @type {int}
     */
    var pagesCount = $spinner.data('pages-count');

    /**
     * Шаблон URL для загрузки
     * @type {string}
     */
    var urlPattern = $spinner.data('url-pattern');

    /**
     * Флаг, гворящий о том, что в данный момент идет
     * загрузка
     * @type {boolean}
     */
    var loading = false;

    /**
     * Функция подгрузки итемов
     */
    var loadItems = function() {
        if(loading || curPage >= pagesCount)
            return;

        loading = true;

        // Ждем, пока пользователь не прокрутит окно до спиннера:
        var spinnerOffset = $spinner.offset().top;
        var windowScroll = $(window).scrollTop();
        var windowHeight =  window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight;

        if(spinnerOffset > windowScroll + windowHeight) {
            loading = false;
            return;
        }

        // Показываем спиннер
        $spinner.removeClass('spinner-hidden');
        // Формируем ссылку
        var url = urlPattern.replace(encodeURIComponent(':page'), curPage + 1);

        $.ajax({
            url: url,
            success: function(data, textStatus, jqXHR) {
                var $html = $($.parseHTML(data));
                if(!$html.length) {
                    loading = false;
                    return;
                }

                curPage++;

                // Вставляем загруженные итемы
                $.each(containers, function(i, container) {
                    var $items = $html.find(container.itemsSelector);
                    container.$element.append($items);

                    /**
                     * Код, который будет исполнен после ajax-подгрузки
                     * @type {string}
                     */
                    var afterLoad = container.afterLoad;
                    if(afterLoad)
                        eval(afterLoad);
                });

                loading = false;
                // Скрываем спиннер
                $spinner.addClass('spinner-hidden');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                loading = false;
                // Скрываем спиннер
                $spinner.addClass('spinner-hidden');
            }
        });
    };

    loadItems();
    $(window).on('scroll', loadItems);
};