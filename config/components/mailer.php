<?php
/**
 * Конифг для компонента mailer
 */

return [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@app/mail',
    'htmlLayout' => 'layouts/general',
    'useFileTransport' => false,
];