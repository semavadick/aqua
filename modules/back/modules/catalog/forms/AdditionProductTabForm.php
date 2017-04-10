<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\AdditionProductTab;
use back\forms\EntityForm;
use back\forms\I18nForm;

class AdditionProductTabForm extends EntityForm {

    public $id = null;

    /**
     * @inheritdoc
     * @param AdditionProductTab $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->id = $entity->getId();
    }

    /**
     * @inheritdoc
     * @param AdditionProductTab $entity
     */
    public function fillEntity(Entity $entity) {
        foreach($this->i18nForms as $i18nForm) {
            $i18n = $entity->getI18n($i18nForm->getLanguage());
            if(empty($i18n)) {
                $i18n = $i18nForm->createNewI18n();
                $i18n->setLanguage($i18nForm->getLanguage());
            }
            $i18nForm->fillI18n($i18n, $entity);
            $this->getEntityManager()->persist($i18n);
        }
        return true;
    }

    /**
     * @return Entity Новая сущность
     */
    protected function createNewEntity() {
        return new AdditionProductTab();
    }

    /**
     * @return I18nForm Новый инстанс i18n формы
     */
    protected function createNewI18nForm() {
        return new AdditionProductTabI18nForm();
    }

}