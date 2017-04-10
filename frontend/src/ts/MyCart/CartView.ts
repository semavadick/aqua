/// <reference path="../typedefs/jquery.d.ts" />

namespace MyCart {

    /**
     * Вид для корзины
     */
    export class CartView {

        // Инстанс модели корзины
        private model: CartModel;

        // Кнопка корзины в шапке
        private $button: JQuery;

        // Модальное окно
        private $modal: JQuery;

        // Таблица
        private $table: JQuery;

        // Котейнер для суммы заказа
        private $summaryContainer: JQuery;

        /**
         * Конструктор
         * @param model Инстанс модели корзины
         */
        public constructor(model: CartModel) {
            this.model = model;
            this.$modal = $('#popup-basket');
            this.$modal.find('.my-modal__bg, .my-modal__close').on('click', () => {
                this.close();
                return false;
            });
            this.$modal.appendTo($('body'));

            this.$button = $('#cart-btn');
            this.$button.on('click', () => {
                this.open();
                return false;
            });
            this.updateButton();

            this.$summaryContainer = $('#cart-summary');
            this.updateSummary();

            this.$table = $('#cart-table');
            this.rebuildProductsTable();
            model.addProductsListUpdatedListener(() => {
                this.rebuildProductsTable();
                this.updateSummary();
                this.updateButton();
            });

            var $form = this.$modal.find('#order-form');
            $form.on('beforeSubmit', () => {
                var products = this.model.getProducts();
                if(!products.length) {
                    return false;
                }
                var form: HTMLFormElement = <HTMLFormElement>$form[0];
                var formData = new FormData(form);
                this.model.createOrder($form.attr('action'), formData, (errorMessage) => {
                    if(errorMessage && errorMessage.length) {
                        alert(errorMessage);
                        return;
                    }
                    this.$modal.addClass('success');
                    this.model.clear();
                    setTimeout(() => {
                        this.close();
                    }, 4000);
                });
                return false;
            });
        }

        /**
         * Перестраивает таблицу товаров
         */
        private rebuildProductsTable() {
            var $tbody = this.$table.find('tbody');
            $tbody.find('tr').remove();
            var products = this.model.getProducts();

            for(var product of products) {
                var $tr = $('<tr>').addClass('cart-prod');
                var name = '<span class="product-name">'+product.getName()+'</span>';
                var $name = this.createTd(0).addClass('cart-prod__name').html(name);
                $name.append(this.productOptions(product));
                var $sku = this.createTd(1).addClass('cart-prod__sku').append(product.getSku());
                var price = this.formatPrice(product.getPrice());
                var $price = this.createTd(2).addClass('cart-prod__price price').append(price);
                var summary = this.formatPrice(product.getSummary());
                var $summary = this.createTd(4).addClass('cart-prod__summary price').append(summary);
                var $quantity = this.createProductQuantityCell(product, $summary);
                var $delete = $('<td>').addClass('cart-prod__delete');
                var $deleteBtn = $('<a href="#" class="close"></a>');
                (($deleteBtn: JQuery, product: Product) => {
                    $deleteBtn.on('click', () => {
                        this.model.deleteProduct(product);
                        return false;
                    });
                })($deleteBtn, product);
                $delete.append($deleteBtn);
                $tr.append($name)
                    .append($sku)
                    .append($price)
                    .append($quantity)
                    .append($summary)
                    .append($delete);
                $tbody.append($tr);
            }

            if(products.length) {
                this.$modal.removeClass('empty');
            } else {
                this.$modal.addClass('empty');
            }
        }

        private productOptions(product):JQuery {
            var optionsType = [];
            if(product.options != undefined) {
                for(var optIndex in product.options) {
                    var type = {};
                    type[product.options[optIndex].id] = product.options[optIndex];
                    optionsType[product.options[optIndex].type] = type;
                }
            }
            var typeHeaders = {
                4: 'Диаметр',
                3: 'Ширина',
                5: 'Длина',
                2: 'Глубина',
                1: 'Доп. оборудование'
            };
            var $options = $('<div class="cart-prod__options"></div>');
            for(var optType in optionsType) {
                var $option = $('<div class="option-container"></div>');
                $option.append('<div class="option-header">'+typeHeaders[optType]+'</div>');
                for(var optIndex in optionsType[optType]) {
                    $option.append($('<span class="option-name">'+optionsType[optType][optIndex].name+'</span>'));
                    if(optionsType[optType][optIndex].main != 1) {
                        $option.append($('<span class="option-value">+ '+this.formatPrice(parseInt(optionsType[optType][optIndex].value))+'</span>'));
                    }
                }
                $options.prepend($option);
            }
            return $options;
        }

        private createTd(index: number): JQuery {
            var $td = $('<td>');
            var $title = $('<span>').addClass('title');
            $title.text($(this.$table.find('th')[index]).text());
            $td.append($title);
            return $td;
        }

        /**
         * @param product Товар
         * @param $summaryCell Ячейка с суммой товара
         * @returns {JQuery} Ячейка с кол-вом товара
         */
        private createProductQuantityCell(product: Product, $summaryCell: JQuery):JQuery {
            var $quantity = this.createTd(3).addClass('cart-prod__quantity');
            var $counter = $('<div>').addClass('amount');
            var $counterInput = $('<input type="text">').addClass('counter__input');
            $counterInput.val(product.getQuantity());
            $counterInput.on('change', () => {
                var val = parseInt($counterInput.val());
                if(!val || val <= 0) {
                    val = 1;
                }
                product.setQuantity(val);
            });
            var $counterBtnsPlus = $('<a>').addClass('plus');
            $counterBtnsPlus.on('click', () => {
                product.incrementQuantity(1);
                return false;
            });
            var $counterBtnsMinus = $('<a>').addClass('minus');
            $counterBtnsMinus.on('click', () => {
                product.decrementQuantity(1);
                return false;
            });
            product.addQuantityUpdatedListener(() => {
                $counterInput.val(product.getQuantity());
                var summary = this.formatPrice(product.getSummary());
                var $title = $summaryCell.find('.title');
                $summaryCell.html('');
                $summaryCell.append($title);
                $summaryCell.append(summary);
                this.updateSummary();
            });
            $quantity.append($counter);
            $counter.append($counterInput);
            $counter.append($counterBtnsPlus).append($counterBtnsMinus);
            return $quantity;
        }

        /**
         * Обновляет сумму заказа
         */
        private updateSummary() {
            var summary = this.formatPrice(this.model.getSummary());
            this.$summaryContainer.html(summary);
        }

        /**
         * Обновляет кнопку корзины в шапке
         */
        private updateButton() {
            var prodsCount = this.model.getProducts().length;
            this.$button.find('.num').text(prodsCount);
        }

        /**
         * Открывает корзину
         */
        public open() {
            this.$modal.addClass('my-modal--opened');
        }

        /**
         * Закрывает корзину
         */
        public close() {
            this.$modal.removeClass('my-modal--opened');
        }

        /**
         * Форматирует цену
         * @param price цена
         * @returns {string} Отформатированная цена
         */
        public formatPrice(price: number): string {
            var result = '';
            if(this.model.currency == CartModel.CURRENCY_RUB) {
                result = this.numberFormat(Math.round(price), 0, '.', ' ') + " <sub class=\"rub\">руб.</sub>";
            } else {
                result =  "<sub>$</sub>" + this.numberFormat(Math.round(price), 0, '.', ',');
            }
            return result;
        }

        // http://javascript.ru/php/number_format
        public numberFormat( number, decimals, dec_point, thousands_sep ) {

            var i, j, kw, kd, km;

            // input sanitation & defaults
            if( isNaN(decimals = Math.abs(decimals)) ){
                decimals = 2;
            }
            if( dec_point == undefined ){
                dec_point = ",";
            }
            if( thousands_sep == undefined ){
                thousands_sep = ".";
            }

            i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

            if( (j = i.length) > 3 ){
                j = j % 3;
            } else{
                j = 0;
            }

            km = (j ? i.substr(0, j) + thousands_sep : "");
            kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
            //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
            kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, '0').slice(2) : "");


            return km + kw + kd;
        }

    }

}