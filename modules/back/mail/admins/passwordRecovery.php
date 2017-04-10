<?php
/**
 * Письмо с ссылкой для восстановления пароля
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $link Ссылка для восстановления пароля
 */

$message->setSubject('Восстановление пароля');
?>
<p>
    Для восстановления пароля пройдите по ссылке:
    <br>
    <a href="<?= $link ?>">
        <?= $link ?>
    </a>
</p>