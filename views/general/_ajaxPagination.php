<?php

use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Спиннер для ajax-подгрузки
 * итемов в контейнер
 *
 * @var app\components\View $this
 * @var yii\data\Pagination $pagination
 * @var array $containers Информация о контейнерах
 * для подгрузки элементов
 * <ul>
 *  <li>
 *      selector - jQuery-селектор для контейнера
 *  </li>
 *  <li>
 *      itemsSelector - jQuery-селектор для элементов контейнера
 *  </li>
 *  <li>
 *      condition - Условие (js eval) для влючения ajax-подгрузки в
 *          контейнере. Если не указано, ajax-подгрузка включена
 *  </li>
 *  <li>
 *      afterLoad - Код, который будет выполнен (js eval) после загрузки
 *          итемов. В контексте будет доступна переменная $items (jQuery объект с загруженными элементами)
 *  </li>
 * </ul>
 */

\app\assets\AjaxPagination::register($this);
?>

<i
    class="spinner spinner-hidden"
    data-cur-page="<?= $pagination->getPage() + 1 ?>"
    data-pages-count="<?= $pagination->getPageCount() ?>"
    data-url-pattern="<?= Url::current([
        $pagination->pageParam => ':page',
    ]) ?>"
    data-containers="<?= Html::encode(json_encode($containers)) ?>"
    >
</i>