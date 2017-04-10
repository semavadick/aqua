<?php

namespace back\Catalog\forms;

use app\models\Category;
use app\models\Entity;
use app\models\Product;
use app\models\ProductAttribute;
use app\models\ProductImage;
use app\repositories\CategoriesRepository;
use back\forms\EntityForm;
use back\helpers\HandyFile;
use back\validators\FormFileValidator;
use back\validators\FormImageValidator;

class ProductForm extends EntityForm {

    public $categoryId = null;
    public $price = 0;
    public $sku = '';
    public $sort = 0;
    public $isOnOffer = true;
    public $filtersIds = [];
    public $relatedProductsIds = [];
    public $attachmentsIds = [];
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
    
    /** @var Product|null */
    private $product = null;

    /** @var ProductImageForm[] */
    private $imageForms = [];

    /** @var ProductImage[] */
    private $imagesToDelete = [];

    /** @var ProductAttributeForm[] */
    private $attributeForms = [];

    /** @var ProductAttribute[] */
    private $attributesToDelete = [];

    public function rules() {
        $rules = [
            [['sku', 'price'], 'required', 'message' => 'Заполните поле'],
            ['price', 'number', 'min' => 0],
            ['sort', 'number'],
            [['figure', 'categoryId', 'filtersIds', 'relatedProductsIds', 'attachmentsIds'], 'safe'],
            ['isOnOffer', 'boolean'],
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
     * @param Product $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->product = $entity;
        $this->isOnOffer = $entity->getIsOnOffer();
        $category = $entity->getCategory();
        $this->categoryId = !empty($category) ? $category->getId() : null;
        $this->sku = $entity->getSku();
        $this->price = $entity->getPrice();
        $this->sort = $entity->getSort();
        $this->figure = $entity->getFigure();

        foreach($entity->getFilters() as $filter) {
            $this->filtersIds[] = $filter->getId();
        }
        foreach($entity->getAttachments() as $attachment) {
            $this->attachmentsIds[] = $attachment->getId();
        }
        foreach($entity->getRelatedProducts() as $relatedProduct) {
            $this->relatedProductsIds[] = $relatedProduct->getId();
        }

        foreach($entity->getImages() as $image) {
            $this->imagesToDelete[$image->getId()] = $image;
            $form = new ProductImageForm();
            $form->setEntity($image);
            $this->imageForms[] = $form;
        }

        foreach($entity->getAttributes() as $attribute) {
            $this->attributesToDelete[$attribute->getId()] = $attribute;
            $form = new ProductAttributeForm();
            $form->setEntity($attribute);
            $this->attributeForms[] = $form;
        }
        
        return true;
    }

    /**
     * @inheritdoc
     * @param Product $entity
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
            'attributes' => [

            ],
        ];
        foreach($entity->getRelatedProducts() as $product) {
            $data['relatedProducts'][] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
            ];
        }
        foreach($this->imageForms as $form) {
            $data['images'][] = $form->getData();
        }
        foreach($this->attributeForms as $form) {
            $data['attributes'][] = $form->getData();
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
                $imageForm = new ProductImageForm();
                $this->imageForms[] = $imageForm;
            }
            $imageForm->load($imageData, '');
        }
        
        if(!isset($data['attributes']) || !is_array($data['attributes'])) {
            return false;
        }
        foreach($data['attributes'] as $attributeData) {
            $attributeForm = null;
            if(!empty($attributeData['id'])) {
                foreach($this->attributeForms as $form) {
                    if($form->id == $attributeData['id']) {
                        $attributeForm = $form;
                        unset($this->attributesToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($attributeForm)) {
                $attributeForm = new ProductAttributeForm();
                $this->attributeForms[] = $attributeForm;
            }
            $attributeForm->load($attributeData, '');
        }
        
        return true;
    }

    /**
     * @inheritdoc
     * @param Product $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setSku($this->sku);
        $entity->setIsOnOffer($this->isOnOffer);
        $entity->setPrice($this->price);
        $entity->setSort($this->sort);
        $entity->setFigure($this->figure);

        if(!empty($this->categoryId)) {
            /** @var Category|null $category */
            $category = CategoriesRepository::getInstance()->find($this->categoryId);
            $entity->setCategory($category);
        }

        $rep = $this->getEntityManager()->getRepository('Models:CategoryFilter');
        $filters = [];
        foreach($this->filtersIds as $id) {
            $filter = $rep->find($id);
            if(empty($filter)) {
                continue;
            }
            $filters[] = $filter;
        }
        $entity->setFilters($filters);

        $rep = $this->getEntityManager()->getRepository('Models:Attachment');
        $attachments = [];
        foreach($this->attachmentsIds as $id) {
            $attachment = $rep->find($id);
            if(empty($attachment)) {
                continue;
            }
            $attachments[] = $attachment;
        }
        $entity->setAttachments($attachments);

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
        
        $imageResult = $this->saveImage('preview', '/images/catalog/products', $entity->getPreviewPath(), function($path) use($entity) {
            $entity->setPreviewPath($path);
        }, null, null, $entity::PREVIEW_MAX__WIDTH, $entity::PREVIEW_MAX_HEIGHT);
        if(!$imageResult) {
            $this->addError('preview', 'Не удалось загрузить изображение');
            return false;
        }

        $filesDir= '/files/product' . intval($this->categoryId);
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
                $image = new ProductImage();
                $image->setProduct($entity);
            }
            $this->getEntityManager()->persist($image);
            $imageForm->fillEntity($image);
        }

        foreach($this->imagesToDelete as $image) {
            $this->getEntityManager()->remove($image);
        }

        foreach($this->attributeForms as $attributeForm) {
            $attribute = null;
            if(!empty($attributeForm->id)) {
                foreach($entity->getAttributes() as $objAttribute) {
                    if($objAttribute->getId() == $attributeForm->id) {
                        $attribute = $objAttribute;
                        break;
                    }
                }
            }
            if(empty($attribute)) {
                $attribute = new ProductAttribute();
                $attribute->setProduct($entity);
            }
            $this->getEntityManager()->persist($attribute);
            $attributeForm->fillEntity($attribute);
        }

        foreach($this->attributesToDelete as $attribute) {
            $this->getEntityManager()->remove($attribute);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return Product
     */
    protected function createNewEntity() {
        return new Product();
    }

    /**
     * @inheritdoc
     * @return ProductI18nForm
     */
    protected function createNewI18nForm() {
        return new ProductI18nForm();
    }

}