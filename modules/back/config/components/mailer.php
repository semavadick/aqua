<?php
/**
 * Конифг для компонента mailer
 */

return [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@back/mail',
    'htmlLayout' => 'layouts/general',
    'useFileTransport' => false,
];