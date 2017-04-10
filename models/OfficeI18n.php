<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией офисов
 * @ORM\Entity()
 */
class OfficeI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Office", inversedBy="i18ns")
     * @ORM\JoinColumn(name="officeId", referencedColumnName="id")
     */
    protected $office;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @ORM\Column(type="string") */
    protected $address = '';

    /** @ORM\Column(type="string") */
    protected $phoneComment = '';

    /** @ORM\Column(type="string") */
    protected $email = '';

    /** @ORM\Column(type="text") */
    protected $comment = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return Office */
    public function getOffice() { return $this->office; }

    /** @param Office $office */
    public function setOffice($office) { $this->office = $office; }

    /** @return string */
    public function getAddress() { return $this->address; }

    /** @param string $address */
    public function setAddress($address) { $this->address = $address; }

    /** @return string */
    public function getPhoneComment() { return $this->phoneComment; }

    /** @param string $phoneComment */
    public function setPhoneComment($phoneComment) { $this->phoneComment = $phoneComment; }

    /** @return string */
    public function getComment() { return $this->comment; }

    /** @param string $comment */
    public function setComment($comment) { $this->comment = $comment; }

    /** @return string */
    public function getEmail() { return $this->email; }

    /** @param string $email */
    public function setEmail($email) { $this->email = $email; }

}