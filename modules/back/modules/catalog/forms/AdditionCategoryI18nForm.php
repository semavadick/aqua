<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AdditionCategory;
use app\models\AdditionCategoryI18n;
use back\forms\I18nForm;
use yii\helpers\ArrayHelper;

class AdditionCategoryI18nForm extends I18nForm {

    public $name = '';
    public $description = '';
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';

    /** @var AdditionCategoryI18n|null */
    private $i18n = null;

    public function rules() {
        $rules = [
            [['name', 'pageTitle'], 'required', 'message' => 'Заполните поле', 'when' => function(AdditionCategoryI18nForm $form) {
                return $form->getSaveI18n();
            }],
            [['description', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            ['description', 'safe'],
        ];
        return ArrayHelper::merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return AdditionCategoryI18n Новая i18n
     */
    public function createNewI18n() {
        return new AdditionCategoryI18n();
    }

    /**
     * @inheritdoc
     * @param AdditionCategoryI18n $i18n
     * @param AdditionCategory $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setCategory($entity);
        $i18n->setName($this->name);
        $i18n->setDescription($this->description);
        $i18n->setPageTitle($this->pageTitle);
        $i18n->setPageMetaKeywords($this->pageMetaKeywords);
        $i18n->setPageMetaDescription($this->pageMetaDescription);
        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionCategoryI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->i18n = $i18n;
        $this->name = $i18n->getName();
        $this->description = $i18n->getDescription();
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
    }

}