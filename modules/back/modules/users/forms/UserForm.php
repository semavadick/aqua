<?php

namespace back\Users\forms;

use app\models\Category;
use app\models\AdditionCategory;
use app\models\Entity;
use app\models\User;
use app\models\UserCategoryDiscount;
use app\models\UserAdditionCategoryDiscount;
use app\repositories\CategoriesRepository;
use app\repositories\AdditionCategoriesRepository;
use app\repositories\UsersRepository;
use back\forms\EntityForm;

class UserForm extends EntityForm {

    public $email = '';
    public $fullName = '';
    public $phone = '';
    public $status = User::STATUS_ACTIVE;
    public $role = User::ROLE_CLIENT;
    public $password = '';
    public $type = User::TYPE_PERSON;
    public $companyType = User::COMPANY_TYPE_OOO;
    public $companyName = '';
    public $companyINN = '';
    public $companyKPP = '';
    public $companyBank = '';
    public $companyCheckingAccount = '';
    public $companyCreditAccount = '';
    public $companyLegalAddress = '';
    public $companyActualAddress = '';
    public $companyCEO = '';
    public $discount = null;
    public $categoriesDiscounts = [];
    public $additionCategoriesDiscounts = [];
    /** @var UserCategoryDiscount[] */
    private $discountsToDelete = [];
    /** @var UserAdditionCategoryDiscount[] */
    private $additionDiscountsToDelete = [];

    /** @var User|null */
    public $user = null;

    public function rules() {
        $rules = [
            ['email', 'required', 'message' => 'Укажите email'],
            ['email', 'email'],
            ['email', 'checkEmail'],

            ['password', 'required', 'message' => 'Укажите пароль', 'when' => function(UserForm $form) {
                return empty($form->user);
            }],

            ['discount', 'number', 'min' => 0, 'max' => 100],

            [
                [
                    'fullName', 'phone', 'password', 'status', 'role',
                    'type', 'companyType', 'companyName', 'companyINN', 'companyKPP',
                    'companyBank', 'companyCheckingAccount', 'companyCreditAccount',
                    'companyLegalAddress', 'companyActualAddress', 'companyCEO',
                    'discount', 'categoriesDiscounts','additionCategoriesDiscounts'
                ],
                'safe'
            ],
        ];
        return $rules;
    }

    public function attributeLabels() {
        return [
            'discount' => 'Общая скидка',
        ];
    }

    public function checkEmail() {
        $email = trim($this->email);
        $user = UsersRepository::getInstance()->findUserByEmail($email);
        if(empty($user)) {
            return;
        }
        if(empty($this->user) || $this->user->getId() != $user->getId()) {
            $this->addError('email', 'Пользоваетль с таким email уже существует');
        }
    }

    /**
     * @inheritdoc
     * @param User $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->user = $entity;
        $this->email = $entity->getEmail();
        $this->fullName = $entity->getFullName();
        $this->phone = $entity->getPhone();
        $this->status = $entity->getStatus();
        $this->role = $entity->getRole();
        $this->type = $entity->getType();
        $this->companyType = $entity->getCompanyType();
        $this->companyName = $entity->getCompanyName();
        $this->companyINN = $entity->getCompanyINN();
        $this->companyKPP = $entity->getCompanyKPP();
        $this->companyBank = $entity->getCompanyBank();
        $this->companyCheckingAccount = $entity->getCompanyCheckingAccount();
        $this->companyCreditAccount = $entity->getCompanyCreditAccount();
        $this->companyLegalAddress = $entity->getCompanyLegalAddress();
        $this->companyActualAddress = $entity->getCompanyActualAddress();
        $this->companyCEO = $entity->getCompanyCEO();
        $this->discount = $entity->getDiscount();
        $this->categoriesDiscounts = [];
        $this->additionCategoriesDiscounts = [];
        foreach($entity->getCategoriesDiscounts() as $categoryDiscount) {
            $this->categoriesDiscounts[] = [
                'categoryId' => $categoryDiscount->getCategory()->getId(),
                'discount' => $categoryDiscount->getDiscount(),
            ];
            $this->discountsToDelete[$categoryDiscount->getCategory()->getId()] = $categoryDiscount;
        }
        foreach($entity->getAdditionCategoriesDiscounts() as $categoryDiscount) {
            $this->additionCategoriesDiscounts[] = [
                'categoryId' => $categoryDiscount->getCategory()->getId(),
                'discount' => $categoryDiscount->getDiscount(),
            ];
            $this->additionDiscountsToDelete[$categoryDiscount->getCategory()->getId()] = $categoryDiscount;
        }
    }

    /**
     * @inheritdoc
     * @param User $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setEmail($this->email);
        $entity->setFullName($this->fullName);
        $entity->setPhone($this->phone);
        $entity->setStatus($this->status);
        $entity->setRole($this->role);
        $entity->setType($this->type);
        $entity->setCompanyType($this->companyType);
        $entity->setCompanyName($this->companyName);
        $entity->setCompanyKPP($this->companyKPP);
        $entity->setCompanyINN($this->companyINN);
        $entity->setCompanyBank($this->companyBank);
        $entity->setCompanyCheckingAccount($this->companyCheckingAccount);
        $entity->setCompanyCreditAccount($this->companyCreditAccount);
        $entity->setCompanyLegalAddress($this->companyLegalAddress);
        $entity->setCompanyActualAddress($this->companyActualAddress);
        $entity->setCompanyCEO($this->companyCEO);
        $entity->setDiscount($this->discount ? $this->discount : null);
        if(!empty($this->password)) {
            $entity->setPassword($this->password);
        }
        foreach($this->categoriesDiscounts as $data) {

            if(empty($data['categoryId']) || empty($data['discount'])) {
                continue;
            }
            $categoryId = $data['categoryId'];
            /** @var Category|null $category */
            $category = CategoriesRepository::getInstance()->find($categoryId);
            if(empty($category)) {
                continue;
            }

            $categoryDiscount = null;
            if(isset($this->discountsToDelete[$categoryId])) {
                $categoryDiscount = $this->discountsToDelete[$categoryId];
                unset($this->discountsToDelete[$categoryId]);
            } else {
                $categoryDiscount = new UserCategoryDiscount();
                $categoryDiscount->setUser($entity);
                $categoryDiscount->setCategory($category);
            }
            $categoryDiscount->setDiscount($data['discount']);
            $this->getEntityManager()->persist($categoryDiscount);
        }
        foreach($this->additionCategoriesDiscounts as $data) {
            if(empty($data['categoryId']) || empty($data['discount'])) {
                continue;
            }
            $categoryId = $data['categoryId'];
            /** @var AdditionCategory|null $category */
            $category = AdditionCategoriesRepository::getInstance()->find($categoryId);
            if(empty($category)) {
                continue;
            }

            $additionCategoryDiscount = null;
            if(isset($this->additionDiscountsToDelete[$categoryId])) {
                $additionCategoryDiscount = $this->additionDiscountsToDelete[$categoryId];
                unset($this->additionDiscountsToDelete[$categoryId]);
            } else {
                $additionCategoryDiscount = new UserAdditionCategoryDiscount();
                $additionCategoryDiscount->setUser($entity);
                $additionCategoryDiscount->setCategory($category);
            }
            $additionCategoryDiscount->setDiscount($data['discount']);

            $this->getEntityManager()->persist($additionCategoryDiscount);
        }
        foreach($this->discountsToDelete as $categoryDiscount) {
            $this->getEntityManager()->remove($categoryDiscount);
        }
        foreach($this->additionDiscountsToDelete as $additionCategoryDiscount) {
            $this->getEntityManager()->remove($additionCategoryDiscount);
        }
        return true;
    }



    /** @inheritdoc */
    protected function createNewEntity() {
        return new User();
    }

    /** @inheritdoc */
    protected function createNewI18nForm() {
        return null;
    }

}