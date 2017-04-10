<?php

namespace back\News\forms;

use app\models\NewsGalleryImage;
use back\Publications\forms\PublicationGalleryImageForm;

class NewsGalleryImageForm extends PublicationGalleryImageForm {

    /** @inheritdoc */
    protected function createNewEntity() {
        return $this->createNewImage();
    }

    /** @inheritdoc */
    protected function createNewI18nForm() {
        return new NewsGalleryImageI18nForm();
    }

    /** @inheritdoc */
    public function createNewImage() {
        return new NewsGalleryImage();
    }
}