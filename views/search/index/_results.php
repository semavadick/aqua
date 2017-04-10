<?php
/**
 * @var \app\components\View $this
 * @var \app\forms\SearchResult[] $results
 */
?>

<?php foreach($results as $result): ?>

    <a class="s-result" href="<?= $result->link ?>">
        <?= $result->text ?>
    </a>

<?php endforeach; ?>