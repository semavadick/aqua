<?php

namespace back\News\forms;

use app\models\News;
use back\Publications\forms\PublicationForm;

class NewsForm extends PublicationForm {

    /** @inheritdoc */
    protected function createNewEntity() {
        return new News();
    }

    /** @inheritdoc */
    protected function createNewI18nForm() {
        return new NewsI18nForm();
    }

    /** @inheritdoc */
    protected function createGalleryForm() {
        return new NewsGalleryForm();
    }

}