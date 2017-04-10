<div id="typeCatalogKupeli" class="type-catalog-categories">
    <div class="center">
        <?php $i=0; foreach($additionChildCategories as $category):?>
            <div class="category-wrap-<?=($i+1)?>">
                <div class="type-catalog-category">
                    <h3 class="category-title"><?= $category->getI18n($language)->getName()?></h3>
                    <div class="visual"><img src="/images/types-addition-categories/kupeli-<?= ($i+1)?>.jpg" alt="<?= $category->getI18n($language)->getName()?>"></div>
                    <div class="hidden-block">
                        <div class="holder">
                            <div class="frame">
                                <h3><?= $category->getI18n($language)->getName()?></h3>
                                <i class="ico-arr"></i>
                                <div class="category-products">
                                    <?php foreach($category->getProducts() as $product):?>
                                        <a class="category-product-link" href="<?= \app\controllers\StoreController::getProductUrl($product)?>">
                                            <?php if($product->getKupelType()):?>
                                                переливная
                                            <?php else:?>
                                                скиммерная
                                            <?php endif;?>
                                        </a>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php $i++; endforeach;?>
    </div>
</div>