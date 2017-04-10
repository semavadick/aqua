<?php

namespace app\models;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с юзерами
 * @ORM\Entity(repositoryClass="app\repositories\UsersRepository")
 * @ORM\Table(name="User")
 */
class User extends Entity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $status = self::STATUS_NOT_VERIFIED;

    /** @ORM\Column(type="integer") */
    protected $role = self::ROLE_CLIENT;

    /** Роль "Клиент" */
    const ROLE_CLIENT = 1;

    /** Роль "Менеджер" */
    const ROLE_MANAGER = 2;

    /** Роль "Админ" */
    const ROLE_ADMIN = 3;

    /** @ORM\Column(type="string") */
    protected $email = '';

    /** @ORM\Column(type="string") */
    protected $authKey = '';

    /** @ORM\Column(type="string") */
    protected $passwordHash = '';

    /** @ORM\Column(type="string") */
    protected $fullName = '';

    /** Статус "Не подтверджен" */
    const STATUS_NOT_VERIFIED = 1;

    /** Статус "Активный" */
    const STATUS_ACTIVE = 2;

    /** Статус "Заблокирован" */
    const STATUS_BLOCKED = 3;

    /**
     * @ORM\Column(type="string")
     * @var string Телефон
     */
    protected $phone = '';

    /**
     * @ORM\Column(type="integer")
     * @var int Тип клиента
     */
    protected $type = self::TYPE_PERSON;

    /** Тип клиента "Физическое лицо" */
    const TYPE_PERSON = 0;

    /** Тип клиента "Компания" */
    const TYPE_COMPANY = 1;

    /**
     * @ORM\Column(type="integer")
     * @var int Тип компании
     */
    protected $companyType = self::COMPANY_TYPE_ZAO;

    /** Тип клиента "ЗАО" */
    const COMPANY_TYPE_ZAO = 0;

    /** Тип клиента "ООО" */
    const COMPANY_TYPE_OOO = 1;

    /** Тип клиента "ИП" */
    const COMPANY_TYPE_IP = 2;

    /**
     * @ORM\Column(type="string")
     * @var string Название компании
     */
    protected $companyName = '';

    /**
     * @ORM\Column(type="string")
     * @var string ИНН компании
     */
    protected $companyINN = '';

    /**
     * @ORM\Column(type="string")
     * @var string КПП компании
     */
    protected $companyKPP = '';

    /**
     * @ORM\Column(type="string")
     * @var string Банк компании
     */
    protected $companyBank = '';

    /**
     * @ORM\Column(type="string")
     * @var string Р/С компании
     */
    protected $companyCheckingAccount = '';

    /**
     * @ORM\Column(type="string")
     * @var string К/С компании
     */
    protected $companyCreditAccount = '';

    /**
     * @ORM\Column(type="string")
     * @var string Юр. адрес компании
     */
    protected $companyLegalAddress = '';

    /**
     * @ORM\Column(type="string")
     * @var string Факт. адрес компании
     */
    protected $companyActualAddress = '';

    /**
     * @ORM\Column(type="string")
     * @var string Ген. директор компании
     */
    protected $companyCEO = '';

    /**
     * @ORM\Column(type="float")
     * @var float|null Общая скидка
     */
    protected $discount = null;

    /**
     * @ORM\OneToMany(targetEntity="app\models\UserCategoryDiscount", mappedBy="user")
     * @var UserCategoryDiscount[]
     */
    protected $categoriesDiscounts;

    /**
     * @ORM\OneToMany(targetEntity="app\models\UserAdditionCategoryDiscount", mappedBy="user")
     * @var UserAdditionCategoryDiscount[]
     */
    protected $additionCategoriesDiscounts;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $companyInfoFilePath = '';

    /**
     * @ORM\OneToMany(targetEntity="app\models\Order", mappedBy="user")
     * @var Order[]
     */
    protected $orders = [];

    public function __construct() {
        $this->categoriesDiscounts = new ArrayCollection();
        $this->additionCategoriesDiscounts = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    /** @return bool Активный ли юзер */
    public function isActive() { return $this->status == self::STATUS_ACTIVE; }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return int Статус */
    public function getStatus() { return $this->status; }

    /** @param int $status Статус */
    public function setStatus($status) { $this->status = $status; }

    /** @return int Роль */
    public function getRole() { return $this->role; }

    /** @param int $role Роль */
    public function setRole($role) { $this->role = $role; }

    /** @return string Email */
    public function getEmail() { return $this->email; }

    /** @param string $email Email */
    public function setEmail($email) { $this->email = $email; }

    /** @return string Имя и фамилия */
    public function getFullName() { return $this->fullName; }

    /** @param string $fullName Имя и фамилия */
    public function setFullName($fullName) { $this->fullName = $fullName; }

    /** @return string Auth key */
    public function getAuthKey() { return $this->authKey; }

    /** @param string $authKey Auth key */
    public function setAuthKey($authKey) { $this->authKey = $authKey; }

    /** @return string Hash пароля */

    public function getPasswordHash() { return $this->passwordHash; }
    /** @param string $password Пароль */
    public function setPassword($password) {
        $this->passwordHash = \Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * @param string $password Пароль
     * @return bool Совпадает ли пароль юзера с данным паролем
     */
    public function validatePassword($password) {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->passwordHash);
    }

    /** @return int */
    public function getType() { return $this->type; }

    /** @param int $type */
    public function setType($type) { $this->type = $type; }

    /** @return array Лейблы типов (type => label) */
    public function getTypeLabels() {
        return [
            self::TYPE_PERSON => 'Физическое лицо',
            self::TYPE_COMPANY => 'Компания',
        ];
    }

    /** @return string Label типа */
    public function getTypeLabel() {
        return $this->getTypeLabels()[$this->type];
    }

    /** @return int */
    public function getCompanyType() { return $this->companyType; }

    /** @param int $companyType */
    public function setCompanyType($companyType) { $this->companyType = $companyType; }

    /** @return array Лейблы типов компании (type => label) */
    public function getCompanyTypeLabels() {
        return [
            self::COMPANY_TYPE_ZAO => 'ЗАО',
            self::COMPANY_TYPE_OOO => 'ООО',
            self::COMPANY_TYPE_IP => 'ИП',
        ];
    }

    /** @return string Label типа компании */
    public function getCompanyTypeLabel() {
        return $this->getCompanyTypeLabels()[$this->companyType];
    }

    /** @return string */
    public function getCompanyName() { return $this->companyName; }

    /** @param string $companyName */
    public function setCompanyName($companyName) { $this->companyName = $companyName; }

    /** @return string */
    public function getCompanyINN() { return $this->companyINN; }

    /** @param string $companyINN */
    public function setCompanyINN($companyINN) { $this->companyINN = $companyINN; }

    /** @return string */
    public function getCompanyKPP() { return $this->companyKPP; }

    /** @param string $companyKPP */
    public function setCompanyKPP($companyKPP) { $this->companyKPP = $companyKPP; }

    /** @return string */
    public function getCompanyBank() { return $this->companyBank; }

    /** @param string $companyBank */
    public function setCompanyBank($companyBank) { $this->companyBank = $companyBank; }

    /** @return string */
    public function getCompanyCheckingAccount() { return $this->companyCheckingAccount; }

    /** @param string $companyCheckingAccount */
    public function setCompanyCheckingAccount($companyCheckingAccount) { $this->companyCheckingAccount = $companyCheckingAccount; }

    /** @return string */
    public function getCompanyCreditAccount() { return $this->companyCreditAccount; }

    /** @param string $companyCreditAccount */
    public function setCompanyCreditAccount($companyCreditAccount) { $this->companyCreditAccount = $companyCreditAccount; }

    /** @return string */
    public function getCompanyLegalAddress() { return $this->companyLegalAddress; }

    /** @param string $companyLegalAddress */
    public function setCompanyLegalAddress($companyLegalAddress) { $this->companyLegalAddress = $companyLegalAddress; }

    /** @return string */
    public function getCompanyActualAddress() { return $this->companyActualAddress; }

    /** @param string $companyActualAddress */
    public function setCompanyActualAddress($companyActualAddress) { $this->companyActualAddress = $companyActualAddress; }

    /** @return string */
    public function getCompanyCEO() { return $this->companyCEO; }

    /** @param string $companyCEO */
    public function setCompanyCEO($companyCEO) { $this->companyCEO = $companyCEO; }

    /** @return string */
    public function getPhone() { return $this->phone; }

    /** @param string $phone */
    public function setPhone($phone) { $this->phone = $phone; }

    /** @return int Кол-во заказов */
    public function getOrdersCount() {
        return count($this->orders);
    }

    /** @return float|null */
    public function getDiscount() { return $this->discount; }

    /** @param float|null $discount */
    public function setDiscount($discount) { $this->discount = $discount; }

    /** @return boolean */
    public function hasDiscount() { return !empty($this->discount); }

    /** @return UserCategoryDiscount[] */
    public function getCategoriesDiscounts() { return $this->categoriesDiscounts; }

    /** @param UserCategoryDiscount[] $categoriesDiscounts */
    public function setCategoriesDiscounts($categoriesDiscounts) { $this->categoriesDiscounts = $categoriesDiscounts; }

    /** @return UserAdditionCategoryDiscount[] */
    public function getAdditionCategoriesDiscounts() { return $this->additionCategoriesDiscounts; }

    /** @param UserAdditionCategoryDiscount[] $additionCategoriesDiscounts */
    public function setAdditionCategoriesDiscounts($additionCategoriesDiscounts) { $this->additionCategoriesDiscounts = $additionCategoriesDiscounts; }

    /** @return string */
    public function getCompanyInfoFilePath() { return $this->companyInfoFilePath; }

    /** @param string $companyInfoFilePath */
    public function setCompanyInfoFilePath($companyInfoFilePath) { $this->companyInfoFilePath = $companyInfoFilePath; }

    /** @return Order[] */
    public function getOrders() {
        $orders = $this->orders->toArray();
        usort($orders, function(Order $order1, Order $order2) {
            return $order2->getAdded()->getTimestamp() - $order1->getAdded()->getTimestamp();
        });
        return $orders;
    }

    /** @return I18n[] */
    protected function getI18ns() {
        return [];
    }

    /**
     * @param Category $category
     * @return float|null
     */
    public function getDiscountForCategory(Category $category) {
        foreach($this->getCategoriesDiscounts() as $categoryDiscount) {
            if($category->getId() == $categoryDiscount->getCategory()->getId()) {
                return $categoryDiscount->getDiscount();
            }
        }
        return null;
    }

    /**
     * @param AdditionCategory $category
     * @return float|null
     */
    public function getDiscountForAdditionCategory(AdditionCategory $category) {
        foreach($this->getAdditionCategoriesDiscounts() as $categoryDiscount) {
            if($category->getId() == $categoryDiscount->getCategory()->getId()) {
                return $categoryDiscount->getDiscount();
            }
        }
        return null;
    }

    /** @return string */
    public function getFullNameWithEmail() {
        return "{$this->fullName} ({$this->email})";
    }
}