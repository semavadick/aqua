<?php

use app\widgets\MyModal;
use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\MainPage $page
 * @var \app\models\MainPageI18n $pageI18n
 */

$catalogModal = new MyModal();
$catalogModal->id = 'manager-contact-modal';
$catalogModal->content = $this->render('_managerContactModal');
echo $catalogModal->run();
?>

<div class="content">
    <header class="main-head">
        <h2><?= Html::encode($pageI18n->getAboutTitle()) ?></h2>
    </header>
    <div class="frame">

        <?= $pageI18n->getAboutText() ?>
		<div class="video">
            <img src="<?= $this->getPublishedFileUrl('images/img2.jpg') ?>" alt="<?= Html::encode($pageI18n->getAboutTitle()) ?>">
            <a href="#" class="btn-play"></a>

            <div class="video-code">
				<div id="yt-player"></div>
				<script>
				var tag = document.createElement('script');
				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
				
				var player;
				function onYouTubeIframeAPIReady() {
					player = new YT.Player('yt-player', {
						height: '424',
						width: '744',
						videoId: '<?= $pageI18n->getAboutVideo() ?>',
					});
				}				
				function stopVideo() {
					player.stopVideo();
				}
				</script>
          </div>
        </div>
		

        <div class="button-holder">
            <a href="#" class="btn contact-manager"><?= Yii::t('app', 'contact a manager') ?></a>
        </div>

    </div>
</div>