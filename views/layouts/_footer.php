<?php
/**
 * Футер
 *
 * @var app\components\View $this
 */

$setting = $this->context->getSetting();
?>

<footer id="footer">
    <div class="center">
        <div class="left-holder">
            <span class="copy">© 1998-<?= date('Y') ?>, Aquasector</span>
            <span class="propriety"><?= Yii::t('app', 'All rights reserved.') ?></span>
        </div>

        <ul class="soc-links">
            <li>
                <a href="<?= $setting->getFacebookLink() ?>" target="_blank">
                    <i class="ico ico1"></i>
                </a>
            </li>
            <li>
                <a href="<?= $setting->getTwitterLink() ?>" target="_blank">
                    <i class="ico ico2"></i>
                </a>
            </li>
            <li>
                <a href="<?= $setting->getYoutubeLink() ?>" target="_blank">
                    <i class="ico ico3"></i>
                </a>
            </li>
        </ul>
    </div>
</footer>