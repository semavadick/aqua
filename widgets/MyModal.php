<?php

namespace app\widgets;

use yii\base\Widget;

/**
 * Виджет модального окна
 */
class MyModal extends Widget
{

    public $noPadding = false;

    /**
     * @var string Контент модального окна
     */
    public $content = '';

    /**
     * @inheritDoc
     */
    public function run()
    {
        return $this->render('myModal', [
            'id' => $this->id,
            'content' => $this->content,
            'noPadding' => $this->noPadding,
        ]);
    }

}