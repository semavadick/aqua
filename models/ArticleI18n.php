<?php

namespace app\models;

use app\components\Doctrine;
use app\helpers\SlugHelper;
use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией статей
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ArticleI18n extends PublicationI18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Article", inversedBy="i18ns")
     * @ORM\JoinColumn(name="articleId", referencedColumnName="id")
     */
    protected $article;

    /**
     *
     * @inheritdoc
     * @return Article
     */
    public function getPublication() {
        return $this->article;
    }

    /**
     *
     * @inheritdoc
     * @param Article $publication
     */
    public function setPublication(Publication $publication) {
        $this->article = $publication;
    }

    /** @ORM\PreFlush() */
    public function generateSlug() {
        if(!empty($this->slug)) {
            return;
        }
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        $this->slug = (new SlugHelper())->generateUniqueSlugForI18n($this, $this->name, $doctrine->getEntityManager()->getRepository('Models:ArticleI18n'));
    }

}