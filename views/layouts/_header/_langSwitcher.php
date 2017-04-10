<?php
/**
 * Переключатель языков
 *
 * @var app\components\View $this
 */

$controller = $this->context;
?>

<ul class="lang-switcher">
    <?php foreach($controller->getLanguages() as $language): ?>
        <li class="<?= $controller->languageIsCurrent($language) ? 'active' : '' ?>">
            <a href="<?= $controller->getCurrentUrlForLanguage($language) ?>">
                <?= $language->getLabelForSwitcher()  ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
