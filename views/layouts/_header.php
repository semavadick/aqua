<?php

use app\controllers\SiteController;
use app\widgets\MyModal;
use app\controllers\AccountController;

/**
 * Шапка
 *
 * @var app\components\View $this
 */

$setting = $this->context->getSetting();

$applicationModal = new MyModal();
$applicationModal->id = 'application-modal';
$applicationModal->content = $this->render('_header/_applicationModal');
echo $applicationModal->run();

$authModal = new MyModal();
$authModal->id = 'auth-modal';
$authModal->noPadding = true;
$authModal->content = $this->render('_header/_authModalContent');
echo $authModal->run();

$wUser = $this->context->getWebUser();

$language = $this->context->getCurrentLanguage();
?>

<header id="header">
    <div class="center">
        <strong class="logo logo-<?= $language->getCode() ?>"><a href="<?= SiteController::getIndexUrl() ?>">aqua</a></strong>
        <div class="holder">
            <div class="row">

                <?= $this->render('_header/_infoHolder', [
                    'setting' => $setting
                ]) ?>

                <ul class="login-holder">
                    <li>
                        <?= $this->render('_header/_search') ?>
                    </li>

                    <li>
                        <?= $this->render('_header/_cart') ?>
                    </li>

                    <li>
                        <?php if($wUser->getIsGuest()): ?>

                            <a href="#" class="btn-auth">
                                <i class="user"></i>
                            </a>

                        <?php else: ?>

                            <div class="user-logining">
                                <a class="user-name" href="#"><?= $wUser->getFirstName() ?></a>
                                <div class="drop">
                                    <ul>
                                        <li>
                                            <a href="<?= AccountController::getProfileUrl() ?>"><?= Yii::t('app', 'My profile') ?></a>
                                        </li>
                                        <li>
                                            <a href="<?= AccountController::getLogoutUrl() ?>"><?= Yii::t('app', 'Logout') ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        <?php endif; ?>
                    </li>
                </ul>

                <a class="btn send-application" href="#"><?= Yii::t('app', 'contact us') ?></a>

            </div>

            <div class="row">

                <?= $this->render('_header/_nav', ['isDesktop' => true]) ?>

                <?= $this->render('_header/_langSwitcher') ?>

            </div>
        </div>
    </div>
    <a class="mob-btn" href="#"><span></span></a>
    <div class="mobile-nav-container">

        <?= $this->render('_header/_langSwitcher') ?>

        <?= $this->render('_header/_nav', ['isMobile' => true]) ?>

        <?= $this->render('_header/_infoHolder', [
            'isMobile' => true,
            'setting' => $setting
        ]) ?>

    </div>
</header>