<?php

namespace back\News\forms;

use app\models\NewsI18n;
use back\Publications\forms\PublicationI18nForm;

class NewsI18nForm extends PublicationI18nForm {

    /** @inheritdoc */
    public function createNewI18n() {
        return new NewsI18n();
    }

}