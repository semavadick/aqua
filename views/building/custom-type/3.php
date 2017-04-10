<div id="typeCatalogMassage" class="type-catalog-categories">
    <div class="center">
        <?php foreach($additionChildCategories as $category) :?>
        <?php $i=0; foreach($category->getProducts() as $product):?>
            <div class="category-wrap-<?=($i+1)?>">
                <div class="type-catalog-category">
                    <h3 class="category-title"><?= $product->getI18n($language)->getName()?></h3>
                    <div class="visual"><img src="/images/types-addition-categories/massage-<?= ($i+1)?>.jpg" alt="<?= $category->getI18n($language)->getName()?>"></div>
                    <div class="hidden-block">
                        <div class="holder">
                            <div class="frame">
                                <a class="category-product-link" href="<?= \app\controllers\StoreController::getProductUrl($product)?>">
                                    <div class="link-container">
                                        <h3><?= $product->getI18n($language)->getName()?></h3>
                                        <div class="price"><?= $this->context->getPriceHelper()->getFormattedPrice($product) ?></div>
                                        <i class="ico-arr"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; endforeach;?>
        <?php endforeach;?>
    </div>
</div>