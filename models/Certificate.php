<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с сертификатом
 * @ORM\Entity(repositoryClass="app\repositories\CertificatesRepository")
 */
class Certificate extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="app\models\CertificateI18n", mappedBy="certificate")
     */
    protected $i18ns;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @ORM\Column(type="string") */
    protected $previewPath = '';

    /** @ORM\Column(type="string") */
    protected $imagePath = '';

    const IMAGE_WIDTH = 774;
    const IMAGE_HEIGHT = 1086;

    const PREVIEW_WIDTH = 258;
    const PREVIEW_HEIGHT = 362;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return string Путь до изображения */
    public function getImagePath() { return $this->imagePath; }

    /** @param string $imagePath Путь до изображения */
    public function setImagePath($imagePath) { $this->imagePath = $imagePath; }

    /** @return string Url изображения */
    public function getImageUrl() { return $this->imagePath; }

    /** @return int Сортировка */
    public function getSort() { return $this->sort; }

    /** @param int $sort Сортировка */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return CertificateI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getPreviewPath() { return $this->previewPath; }

    /** @return string */
    public function getPreviewUrl() { return $this->previewPath; }

    /** @param string $previewPath */
    public function setPreviewPath($previewPath) { $this->previewPath = $previewPath; }

}