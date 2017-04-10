<?php
namespace app\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;
use yii\helpers\Json;

class Recaptcha extends InputWidget
{
    /**
     * Except languages.
     */
    const EXCEPT = ['zh-HK','zh-CN','zh-TW','en-GB','fr-CA','de-AT','de-CH','pt-BR','pt-PT','es-419'];
    /**
     * Options of JS script.
     * @see https://developers.google.com/recaptcha/docs/display#js_api
     * @var array
     */
    public $clientOptions = [];
    /**
     * Flag of rendering noscript section.
     * @var bool
     */
    public $renderNoScript = true;

    public $jsCallback;
    public $jsExpiredCallback;
    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();
        $this->customFieldPrepare();
        $this->registerScripts();

        echo Html::tag('div', null, [
            'id' => $this->options['id'] . '-recaptcha-container'
        ]);
        if($this->renderNoScript) {
            $this->renderNoScript();
        }
    }
    /**
     * Registration client scripts.
     */
    protected function registerScripts()
    {
        $view = $this->getView();
        $view->registerJsFile(
            "//www.google.com/recaptcha/api.js?hl=" . $this->getLanguagePrefix(),
            ['position' => $view::POS_HEAD, 'async' => true, 'defer' => true]
        );

        $options = ArrayHelper::merge([
            'sitekey' => Yii::$app->params['recaptcha']['sitekey'],
            'callback' => $this->jsCallback,
            'expired-callback' => $this->jsExpiredCallback
        ], $this->clientOptions);

        $view->registerJs(
            'grecaptcha.render("' . $this->options['id'] . '-recaptcha-container", ' . Json::encode($options) . ');',
            $view::POS_LOAD
        );
    }
    /**
     * Rendering noscript section.
     */
    protected function renderNoScript()
    {
        echo Html::beginTag('noscript');
        echo Html::tag('iframe', null, [
            'src' => 'https://www.google.com/recaptcha/api/fallback?k=' . Yii::$app->params['recaptcha']['sitekey'],
            'frameborder' => 0,
            'width' => '302px',
            'height' => '423px',
            'scrolling' => 'no',
            'border-style' => 'none'
        ]);
        echo Html::textarea('g-recaptcha-response', null, [
            'class' => 'form-control',
            'style' => 'margin-top: 15px'
        ]);
        echo Html::endTag('noscript');
    }
    /**
     * Normalize language code.
     * @return string
     */
    protected function getLanguagePrefix()
    {
        $language = Yii::$app->language;
        if(!in_array($language, self::EXCEPT) && preg_match('/[a-z]+-[A-Z0-9]+/', $language)) {
            $language = explode('-', $language)[0];
        }
        return $language;
    }

    protected function customFieldPrepare()
    {
        $view = $this->getView();
        if ($this->hasModel()) {
            $inputName = Html::getInputName($this->model, $this->attribute);
            $inputId = Html::getInputId($this->model, $this->attribute);
        } else {
            $inputName = $this->name;
            $inputId = 'recaptcha-' . $this->name;
        }
        $idHash = md5($inputId);
        if (empty($this->jsCallback)) {
            $jsCode = "var rC_{$idHash} = function(response){jQuery('#{$inputId}').val(response);};";
        } else {
            $jsCode = "var rC_{$idHash} = function(response){jQuery('#{$inputId}').val(response); {$this->jsCallback}(response);};";
        }
        $this->jsCallback = "rC_{$idHash}";
        if (empty($this->jsExpiredCallback)) {
            $jsExpCode = "var rEC_{$idHash} = function(){jQuery('#{$inputId}').val('');};";
        } else {
            $jsExpCode = "var rEC_{$idHash} = function(){jQuery('#{$inputId}').val(''); {$this->jsExpiredCallback}();};";
        }
        $this->jsExpiredCallback = "rEC_{$idHash}";
        $view->registerJs($jsCode, $view::POS_END);
        $view->registerJs($jsExpCode, $view::POS_END);
        echo Html::input('hidden', $inputName, null, ['id' => $inputId]);
    }
}