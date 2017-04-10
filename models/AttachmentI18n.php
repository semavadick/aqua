<?php

namespace app\models;

use back\helpers\HandyFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией принадлжености
 * @ORM\Entity()
 */
class AttachmentI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Attachment", inversedBy="i18ns")
     * @ORM\JoinColumn(name="attachmentId", referencedColumnName="id")
     */
    protected $attachment;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="text") */
    protected $text = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return Attachment */
    public function getAttachment() { return $this->attachment; }

    /** @param Attachment $attachment */
    public function setAttachment($attachment) { $this->attachment = $attachment; }

    /** @return string */
    public function getText() { return $this->text; }

    /** @param string $text */
    public function setText($text) { $this->text = $text; }

}