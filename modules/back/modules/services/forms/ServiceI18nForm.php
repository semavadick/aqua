<?php

namespace back\Services\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Service;
use app\models\ServiceI18n;
use back\forms\I18nForm;

abstract class ServiceI18nForm extends I18nForm {

    public $name = '';
    public $description = '';
    public $additDescription = '';
    public $video = '';
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';

    protected $saveI18n = true;

    /** @var ServiceI18n|null */
    private $i18n = null;

    public function rules() {
        $rules = [
            [['name', 'pageTitle'], 'required', 'message' => 'Заполните поле', 'when' => function(ServiceI18nForm $form) {
                return $form->getSaveI18n();
            }],
            [['description', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            ['description', 'safe'],
        ];
        if($this->hasAdditDescription()) {
            $rules[] = ['additDescription', 'safe'];
        }
        if($this->hasVideo()) {
            $rules[] = ['video', 'safe'];
        }
        return $rules;
    }

    /**
     * @inheritdoc
     * @return ServiceI18n Новая i18n
     */
    public function createNewI18n() {
        return new ServiceI18n();
    }

    /**
     * @inheritdoc
     * @param ServiceI18n $i18n
     * @param Service $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setService($entity);
        $i18n->setName($this->name);
        $i18n->setDescription($this->description);
        if($this->hasAdditDescription()) {
            $i18n->setAdditDescription($this->additDescription);
        }
        if($this->hasVideo()) {
            $i18n->setVideo($this->video);
        }
        $i18n->setPageTitle($this->pageTitle);
        $i18n->setPageMetaKeywords($this->pageMetaKeywords);
        $i18n->setPageMetaDescription($this->pageMetaDescription);
        return true;
    }

    /**
     * @inheritdoc
     * @param ServiceI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->i18n = $i18n;
        $this->name = $i18n->getName();
        $this->description = $i18n->getDescription();
        if($this->hasAdditDescription()) {
            $this->additDescription = $i18n->getAdditDescription();
        }

        if($this->hasVideo()) {
            $this->video = $i18n->getVideo();
        }
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
    }

    protected abstract function hasAdditDescription();

    protected abstract function hasVideo();

}