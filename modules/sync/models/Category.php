<?php

namespace sync\models;

class Category {

    /** @var string */
    public $id;

    /** @var Category|null */
    public $parent;

    /** @var string */
    public $name;

    /**
     * @param string $id
     * @param Category|null $parent
     * @param string $name
     */
    public function __construct($id, Category $parent = null, $name) {
        $this->id = $id;
        $this->parent = $parent;
        $this->name = $name;
    }

}