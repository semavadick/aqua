<?php

namespace back\forms;

use app\components\Doctrine;
use app\models\Entity;
use app\models\Language;
use Doctrine\ORM\EntityManager;
use yii\base\Model;

/**
 * Форма для добавления / редактирования сущности
 */
abstract class EntityForm extends Form {

    /** @var Entity|null */
    private $entity = null;

    /** @var I18nForm[] */
    protected $i18nForms;

    /** @inheritdoc */
    public function __construct($config = []) {
        parent::__construct($config);

        $this->i18nForms = [];
        /** @var Language[] $languages */
        $languages = $this->getEntityManager()->getRepository('Models:Language')->findAll();
        foreach($languages as $language) {
            $form = $this->createNewI18nForm();
            if(empty($form)) {
                break;
            }
            $form->setLanguage($language);
            $this->i18nForms[] = $form;
        }
    }

    /**
     * @param Entity $entity
     */
    public final function setEntity(Entity $entity) {
        $this->entity = $entity;
        $this->populateFromEntity($entity);
        foreach($this->i18nForms as $i18nForm) {
            $i18n = $entity->getI18n($i18nForm->getLanguage());
            if(!empty($i18n)) {
                $i18nForm->setI18n($i18n);
            }
        }
    }

    /**
     * @return Entity
     */
    public final function getEntity() {
        return $this->entity;
    }

    /**
     * @return array
     */
    public function getData() {
        $data = $this->getAttributes();
        if(empty($this->entity)) {
            return $data;
        }
        $data += $this->getDataFromEntity($this->entity);
        $data['i18ns'] = [];
        foreach($this->i18nForms as $form) {
            $i18nData = $form->getData();
            $i18nData['languageId'] = $form->getLanguage()->getId();
            $i18nData['saveI18n'] = $form->getSaveI18n();
            $data['i18ns'][] = $i18nData;
        }
        return $data;
    }

    /**
     * @inheritdoc
     * @param null $formName Неактивный параметр
     */
    public function load($data, $formName = '') {
        $result = parent::load($data, '');
        if(empty($data['i18ns']) || !is_array($data['i18ns'])) {
            return false;
        }
        foreach($data['i18ns'] as $i18nData) {
            if(!isset($i18nData['languageId'])) {
                continue;
            }
            foreach($this->i18nForms as $i18nForm) {
                if($i18nForm->getLanguage()->getId() == $i18nData['languageId']) {
                    $i18nForm->load($i18nData, '');
                    break;
                }
            }
        }
        return $result;
    }

    /**
     * @return bool
     */
    public final function save() {
        if(!$this->validate() || !self::validateMultiple($this->i18nForms)) {
            return false;
        }
        $hasI18n = false;
        foreach($this->i18nForms as $i18nForm) {
            if($i18nForm->getSaveI18n()) {
                $hasI18n = true;
                break;
            }
        }
        $i18n = $this->createNewI18nForm();
        if(!$hasI18n && !empty($i18n)) {
            $this->addError('i18nsGeneral', 'Выберите хотя бы один язык');
            return false;
        }

        if(empty($this->entity)) {
            $this->entity = $this->createNewEntity();
        }
        $em = $this->getEntityManager();
        $em->persist($this->entity);
        if(!$this->fillEntity($this->entity)) {
            return false;
        }

        foreach($this->i18nForms as $i18nForm) {
            $i18n = $i18nForm->getI18n();
            if(!empty($i18n) && !$i18nForm->getSaveI18n()) {
                $em->remove($i18n);
                continue;
            }
            if(!$i18nForm->getSaveI18n()) {
                continue;
            }
            if(empty($i18n)) {
                $i18n = $i18nForm->createNewI18n();
                $i18n->setLanguage($i18nForm->getLanguage());
            }
            if(!$i18nForm->fillI18n($i18n, $this->entity)) {
                return false;
            }
            $em->persist($i18n);
        }

        $em->flush();
        return true;
    }

    /**
     * @param null $attribute Неактивный параметр
     * @return array Ошибки формы + ошибки i18n форм (ключ = i18ns)
     */
    public function getErrors($attribute = null) {
        $errors = parent::getErrors(null);
        $errors['i18ns'] = [];
        foreach($this->i18nForms as $i18nForm) {
            $i18nErrors = $i18nForm->getErrors();
            $i18nErrors['languageId'] = $i18nForm->getLanguage()->getId();
            $errors['i18ns'][] = $i18nErrors;
        }
        return $errors;
    }

    /** @return EntityManager */
    protected function getEntityManager() {
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        return $doctrine->getEntityManager();
    }




    /**
     * @param Entity $entity
     */
    protected abstract function populateFromEntity(Entity $entity);

    /**
     * @param Entity $entity
     * @return boolean
     */
    protected abstract function fillEntity(Entity $entity);

    /**
     * @param Entity $entity
     * @return array
     */
    protected function getDataFromEntity(Entity $entity) {
        return [];
    }

    /**
     * @return Entity Новая сущность
     */
    protected abstract function createNewEntity();

    /**
     * @return I18nForm Новый инстанс i18n формы
     */
    protected abstract function createNewI18nForm();

}