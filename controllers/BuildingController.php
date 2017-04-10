<?php

namespace app\controllers;

use app\forms\ConsultForm;
use app\forms\QuestionForm;
use app\forms\RebuildingRequestForm;
use app\models\FaqItem;
use app\models\Language;
use app\models\ObjectGallery;
use app\models\PoolsBuildingPage;
use app\models\PoolsBuildingPageI18n;
use app\models\PoolsBuildingStatic;
use app\models\PoolType;
use app\models\PoolTypeI18n;
use app\repositories\AdditionCategoriesRepository;
use app\repositories\ObjectGalleriesRepository;
use app\repositories\PoolTypesRepository;
use app\repositories\TechAdvantagesRepository;
use app\repositories\FaqItemsRepository;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class BuildingController extends Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        $language = self::getCurrentLanguage();
        /** @var PoolsBuildingPage $page */
        $page = $this->getEntityManager()->find('Models:PoolsBuildingPage', 0);
        /** @var PoolsBuildingPageI18n $pageI18n */
        $pageI18n = $page->getI18n($language);
        $types = PoolTypesRepository::getInstance()->findPoolTypesForBuildingPage($language);
        $advantages = TechAdvantagesRepository::getInstance()->findAdvantagesForBuildingPage($language);
        $galleries = ObjectGalleriesRepository::getInstance()->findGalleriesForBuildingPage($language);
        $faqItems = FaqItemsRepository::getInstance()->findItemsForBuildingPage($language);
        return $this->render('index', [
            'language' => $language,
            'page' => $page,
            'pageI18n' => $pageI18n,
            'types' => $types,
            'advantages' => $advantages,
            'galleries' => $galleries,
            'faqItems' => $faqItems,
        ]);
    }

    /**
     * Консультация
     */
    public function actionConsult() {
        $form = new ConsultForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->sendRequest()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /**
     * Задать вопрос
     */
    public function actionQuestion() {
        $form = new QuestionForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->sendQuestion()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /**
     * Задать вопрос
     */
    public function actionSendRebuilding() {
        $form = new RebuildingRequestForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->sendRequest()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /**
     * @param string $anchor
     * @return string
     */
    public static function getIndexUrl($anchor = null) {
        $url = self::getUrlForCurrentLanguage(['building/index']);
        if(!empty($anchor)) {
            $url .= "#{$anchor}";
        }
        return $url;
    }

    /** @var PoolType|null */
    private $type = null;

    /**
     * Страница типа бассейна
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionType($slug) {
        $language = self::getCurrentLanguage();
        $type = PoolTypesRepository::getInstance()->findTypeBySlugAndLanguage($slug, $language);
        $additionParentCategoriesTypes = [
            3 => 'gidromassazhnye-bassejny',
            4 => 'kupeli'
        ];
        $additionCategoriesBlock = null;
        if(in_array($type->getId(), array_keys($additionParentCategoriesTypes))) {
            $additionCategorySlug = $additionParentCategoriesTypes[$type->getId()];
            $additionParentCategory = AdditionCategoriesRepository::getInstance()->findAdditionCategoryBySlugAndLanguage($additionCategorySlug, $language);
            $additionChildCategories = $additionParentCategory->getChildren();
            $additionCategoriesBlock = $this->renderPartial('custom-type/' . array_flip($additionParentCategoriesTypes)[$additionCategorySlug], [
                'additionChildCategories' => $additionChildCategories,
                'language' => $language
            ]);
        }
        if(empty($type)) {
            throw new NotFoundHttpException();
        }
        $this->type = $type;
        return $this->render('type', [
            'language' => $language,
            'type' => $type,
            'typeI18n' => $type->getI18n($language),
            'galleries' => $type->getObjectGalleries(),
            'advantages' => $type->getAdvantages(),
            'additionCategoriesBlock' => $additionCategoriesBlock
        ]);
    }

    /**
     * Страница реконструкции бассейна
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionRebuilding(){

        $language = self::getCurrentLanguage();
        $poolRebuildingType = $this->getEntityManager()->getRepository('Models:PoolType')->findOneBy(['id' => 5]);
        $objectGalleries = $poolRebuildingType->getObjectGalleries();
        $rebuilding = $this->getEntityManager()->find('Models:PoolsBuildingStatic', PoolsBuildingStatic::REBUILDING_ID);

        if(empty($rebuilding)) {
            throw new NotFoundHttpException();
        }
        return $this->render('rebuilding', [
            'language' => $language,
            'rebuilding' => $rebuilding,
            'objectGalleries' => $objectGalleries,
            'rebuildingI18n' => $rebuilding->getI18n($language)
        ]);
    }

    public static function getRebuildingUrl() {
        return '/building/rebuilding';
    }

    /** @inheritdoc */
    public function getCurrentUrlForLanguage(Language $language) {

        if(!empty($this->type)) {
            /** @var PoolTypeI18n|null $typeI18n */
            $typeI18n = $this->type->getI18n($language);
            if(!empty($typeI18n)) {
                return Url::to([
                    'building/type',
                    'slug' => $typeI18n->getSlug(),
                    'language' => $language->getCode(),
                ]);
            } else {
                return Url::to([
                    'building/index',
                    'language' => $language->getCode(),
                ]);
            }
        }

        return parent::getCurrentUrlForLanguage($language);
    }

    /**
     * @param PoolType $type
     * @return string
     */
    public static function getTypeUrl(PoolType $type) {
        $language = self::getCurrentLanguage();
        /** @var PoolTypeI18n|null $i18n */
        $i18n = $type->getI18n($language);
        if(empty($i18n)) {
            return null;
        }
        return self::getUrlForCurrentLanguage([
            'building/type', 'slug' => $i18n->getSlug()
        ]);
    }

    /**
     * @param ObjectGallery $gallery
     * @return string
     */
    public static function getGalleryUrl(ObjectGallery $gallery) {
        return GalleriesController::getGalleryUrl($gallery);
    }

}
