<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией сертификатов
 * @ORM\Entity()
 */
class CertificateI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Certificate", inversedBy="i18ns")
     * @ORM\JoinColumn(name="certificateId", referencedColumnName="id")
     */
    protected $certificate;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return Certificate */
    public function getCertificate() { return $this->certificate; }

    /** @param Certificate $certificate */
    public function setCertificate($certificate) { $this->certificate = $certificate; }

}