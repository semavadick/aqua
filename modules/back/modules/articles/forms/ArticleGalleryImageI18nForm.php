<?php

namespace back\Articles\forms;

use app\models\ArticleGalleryImageI18n;
use back\Publications\forms\PublicationGalleryImageI18nForm;

class ArticleGalleryImageI18nForm extends PublicationGalleryImageI18nForm {

    /** @inheritdoc */
    public function createNewI18n() {
        return new ArticleGalleryImageI18n();
    }

}