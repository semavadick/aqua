<?php

namespace back\Articles\forms;

use app\models\ArticleGalleryImage;
use back\Publications\forms\PublicationGalleryImageForm;

class ArticleGalleryImageForm extends PublicationGalleryImageForm {

    /** @inheritdoc */
    protected function createNewEntity() {
        return $this->createNewImage();
    }

    /** @inheritdoc */
    protected function createNewI18nForm() {
        return new ArticleGalleryImageI18nForm();
    }

    /** @inheritdoc */
    public function createNewImage() {
        return new ArticleGalleryImage();
    }
}