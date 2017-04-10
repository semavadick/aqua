/// <reference path="Product" />
/// <reference path="../typedefs/jquery.d.ts" />

namespace MyCart {

    /**
     * Вид для корзины
     */
    export class CartModel {

        // Url для синхронизации корзины
        private syncUrl: string;

        public static CURRENCY_RUB = 1;
        public static CURRENCY_DOLLAR = 2;

        public currency: number;

        /**
         * Конструктор
         */
        public constructor() {
            var $dataCont = $('#cart-data');
            this.syncUrl = $dataCont.data('sync-url');
            this.currency = $dataCont.data('currency');

            var productsData = $dataCont.data('products');
            for(var productData of productsData) {
                var product = Product.createFromObject(productData);
                if(!product) {
                    continue;
                }
                product.addQuantityUpdatedListener(() => {
                    this.sync();
                });
                this.products.push(product);
            }
        }

        /**
         * Синхронизирует корзину с backend
         */
        private sync() {
            var prodsData = [];
            for(var product of this.products) {
                var prData = {
                    id: product.getId(),
                    quantity: product.getQuantity(),
                    type: product.getType(),
                };
                if(product.getOptions() != undefined) {
                    prData['options'] = product.getOptions();
                }
                prodsData.push(prData);
            }
            $.ajax({
                url: this.syncUrl,
                type: 'POST',
                data: {
                    products: prodsData,
                },
            });
        }

        // Товары
        private products: Product[] = [];

        /**
         * @returns {Product[]} Товары
         */
        public getProducts(): Product[] {
            return this.products;
        }

        /**
         * Возвращает товар по Id
         * @param id Id
         * @param type Type
         * @returns {Product|null} Товар (null, если нет такого товара в корзине)
         */
        private getProductById(id, type): Product {
            for(var product of this.products) {
                if(product.getId() == id) {
                    if(type != undefined && type != product.getType()) {
                        continue;
                    }
                    return product;
                }
            }
            return null;
        }

        /**
         * Добавляет товар в корзину
         * @param product Товар
         */
        public addProduct(product: Product) {
            var productType = (product.getType()) ? product.getType() : undefined;
            var cartProduct = this.getProductById(product.getId(), productType);
            if(cartProduct) {
                cartProduct.incrementQuantity(product.getQuantity());
                this.triggerProductsListUpdatedEvent();
                return;
            }
            this.products.push(product);
            product.addQuantityUpdatedListener(() => {
                this.sync();
            });
            this.triggerProductsListUpdatedEvent();
            this.sync();
        }

        /**
         * Удаляет товар из корзины
         * @param product Товар
         */
        public deleteProduct(product: Product) {
            var i = -1;
            var productType = (product.getType()) ? product.getType() : undefined;
            for(var cartProduct of this.products) {
                i++;
                if(cartProduct.getId() != product.getId()) {
                    continue;
                }
                if(productType != undefined && cartProduct.getType() != productType) {
                    continue;
                }
                this.products.splice(i, 1);
                this.triggerProductsListUpdatedEvent();
                break;
            }
            this.sync();
        }

        /**
         * Очищает корзину
         */
        public clear() {
            this.products = [];
            this.triggerProductsListUpdatedEvent();
        }

        /**
         * @returns {number} Суммарная стоимость товаров в корзине
         */
        public getSummary(): number {
            var price: number = 0;
            for(var product of this.products) {
                price += product.getSummary();
            }
            return price;
        }

        // Обработчики события обновления списка товаров в корзине
        private productsListUpdatedListeners = [];

        /**
         * Добавляет обработчик события обновления списка товаров в корзине
         * @param listener
         */
        public addProductsListUpdatedListener(listener) {
            this.productsListUpdatedListeners.push(listener);
        }

        /**
         * Вызывает событие обновления списка товаров в корзине
         */
        private triggerProductsListUpdatedEvent() {
            for(var listener of this.productsListUpdatedListeners) {
                listener();
            }
        }

        /**
         * Оформляет заказ
         * @param url Url оформления заказа
         * @param data Данные
         * @param onComplete Коллбек окончания оформления заказа
         */
        public createOrder(url:string, data: FormData, onComplete) {
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    onComplete();
                },
                error: function(jqXHR) {
                    onComplete(jqXHR.responseText);
                }
            });
            return false;
        }

        /**
         * @param id Id товара
         * @returns {boolean} Есть ли товар в корзине
         */
        public hasProduct(id: number, type:number): boolean {
            return this.getProductById(id, type) != null;
        }

    }

}