<?php

namespace sync\models;

class Parser {

    /** @var \SimpleXMLElement */
    private $import;

    /** @var \SimpleXMLElement */
    private $offers;

    public function __construct(\SimpleXMLElement $import, \SimpleXMLElement $offers) {
        $this->import = $import;
        $this->offers = $offers;
    }

    /** @return Category[] */
    public function getParsedCategories() {
        return $this->regGetParsedCategories($this->import->Классификатор->Группы->Группа[0]);
    }

    /**
     * @param $xml
     * @param Category|null $parent
     * @return Category[]
     */
    private function regGetParsedCategories($xml, Category $parent = null) {
        $categories = [];
        if(count(iterator_to_array($xml->Группы)) == 0) {
            return $categories;
        }
        foreach($xml->Группы->Группа as $xmlCategory) {
            $id = trim(strval($xmlCategory->Ид));
            $name = trim(strval($xmlCategory->Наименование));
            $category = new Category($id, $parent, $name);
            $categories[] = $category;
            $categories = array_merge($categories, $this->regGetParsedCategories($xmlCategory, $category));
        }
        return $categories;
    }

    /** @return Product[] */
    public function getParsedProducts() {
        if(count(iterator_to_array($this->import->Каталог->Товары)) == 0) {
            return [];
        }
        $categories = [];
        foreach($this->getParsedCategories() as $category) {
            $categories[$category->id] = $category;
        }
        $products = [];
        $priceId = 'c287b2f2-8adc-11e6-a6ca-d05099355cd4';
        $c = 0;
        foreach($this->import->Каталог->Товары->Товар as $xmlProduct) {
            $id = trim(strval($xmlProduct->Ид));
            $name = trim(strval($xmlProduct->Наименование));
            $sku = trim(strval($xmlProduct->Артикул));
            $categoryId = trim(strval($xmlProduct->Группы->Ид));
            $category = isset($categories[$categoryId]) ? $categories[$categoryId] : null;
            // Price
            $price = 0;
            foreach($this->offers->ПакетПредложений->Предложения->Предложение as $xmlOffer) {
                $offerProductId = trim(strval($xmlOffer->Ид));
                $pos = strpos($offerProductId, '#');
                if ($pos){
                  $offerProductId = substr($offerProductId, 0, $pos);
                }
                if($offerProductId != $id) {
                    continue;
                }
                if(count(iterator_to_array($xmlOffer->Цены)) == 0) {
                    continue;
                }
                foreach($xmlOffer->Цены->Цена as $offerPriceXml) {
                    $offerPriceId = trim(strval($offerPriceXml->ИдТипаЦены));
                    if($offerPriceId != $priceId) {
                        continue;
                    }
                    $price = floatval(trim(strval($offerPriceXml->ЦенаЗаЕдиницу)));
                    $c++;
                    break 2;
                }
            }

            $products[] = new Product($id, $category, $name, $sku, $price);
        }
        echo 'Product count: '.count($products).'. Price found: '.$c.'. ';
        return $products;
    }

}