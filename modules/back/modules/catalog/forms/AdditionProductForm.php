<?php

namespace back\Catalog\forms;

use app\models\AdditionCategory;
use app\models\Entity;
use app\models\AdditionProduct;
use app\models\Product;
use app\models\AdditionProductTab;
use app\models\AdditionProductOption;
use app\models\AdditionProductImage;
use app\repositories\AdditionCategoriesRepository;
use back\forms\EntityForm;
use back\helpers\HandyFile;
use back\validators\FormFileValidator;
use back\validators\FormImageValidator;

class AdditionProductForm extends EntityForm {

    public $categoryId = null;
    public $price = 0;
    public $sku = '';
    public $sort = 0;
    public $isOnOffer = true;
    public $kupelType = false;
    public $relatedProductsIds = [];
    public $relatedAdditionProductsIds = [];
    public $preview = '';
    public $figure = '';

    /** @var HandyFile|null */
    public $draft;
    public $draftIsDeleted;

    /** @var HandyFile|null */
    public $circuit;
    public $circuitIsDeleted;

    /** @var HandyFile|null */
    public $certificate;
    public $certificateIsDeleted;

    /** @var AdditionProduct|null */
    private $product = null;

    /** @var AdditionProductImageForm[] */
    private $imageForms = [];

    /** @var AdditionProductImage[] */
    private $imagesToDelete = [];

    /** @var AdditionProductTabForm[] */
    private $tabForms = [];

    /** @var AdditionProductOptionForm[] */
    private $optionForms = [];

    /** @var AdditionProductOption[] */
    private $optionsToDelete = [];

    /** @var AdditionProductTab[] */
    private $tabsToDelete = [];

    public function rules() {
        $rules = [
            [['sku', 'price'], 'required', 'message' => 'Заполните поле'],
            ['price', 'number', 'min' => 0],
            ['sort', 'number'],
            [['figure', 'categoryId', 'relatedProductsIds', 'relatedAdditionProductsIds'], 'safe'],
            [['isOnOffer','kupelType'], 'boolean'],
            ['preview', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->product) ? $this->product->getPreviewPath() : null;
            }],
            ['draftIsDeleted', 'boolean'],
            ['draft', FormFileValidator::className(), 'required' => false, 'getCurrentFilePath' => function() {
                return !empty($this->product) && !$this->draftIsDeleted  ? $this->product->getDraftPath() : null;
            }],
            ['circuitIsDeleted', 'boolean'],
            ['circuit', FormFileValidator::className(), 'required' => false, 'getCurrentFilePath' => function() {
                return !empty($this->product) && !$this->circuitIsDeleted  ? $this->product->getCircuitPath() : null;
            }],
            ['certificateIsDeleted', 'boolean'],
            ['certificate', FormFileValidator::className(), 'required' => false, 'getCurrentFilePath' => function() {
                return !empty($this->product) && !$this->certificateIsDeleted ? $this->product->getCertificatePath() : null;
            }],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function attributeLabels() {
        return [
            'price' => 'Цена',
        ];
    }

    /**
     * @inheritdoc
     * @param AdditionProduct $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->product = $entity;
        $this->isOnOffer = $entity->getIsOnOffer();
        $this->kupelType = $entity->getKupelType();
        $category = $entity->getCategory();
        $this->categoryId = !empty($category) ? $category->getId() : null;
        $this->sku = $entity->getSku();
        $this->price = $entity->getPrice();
        $this->figure = $entity->getFigure();
        $this->sort = $entity->getSort();

        foreach($entity->getRelatedProducts() as $relatedProduct) {
            $this->relatedProductsIds[] = $relatedProduct->getId();
        }

        foreach($entity->getRelatedAdditionProducts() as $relatedProduct) {
            $this->relatedAdditionProductsIds[] = $relatedProduct->getId();
        }

        foreach($entity->getImages() as $image) {
            $this->imagesToDelete[$image->getId()] = $image;
            $form = new AdditionProductImageForm();
            $form->setEntity($image);
            $this->imageForms[] = $form;
        }

        foreach($entity->getTabs() as $tab) {
            $this->tabsToDelete[$tab->getId()] = $tab;
            $form = new AdditionProductTabForm();
            $form->setEntity($tab);
            $this->tabForms[] = $form;
        }

        foreach($entity->getOptions() as $option) {
            $this->optionsToDelete[$option->getId()] = $option;
            $form = new AdditionProductOptionForm();
            $form->setEntity($option);
            $this->optionForms[] = $form;
        }

        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionProduct $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        $data = [
            'previewUrl' => $entity->getPreviewPath(),
            'circuitUrl' => $entity->getCircuitPath(),
            'draftUrl' => $entity->getDraftPath(),
            'certificateUrl' => $entity->getCertificatePath(),
            'relatedProducts' => [

            ],
            'images' => [

            ],
            'tabs' => [

            ],
            'options' => [

            ]
        ];
        foreach($entity->getRelatedProducts() as $product) {
            $data['relatedProducts'][] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'type' => 0
            ];
        }
        foreach($entity->getRelatedAdditionProducts() as $product) {
            $data['relatedProducts'][] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'type' => 1
            ];
        }
        foreach($this->imageForms as $form) {
            $data['images'][] = $form->getData();
        }
        foreach($this->tabForms as $form) {
            $data['tabs'][] = $form->getData();
        }

        foreach($this->optionForms as $form) {
            $data['options'][] = $form->getData();
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function load($data, $formName = '') {
        if(!parent::load($data, $formName)) {
            return false;
        }

        if(!empty($data['certificateUrl']) && !empty($data['certificateName'])) {
            $this->certificate = HandyFile::createFromDataUrl($data['certificateUrl'], $data['certificateName']);
        }
        if(!empty($data['draftUrl']) && !empty($data['draftName'])) {
            $this->draft = HandyFile::createFromDataUrl($data['draftUrl'], $data['draftName']);
        }
        if(!empty($data['circuitUrl']) && !empty($data['circuitName'])) {
            $this->circuit = HandyFile::createFromDataUrl($data['circuitUrl'], $data['circuitName']);
        }

        if(!isset($data['images']) || !is_array($data['images'])) {
            return false;
        }
        foreach($data['images'] as $imageData) {
            $imageForm = null;
            if(!empty($imageData['id'])) {
                foreach($this->imageForms as $form) {
                    if($form->id == $imageData['id']) {
                        $imageForm = $form;
                        unset($this->imagesToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($imageForm)) {
                $imageForm = new AdditionProductImageForm();
                $this->imageForms[] = $imageForm;
            }
            $imageForm->load($imageData, '');
        }

        if(!isset($data['tabs']) || !is_array($data['tabs'])) {
            return false;
        }
        foreach($data['tabs'] as $tabData) {
            $tabForm = null;
            if(!empty($tabData['id'])) {
                foreach($this->tabForms as $form) {
                    if($form->id == $tabData['id']) {
                        $tabForm = $form;
                        unset($this->tabsToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($tabForm)) {
                $tabForm = new AdditionProductTabForm();
                $this->tabForms[] = $tabForm;
            }
            $tabForm->load($tabData, '');
        }



        if(!isset($data['options']) || !is_array($data['options'])) {
            return false;
        }
        foreach($data['options'] as $optionData) {

            $optionForm = null;
            if(!empty($optionData['id'])) {
                foreach($this->optionForms as $form) {
                    if($form->id == $optionData['id']) {
                        $optionForm = $form;
                        unset($this->optionsToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($optionForm)) {
                $optionForm = new AdditionProductOptionForm();
                $this->optionForms[] = $optionForm;
            }
            $optionForm->load($optionData, '');
        }

        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionProduct $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setSku($this->sku);
        $entity->setIsOnOffer($this->isOnOffer);
        $entity->setKupelType($this->kupelType);
        $entity->setPrice($this->price);
        $entity->setFigure($this->figure);
        $entity->setSort($this->sort);

        if(!empty($this->categoryId)) {
            /** @var AdditionCategory|null $category */
            $category = AdditionCategoriesRepository::getInstance()->find($this->categoryId);
            $entity->setCategory($category);
        }

        $rep = $this->getEntityManager()->getRepository('Models:Product');
        $relatedProducts = [];
        foreach($this->relatedProductsIds as $id) {
            /** @var Product|null $product */
            $product = $rep->find($id);
            if(empty($product)) {
                continue;
            }
            $relatedProducts[$product->getId()] = $product;
        }
        $entity->setRelatedProducts($relatedProducts);

        $rep = $this->getEntityManager()->getRepository('Models:AdditionProduct');
        $relatedAdditionProducts = [];
        foreach($this->relatedAdditionProductsIds as $id) {
            /** @var AdditionProduct|null $product */
            $product = $rep->find($id);
            if(empty($product)) {
                continue;
            }
            $relatedAdditionProducts[$product->getId()] = $product;
        }
        $entity->setRelatedAdditionProducts($relatedAdditionProducts);

        $imageResult = $this->saveImage('preview', '/images/catalog/addition-products', $entity->getPreviewPath(), function($path) use($entity) {
            $entity->setPreviewPath($path);
        }, null, null, $entity::PREVIEW_MAX__WIDTH, $entity::PREVIEW_MAX_HEIGHT);
        if(!$imageResult) {
            $this->addError('preview', 'Не удалось загрузить изображение');
            return false;
        }

        $filesDir= '/files/addition-products' . intval($this->categoryId);
        if(!empty($this->circuit)) {
            $path = $this->circuit->saveToDir($filesDir);
            if(empty($path)) {
                $this->addError('circuit', 'Не удалось сохранить файл');
                return false;
            }
            HandyFile::deleteFile($entity->getCircuitPath());
            $entity->setCircuitPath($path);
        }
        if($this->circuitIsDeleted) {
            HandyFile::deleteFile($entity->getCircuitPath());
            $entity->setCircuitPath('');
        }

        if(!empty($this->draft)) {
            $path = $this->draft->saveToDir($filesDir);
            if(empty($path)) {
                $this->addError('draft', 'Не удалось сохранить файл');
                return false;
            }
            HandyFile::deleteFile($entity->getDraftPath());
            $entity->setDraftPath($path);
        }
        if($this->draftIsDeleted) {
            HandyFile::deleteFile($entity->getDraftPath());
            $entity->setDraftPath('');
        }

        if(!empty($this->certificate)) {
            $path = $this->certificate->saveToDir($filesDir);
            if(empty($path)) {
                $this->addError('certificate', 'Не удалось сохранить файл');
                return false;
            }
            HandyFile::deleteFile($entity->getCertificatePath());
            $entity->setCertificatePath($path);
        }
        if($this->certificateIsDeleted) {
            HandyFile::deleteFile($entity->getCertificatePath());
            $entity->setCertificatePath('');
        }

        foreach($this->imageForms as $imageForm) {
            $image = null;
            if(!empty($imageForm->id)) {
                foreach($entity->getImages() as $objImage) {
                    if($objImage->getId() == $imageForm->id) {
                        $image = $objImage;
                        break;
                    }
                }
            }
            if(empty($image)) {
                $image = new AdditionProductImage();
                $image->setProduct($entity);
            }
            $this->getEntityManager()->persist($image);
            $imageForm->fillEntity($image);
        }

        foreach($this->imagesToDelete as $image) {
            $this->getEntityManager()->remove($image);
        }

        foreach($this->tabForms as $tabForm) {
            $tab = null;
            if(!empty($tabForm->id)) {
                foreach($entity->getTabs() as $objTab) {
                    if($objTab->getId() == $tabForm->id) {
                        $tab = $objTab;
                        break;
                    }
                }
            }
            if(empty($tab)) {
                $tab = new AdditionProductTab();
                $tab->setProduct($entity);
            }
            $this->getEntityManager()->persist($tab);
            $tabForm->fillEntity($tab);
        }

        foreach($this->tabsToDelete as $tab) {
            $this->getEntityManager()->remove($tab);
        }


        foreach($this->optionForms as $optionForm) {
            $option = null;
            if(!empty($optionForm->id)) {
                foreach($entity->getOptions() as $objOption) {
                    if($objOption->getId() == $optionForm->id) {
                        $option = $objOption;
                        break;
                    }
                }
            }
            if(empty($option)) {
                $option = new AdditionProductOption();
                $option->setProduct($entity);
            }
            $this->getEntityManager()->persist($option);
            $optionForm->fillEntity($option);
        }

        foreach($this->optionsToDelete as $option) {
            $this->getEntityManager()->remove($option);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return AdditionProduct
     */
    protected function createNewEntity() {
        return new AdditionProduct();
    }

    /**
     * @inheritdoc
     * @return AdditionProductI18nForm
     */
    protected function createNewI18nForm() {
        return new AdditionProductI18nForm();
    }

}