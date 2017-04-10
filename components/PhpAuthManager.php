<?php


namespace app\components;

use yii\rbac\PhpManager;

/**
 * Компонент аутентификации
 */
class PhpAuthManager extends PhpManager
{
    /**
     * @inheritdoc
     */
    protected final function saveAssignments()
    {
        // Не сохраняем assignments в файл
    }
} 