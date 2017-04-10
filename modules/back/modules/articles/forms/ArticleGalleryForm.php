<?php

namespace back\Articles\forms;

use app\models\ArticleGallery;
use back\Publications\forms\PublicationGalleryForm;

class ArticleGalleryForm extends PublicationGalleryForm {

    /** @inheritdoc */
    public function createNewGallery() {
        return new ArticleGallery();
    }

    /** @inheritdoc */
    protected function createImageForm() {
        return new ArticleGalleryImageForm();
    }
}