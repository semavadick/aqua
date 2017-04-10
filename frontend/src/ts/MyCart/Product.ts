
namespace MyCart {

    /**
     * Класс для товаром в корзине
     */
    export class Product {

        // Id
        private id: number;

        /**
         * @returns {number} Id
         */
        public getId(): number {
            return this.id;
        }

        // Sku
        private sku: string;

        /**
         * @returns {string} Sku
         */
        public getSku(): string {
            return this.sku;
        }

        // Название
        private name: string;

        /**
         * @returns {string} Название
         */
        public getName(): string {
            return this.name;
        }

        // Тип
        private type: number;

        /**
         * @returns {number} Кол-во
         */
        public getType(): number {
            return this.type;
        }

        /**
         * @param type Тип
         */
        public setType(type:number) {
            this.type = type;
        }



        // Тип
        private options;

        /**
         * @param options
         */
        public setOptions(options) {
            this.options = options;
        }

        /**
         * @returns options Опции
         */
        public getOptions() {
            return this.options;
        }



        // Цена
        private price: number;

        //Скидка
        private discount: number;

        public getDiscount(): number {
            return this.discount;
        }

        public setDiscount(discount) {
            this.discount = discount;
        }

        /**
         * @returns {number} Цена
         */
        public getPrice(): number {
            var price = this.price,
                options = this.getOptions();
            if(options != undefined) {
                for(var optIndex in options) {
                    if(options[optIndex].main == undefined || options[optIndex].main != 1 || options[optIndex].type == 1) {
                        price += parseInt(options[optIndex].value);
                    }
                }
            }
            if(this.discount > 0) {
                price = price - ((price/100) * this.discount);
            }
            return price;
        }

        /**
         * @returns {number} Суммарная цена
         */
        public getSummary(): number {
            return this.getPrice() * this.quantity;
        }

        // Кол-во
        private quantity: number;

        /**
         * @returns {number} Кол-во
         */
        public getQuantity(): number {
            return this.quantity;
        }

        /**
         * Устанавливает кол-во товара
         * @param quantity Кол-во
         */
        public setQuantity(quantity: number) {
            this.quantity = quantity;
            this.triggerQuantityUpdatedEvent();
        }



        /**
         * Увеличивает кол-во товара в корзине
         * @returns {number} Кол-во
         */
        public incrementQuantity(quantity: number) {
            this.quantity += quantity;
            this.triggerQuantityUpdatedEvent();
        }

        /**
         * Уменьшает кол-во товара в корзине
         * @returns {number} Кол-во
         */
        public decrementQuantity(quantity: number) {
            this.quantity -= quantity;
            if(this.quantity <= 0) {
                this.quantity = 1;
            }
            this.triggerQuantityUpdatedEvent();
        }

        // Обработчики события обновления кол-ва товара
        private quantityUpdatedListeners = [];

        /**
         * Добавляет обработчик события обновления кол-ва товара
         * @param listener
         */
        public addQuantityUpdatedListener(listener) {
            this.quantityUpdatedListeners.push(listener);
        }

        /**
         * Вызывает событие обновления кол-ва товара
         */
        private triggerQuantityUpdatedEvent() {
            for(var listener of this.quantityUpdatedListeners) {
                listener();
            }
        }

        /**
         * Конструктор
         */
        public constructor(id, name, price, quantity, sku, type, options, discount) {
            this.id = id;
            this.sku = sku;
            this.name = name;
            this.price = price;
            this.quantity = quantity;
            this.type = type;
            this.options = options;
            this.discount = discount;
        }

        /**
         * Создает товар из объекта
         * @param object Объект
         * @returns {Product|null}
         */
        public static createFromObject(object: any): Product {
            var props = ['id', 'name', 'price', 'quantity', 'sku'],
                type = (object.type != undefined) ? object.type : undefined,
                options = (object.options != undefined) ? object.options : undefined,
                discount = (object.discount != undefined) ? object.discount : undefined;
            for(var prop of props) {
                if(!object.hasOwnProperty(prop)) {
                    return null;
                }
            }
            return new Product(object.id, object.name, object.price, object.quantity, object.sku, type, options, discount);
        }
    }
}