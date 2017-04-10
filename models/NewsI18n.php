<?php

namespace app\models;

use app\components\Doctrine;
use app\helpers\SlugHelper;
use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией новостей
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class NewsI18n extends PublicationI18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\News", inversedBy="i18ns")
     * @ORM\JoinColumn(name="newsId", referencedColumnName="id")
     */
    protected $newsItem;

    /**
     *
     * @inheritdoc
     * @return News
     */
    public function getPublication() {
        return $this->newsItem;
    }

    /**
     *
     * @inheritdoc
     * @param News $publication
     */
    public function setPublication(Publication $publication) {
        $this->newsItem = $publication;
    }

    /** @ORM\PreFlush() */
    public function generateSlug() {
        if(!empty($this->slug)) {
            return;
        }
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        $this->slug = (new SlugHelper())->generateUniqueSlugForI18n($this, $this->name, $doctrine->getEntityManager()->getRepository('Models:NewsI18n'));
    }

}