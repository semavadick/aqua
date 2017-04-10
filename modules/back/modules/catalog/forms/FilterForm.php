<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\CategoryFilter;
use back\forms\EntityForm;

class FilterForm extends EntityForm {

    public $id = null;

    /**
     * @inheritdoc
     * @param CategoryFilter $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->id = $entity->getId();
        return true;
    }

    /**
     * @inheritdoc
     * @param CategoryFilter $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'id' => $entity->getId(),
        ];
    }

    /**
     * @inheritdoc
     * @param CategoryFilter $entity
     */
    protected function fillEntity(Entity $entity) {
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
     * @inheritdoc
     * @return CategoryFilter
     */
    protected function createNewEntity() {
        return new CategoryFilter();
    }

    /**
     * @inheritdoc
     * @return FilterI18nForm
     */
    protected function createNewI18nForm() {
        return new FilterI18nForm();
    }

}