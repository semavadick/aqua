/// <reference path="CartModel" />
/// <reference path="Product" />
/// <reference path="CartView" />

namespace MyCart {

    /**
     * Класс для работы с корзиной
     */
    export class Cart {

        // Модель
        private model: CartModel;

        // Вид
        private view: CartView;

        /**
         * Конструктор
         */
        public constructor() {
            var model = new CartModel();
            this.model = model;
            this.view = new CartView(model);
        }

        // Инстанс
        private static instance:Cart = null;

        /**
         * @returns {MyCart} Интсанс корзины
         */
        public static getInstance():Cart {
            if (!this.instance) {
                this.instance = new Cart();
            }
            return this.instance;
        }

        /**
         * Добавляет товар в корзину
         * @param id Id
         * @param name Название
         * @param price Цена
         * @param quantity Кол-во
         * @param sku Sku
         */
        public addProduct(id:number, name:string, price:number, quantity:number, sku:string, type:number, options, discount:number) {
            this.model.addProduct(new Product(id, name, price, quantity, sku, type, options, discount));
        }

        /**
         * @param id Id товара
         * @returns {boolean} Есть ли товар в корзине
         */
        public hasProduct(id: number, type: number): boolean {
            return this.model.hasProduct(id, type);
        }

        /**
         * Добавляет обработчик события обновления списка товаров в корзине
         * @param listener
         */
        public addProductsListUpdatedListener(listener) {
            this.model.addProductsListUpdatedListener(listener);
        }

        /**
         * Открывает корзину
         */
        public open() {
            this.view.open();
        }

    }

}