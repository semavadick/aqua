<?php

namespace app\models;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы со скидками юзеров на категории
 * @ORM\Entity()
 */
class UserCategoryDiscount {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\User", inversedBy="categoriesDiscounts")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * @var User|null Пользователь
     */
    protected $user;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Category")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     * @var Category|null Категория
     */
    protected $category;

    /**
     * @ORM\Column(type="float")
     * @var float|null Скидка
     */
    protected $discount = null;


    /** @return float|null */
    public function getDiscount() { return $this->discount; }

    /** @param float|null $discount */
    public function setDiscount($discount) { $this->discount = $discount; }

    /** @return User|null */
    public function getUser() { return $this->user; }

    /** @param User $user */
    public function setUser($user) { $this->user = $user; }

    /** @return Category|null */
    public function getCategory() { return $this->category; }

    /** @param Category $category */
    public function setCategory($category) { $this->category = $category; }

}