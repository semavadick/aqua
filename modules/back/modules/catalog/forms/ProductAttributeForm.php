<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\ProductAttribute;
use app\models\ProductImage;
use back\forms\EntityForm;
use back\forms\I18nForm;

class ProductAttributeForm extends EntityForm {

    public $id = null;

    /**
     * @inheritdoc
     * @param ProductImage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->id = $entity->getId();
    }

    /**
     * @inheritdoc
     * @param ProductImage $entity
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
        return new ProductAttribute();
    }

    /**
     * @return I18nForm Новый инстанс i18n формы
     */
    protected function createNewI18nForm() {
        return new ProductAttributeI18nForm();
    }

}