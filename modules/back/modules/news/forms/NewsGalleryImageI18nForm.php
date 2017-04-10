<?php

namespace back\News\forms;

use app\models\NewsGalleryImageI18n;
use back\Publications\forms\PublicationGalleryImageI18nForm;

class NewsGalleryImageI18nForm extends PublicationGalleryImageI18nForm {

    /** @inheritdoc */
    public function createNewI18n() {
        return new NewsGalleryImageI18n();
    }

}