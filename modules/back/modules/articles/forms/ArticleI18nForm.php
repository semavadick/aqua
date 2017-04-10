<?php

namespace back\Articles\forms;

use app\models\ArticleI18n;
use back\Publications\forms\PublicationI18nForm;

class ArticleI18nForm extends PublicationI18nForm {

    /** @inheritdoc */
    public function createNewI18n() {
        return new ArticleI18n();
    }

}