<?php

namespace app\controllers;

use app\models\AboutPage;
use app\models\AboutPageI18n;
use app\models\Language;
use app\models\ObjectGallery;
use app\models\ObjectGalleryI18n;
use app\models\PoolType;
use app\models\PoolTypeI18n;
use app\repositories\ObjectGalleriesRepository;
use app\repositories\PoolTypesRepository;
use app\repositories\ProductionImagesRepository;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class GalleriesController extends Controller {

    /** @var ObjectGallery|null */
    private $gallery = null;

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionGallery($slug) {
        $language = self::getCurrentLanguage();
        $gallery = ObjectGalleriesRepository::getInstance()->findGalleryBySlugAndLanguage($slug, $language);
        if(empty($gallery)) {
            throw new NotFoundHttpException();
        }
        $types = PoolTypesRepository::getInstance()->findPoolTypesForGalleryPage($language);
        $this->gallery = $gallery;
        $activeType = null;
        foreach($gallery->getPoolTypes() as $type) {
            $activeType = $type;
            break;
        }
        return $this->render('gallery', [
            'language' => $language,
            'gallery' => $gallery,
            'galleryI18n' => $gallery->getI18n($language),
            'types' => $types,
            'activeType' => $activeType,
        ]);
    }

    /**
     * @param ObjectGallery $gallery
     * @return string
     */
    public static function getGalleryUrl(ObjectGallery $gallery) {
        $language = self::getCurrentLanguage();
        /** @var ObjectGalleryI18n|null $i18n */
        $i18n = $gallery->getI18n($language);
        if(empty($i18n)) {
            return null;
        }
        return self::getUrlForCurrentLanguage([
            'galleries/gallery', 'slug' => $i18n->getSlug()
        ]);
    }

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionType($slug) {
        $language = self::getCurrentLanguage();
        $type = PoolTypesRepository::getInstance()->findTypeBySlugAndLanguage($slug, $language);
        if(empty($type)) {
            throw new NotFoundHttpException();
        }
        $typeI18n = $type->getI18n($language);
        $galleries = $type->getObjectGalleries();
        $types = PoolTypesRepository::getInstance()->findPoolTypesForGalleryPage($language);
        return $this->render('type', [
            'language' => $language,
            'types' => $types,
            'type' => $type,
            'typeI18n' => $typeI18n,
            'galleries' => $galleries,
        ]);
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
            'galleries/type', 'slug' => $i18n->getSlug()
        ]);
    }

    /** @inheritdoc */
    public function getCurrentUrlForLanguage(Language $language) {

        if(!empty($this->gallery)) {
            /** @var ObjectGalleryI18n|null $galleryI18n */
            $galleryI18n = $this->gallery->getI18n($language);
            if(!empty($galleryI18n)) {
                return Url::to([
                    'galleries/gallery',
                    'slug' => $galleryI18n->getSlug(),
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
     * @return string
     */
    public function actionProductionGallery() {
        $language = self::getCurrentLanguage();
        $images = ProductionImagesRepository::getInstance()->findImagesForAboutPage(null, $language);
        $types = PoolTypesRepository::getInstance()->findPoolTypesForGalleryPage($language);
        /** @var AboutPage $page */
        $page = $this->getEntityManager()->find('Models:AboutPage', 0);
        /** @var AboutPageI18n $pageI18n */
        $pageI18n = $page->getI18n($language);
        return $this->render('productionGallery', [
            'language' => $language,
            'images' => $images,
            'types' => $types,
            'page' => $page,
            'pageI18n' => $pageI18n,
        ]);
    }

    /**
     * @return string
     */
    public static function getProductionGalleryUrl() {
        return self::getUrlForCurrentLanguage([
            'galleries/production-gallery'
        ]);
    }

}