<?php

namespace back\News\forms;

use app\models\NewsGallery;
use back\Publications\forms\PublicationGalleryForm;

class NewsGalleryForm extends PublicationGalleryForm {

    /** @inheritdoc */
    public function createNewGallery() {
        return new NewsGallery();
    }

    /** @inheritdoc */
    protected function createImageForm() {
        return new NewsGalleryImageForm();
    }
}