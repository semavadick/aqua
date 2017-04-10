<?php

use app\widgets\MyModal;
use yii\helpers\Html;
?>

<div class="manufacturing-video">
    <div class="header">
        <div class="center">
            <header class="main-head">
                <h3><?= Yii::t('app','Manufacturing video') ?></h3>
            </header>
        </div>
    </div>
    <div class="video-section">
        <div class="center">
            <div class="frame">
                <div class="video">
                    <img src="<?= $this->getPublishedFileUrl('images/img2.jpg') ?>" alt="<?= Yii::t('app','Manufacturing video') ?>">
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
                                    videoId: '<?= $serviceI18n->getVideo() ?>',
                                });
                            }
                            function stopVideo() {
                                player.stopVideo();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>