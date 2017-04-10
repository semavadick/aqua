<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\AdditionProductOption;
use back\forms\EntityForm;
use back\forms\I18nForm;

class AdditionProductOptionForm extends EntityForm {

    public $id = null;
    public $type = 0;
    public $main = 0;

    public function load($data, $formName = '') {
        parent::load($data, $formName);
        if(!empty($data['type'])) $this->type = (int) $data['type'];
        if(isset($data['main'])) {
            if($data['main'] != 0) {
                if($this->getEntity() && $this->getEntity()->getProduct()->getId()){
                    $mains = $this->getEntityManager()->getRepository('Models:AdditionProductOption')->findBy([
                        'type' => $data['type'],
                        'main' => 1,
                        'product' => $this->getEntity()->getProduct()
                    ]);
                    foreach($mains as $c_main){
                        $optionForm = new AdditionProductOptionForm();
                        $optionForm->setEntity($c_main);
                        $optionForm->load(['main' => 0], '');
                        $optionForm->save();
                    }
                }
            }
            $this->main = (int) $data['main'];
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionProductOption $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->id = $entity->getId();
        $this->type = $entity->getType();
        $this->main = $entity->getMain();
    }

    /**
     * @inheritdoc
     * @param AdditionProduct $entity
     */
    protected function getDataFromEntity(Entity $entity)
    {
        $data = [
            'type' => $entity->getType(),
            'main' => $entity->getMain()
        ];
        return $data;
    }

    /**
     * @inheritdoc
     * @param AdditionProductOption $entity
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

        $entity->setType($this->type);
        $entity->setMain($this->main);
        return true;
    }

    /**
     * @return Entity Новая сущность
     */
    protected function createNewEntity() {
        return new AdditionProductOption();
    }

    /**
     * @return I18nForm Новый инстанс i18n формы
     */
    protected function createNewI18nForm() {
        return new AdditionProductOptionI18nForm();
    }

}