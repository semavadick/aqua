var MyCart;
(function (MyCart) {
    /**
     * Класс для товаром в корзине
     */
    var Product = (function () {
        /**
         * Конструктор
         */
        function Product(id, name, price, quantity, sku, type, options, discount) {
            // Обработчики события обновления кол-ва товара
            this.quantityUpdatedListeners = [];
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
         * @returns {number} Id
         */
        Product.prototype.getId = function () {
            return this.id;
        };
        /**
         * @returns {string} Sku
         */
        Product.prototype.getSku = function () {
            return this.sku;
        };
        /**
         * @returns {string} Название
         */
        Product.prototype.getName = function () {
            return this.name;
        };
        /**
         * @returns {number} Кол-во
         */
        Product.prototype.getType = function () {
            return this.type;
        };
        /**
         * @param type Тип
         */
        Product.prototype.setType = function (type) {
            this.type = type;
        };
        /**
         * @param options
         */
        Product.prototype.setOptions = function (options) {
            this.options = options;
        };
        /**
         * @returns options Опции
         */
        Product.prototype.getOptions = function () {
            return this.options;
        };
        Product.prototype.getDiscount = function () {
            return this.discount;
        };
        Product.prototype.setDiscount = function (discount) {
            this.discount = discount;
        };
        /**
         * @returns {number} Цена
         */
        Product.prototype.getPrice = function () {
            var price = this.price, options = this.getOptions();
            if (options != undefined) {
                for (var optIndex in options) {
                    if (options[optIndex].main == undefined || options[optIndex].main != 1 || options[optIndex].type == 1) {
                        price += parseInt(options[optIndex].value);
                    }
                }
            }
            if (this.discount > 0) {
                price = price - ((price / 100) * this.discount);
            }
            return price;
        };
        /**
         * @returns {number} Суммарная цена
         */
        Product.prototype.getSummary = function () {
            return this.getPrice() * this.quantity;
        };
        /**
         * @returns {number} Кол-во
         */
        Product.prototype.getQuantity = function () {
            return this.quantity;
        };
        /**
         * Устанавливает кол-во товара
         * @param quantity Кол-во
         */
        Product.prototype.setQuantity = function (quantity) {
            this.quantity = quantity;
            this.triggerQuantityUpdatedEvent();
        };
        /**
         * Увеличивает кол-во товара в корзине
         * @returns {number} Кол-во
         */
        Product.prototype.incrementQuantity = function (quantity) {
            this.quantity += quantity;
            this.triggerQuantityUpdatedEvent();
        };
        /**
         * Уменьшает кол-во товара в корзине
         * @returns {number} Кол-во
         */
        Product.prototype.decrementQuantity = function (quantity) {
            this.quantity -= quantity;
            if (this.quantity <= 0) {
                this.quantity = 1;
            }
            this.triggerQuantityUpdatedEvent();
        };
        /**
         * Добавляет обработчик события обновления кол-ва товара
         * @param listener
         */
        Product.prototype.addQuantityUpdatedListener = function (listener) {
            this.quantityUpdatedListeners.push(listener);
        };
        /**
         * Вызывает событие обновления кол-ва товара
         */
        Product.prototype.triggerQuantityUpdatedEvent = function () {
            for (var _i = 0, _a = this.quantityUpdatedListeners; _i < _a.length; _i++) {
                var listener = _a[_i];
                listener();
            }
        };
        /**
         * Создает товар из объекта
         * @param object Объект
         * @returns {Product|null}
         */
        Product.createFromObject = function (object) {
            var props = ['id', 'name', 'price', 'quantity', 'sku'], type = (object.type != undefined) ? object.type : undefined, options = (object.options != undefined) ? object.options : undefined, discount = (object.discount != undefined) ? object.discount : undefined;
            for (var _i = 0, props_1 = props; _i < props_1.length; _i++) {
                var prop = props_1[_i];
                if (!object.hasOwnProperty(prop)) {
                    return null;
                }
            }
            return new Product(object.id, object.name, object.price, object.quantity, object.sku, type, options, discount);
        };
        return Product;
    }());
    MyCart.Product = Product;
})(MyCart || (MyCart = {}));
/// <reference path="Product" />
/// <reference path="../typedefs/jquery.d.ts" />
var MyCart;
(function (MyCart) {
    /**
     * Вид для корзины
     */
    var CartModel = (function () {
        /**
         * Конструктор
         */
        function CartModel() {
            var _this = this;
            // Товары
            this.products = [];
            // Обработчики события обновления списка товаров в корзине
            this.productsListUpdatedListeners = [];
            var $dataCont = $('#cart-data');
            this.syncUrl = $dataCont.data('sync-url');
            this.currency = $dataCont.data('currency');
            var productsData = $dataCont.data('products');
            for (var _i = 0, productsData_1 = productsData; _i < productsData_1.length; _i++) {
                var productData = productsData_1[_i];
                var product = MyCart.Product.createFromObject(productData);
                if (!product) {
                    continue;
                }
                product.addQuantityUpdatedListener(function () {
                    _this.sync();
                });
                this.products.push(product);
            }
        }
        /**
         * Синхронизирует корзину с backend
         */
        CartModel.prototype.sync = function () {
            var prodsData = [];
            for (var _i = 0, _a = this.products; _i < _a.length; _i++) {
                var product = _a[_i];
                var prData = {
                    id: product.getId(),
                    quantity: product.getQuantity(),
                    type: product.getType()
                };
                if (product.getOptions() != undefined) {
                    prData['options'] = product.getOptions();
                }
                prodsData.push(prData);
            }
            $.ajax({
                url: this.syncUrl,
                type: 'POST',
                data: {
                    products: prodsData
                }
            });
        };
        /**
         * @returns {Product[]} Товары
         */
        CartModel.prototype.getProducts = function () {
            return this.products;
        };
        /**
         * Возвращает товар по Id
         * @param id Id
         * @param type Type
         * @returns {Product|null} Товар (null, если нет такого товара в корзине)
         */
        CartModel.prototype.getProductById = function (id, type) {
            for (var _i = 0, _a = this.products; _i < _a.length; _i++) {
                var product = _a[_i];
                if (product.getId() == id) {
                    if (type != undefined && type != product.getType()) {
                        continue;
                    }
                    return product;
                }
            }
            return null;
        };
        /**
         * Добавляет товар в корзину
         * @param product Товар
         */
        CartModel.prototype.addProduct = function (product) {
            var _this = this;
            var productType = (product.getType()) ? product.getType() : undefined;
            var cartProduct = this.getProductById(product.getId(), productType);
            if (cartProduct) {
                cartProduct.incrementQuantity(product.getQuantity());
                this.triggerProductsListUpdatedEvent();
                return;
            }
            this.products.push(product);
            product.addQuantityUpdatedListener(function () {
                _this.sync();
            });
            this.triggerProductsListUpdatedEvent();
            this.sync();
        };
        /**
         * Удаляет товар из корзины
         * @param product Товар
         */
        CartModel.prototype.deleteProduct = function (product) {
            var i = -1;
            var productType = (product.getType()) ? product.getType() : undefined;
            for (var _i = 0, _a = this.products; _i < _a.length; _i++) {
                var cartProduct = _a[_i];
                i++;
                if (cartProduct.getId() != product.getId()) {
                    continue;
                }
                if (productType != undefined && cartProduct.getType() != productType) {
                    continue;
                }
                this.products.splice(i, 1);
                this.triggerProductsListUpdatedEvent();
                break;
            }
            this.sync();
        };
        /**
         * Очищает корзину
         */
        CartModel.prototype.clear = function () {
            this.products = [];
            this.triggerProductsListUpdatedEvent();
        };
        /**
         * @returns {number} Суммарная стоимость товаров в корзине
         */
        CartModel.prototype.getSummary = function () {
            var price = 0;
            for (var _i = 0, _a = this.products; _i < _a.length; _i++) {
                var product = _a[_i];
                price += product.getSummary();
            }
            return price;
        };
        /**
         * Добавляет обработчик события обновления списка товаров в корзине
         * @param listener
         */
        CartModel.prototype.addProductsListUpdatedListener = function (listener) {
            this.productsListUpdatedListeners.push(listener);
        };
        /**
         * Вызывает событие обновления списка товаров в корзине
         */
        CartModel.prototype.triggerProductsListUpdatedEvent = function () {
            for (var _i = 0, _a = this.productsListUpdatedListeners; _i < _a.length; _i++) {
                var listener = _a[_i];
                listener();
            }
        };
        /**
         * Оформляет заказ
         * @param url Url оформления заказа
         * @param data Данные
         * @param onComplete Коллбек окончания оформления заказа
         */
        CartModel.prototype.createOrder = function (url, data, onComplete) {
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    onComplete();
                },
                error: function (jqXHR) {
                    onComplete(jqXHR.responseText);
                }
            });
            return false;
        };
        /**
         * @param id Id товара
         * @returns {boolean} Есть ли товар в корзине
         */
        CartModel.prototype.hasProduct = function (id, type) {
            return this.getProductById(id, type) != null;
        };
        CartModel.CURRENCY_RUB = 1;
        CartModel.CURRENCY_DOLLAR = 2;
        return CartModel;
    }());
    MyCart.CartModel = CartModel;
})(MyCart || (MyCart = {}));
/// <reference path="../typedefs/jquery.d.ts" />
var MyCart;
(function (MyCart) {
    /**
     * Вид для корзины
     */
    var CartView = (function () {
        /**
         * Конструктор
         * @param model Инстанс модели корзины
         */
        function CartView(model) {
            var _this = this;
            this.model = model;
            this.$modal = $('#popup-basket');
            this.$modal.find('.my-modal__bg, .my-modal__close').on('click', function () {
                _this.close();
                return false;
            });
            this.$modal.appendTo($('body'));
            this.$button = $('#cart-btn');
            this.$button.on('click', function () {
                _this.open();
                return false;
            });
            this.updateButton();
            this.$summaryContainer = $('#cart-summary');
            this.updateSummary();
            this.$table = $('#cart-table');
            this.rebuildProductsTable();
            model.addProductsListUpdatedListener(function () {
                _this.rebuildProductsTable();
                _this.updateSummary();
                _this.updateButton();
            });
            var $form = this.$modal.find('#order-form');
            $form.on('beforeSubmit', function () {
                var products = _this.model.getProducts();
                if (!products.length) {
                    return false;
                }
                var form = $form[0];
                var formData = new FormData(form);
                _this.model.createOrder($form.attr('action'), formData, function (errorMessage) {
                    if (errorMessage && errorMessage.length) {
                        alert(errorMessage);
                        return;
                    }
                    _this.$modal.addClass('success');
                    _this.model.clear();
                    setTimeout(function () {
                        _this.close();
                    }, 4000);
                });
                return false;
            });
        }
        /**
         * Перестраивает таблицу товаров
         */
        CartView.prototype.rebuildProductsTable = function () {
            var _this = this;
            var $tbody = this.$table.find('tbody');
            $tbody.find('tr').remove();
            var products = this.model.getProducts();
            for (var _i = 0, products_1 = products; _i < products_1.length; _i++) {
                var product = products_1[_i];
                var $tr = $('<tr>').addClass('cart-prod');
                var name = '<span class="product-name">' + product.getName() + '</span>';
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
                (function ($deleteBtn, product) {
                    $deleteBtn.on('click', function () {
                        _this.model.deleteProduct(product);
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
            if (products.length) {
                this.$modal.removeClass('empty');
            }
            else {
                this.$modal.addClass('empty');
            }
        };
        CartView.prototype.productOptions = function (product) {
            var optionsType = [];
            if (product.options != undefined) {
                for (var optIndex in product.options) {
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
            for (var optType in optionsType) {
                var $option = $('<div class="option-container"></div>');
                $option.append('<div class="option-header">' + typeHeaders[optType] + '</div>');
                for (var optIndex in optionsType[optType]) {
                    $option.append($('<span class="option-name">' + optionsType[optType][optIndex].name + '</span>'));
                    if (optionsType[optType][optIndex].main != 1) {
                        $option.append($('<span class="option-value">+ ' + this.formatPrice(parseInt(optionsType[optType][optIndex].value)) + '</span>'));
                    }
                }
                $options.prepend($option);
            }
            return $options;
        };
        CartView.prototype.createTd = function (index) {
            var $td = $('<td>');
            var $title = $('<span>').addClass('title');
            $title.text($(this.$table.find('th')[index]).text());
            $td.append($title);
            return $td;
        };
        /**
         * @param product Товар
         * @param $summaryCell Ячейка с суммой товара
         * @returns {JQuery} Ячейка с кол-вом товара
         */
        CartView.prototype.createProductQuantityCell = function (product, $summaryCell) {
            var _this = this;
            var $quantity = this.createTd(3).addClass('cart-prod__quantity');
            var $counter = $('<div>').addClass('amount');
            var $counterInput = $('<input type="text">').addClass('counter__input');
            $counterInput.val(product.getQuantity());
            $counterInput.on('change', function () {
                var val = parseInt($counterInput.val());
                if (!val || val <= 0) {
                    val = 1;
                }
                product.setQuantity(val);
            });
            var $counterBtnsPlus = $('<a>').addClass('plus');
            $counterBtnsPlus.on('click', function () {
                product.incrementQuantity(1);
                return false;
            });
            var $counterBtnsMinus = $('<a>').addClass('minus');
            $counterBtnsMinus.on('click', function () {
                product.decrementQuantity(1);
                return false;
            });
            product.addQuantityUpdatedListener(function () {
                $counterInput.val(product.getQuantity());
                var summary = _this.formatPrice(product.getSummary());
                var $title = $summaryCell.find('.title');
                $summaryCell.html('');
                $summaryCell.append($title);
                $summaryCell.append(summary);
                _this.updateSummary();
            });
            $quantity.append($counter);
            $counter.append($counterInput);
            $counter.append($counterBtnsPlus).append($counterBtnsMinus);
            return $quantity;
        };
        /**
         * Обновляет сумму заказа
         */
        CartView.prototype.updateSummary = function () {
            var summary = this.formatPrice(this.model.getSummary());
            this.$summaryContainer.html(summary);
        };
        /**
         * Обновляет кнопку корзины в шапке
         */
        CartView.prototype.updateButton = function () {
            var prodsCount = this.model.getProducts().length;
            this.$button.find('.num').text(prodsCount);
        };
        /**
         * Открывает корзину
         */
        CartView.prototype.open = function () {
            this.$modal.addClass('my-modal--opened');
        };
        /**
         * Закрывает корзину
         */
        CartView.prototype.close = function () {
            this.$modal.removeClass('my-modal--opened');
        };
        /**
         * Форматирует цену
         * @param price цена
         * @returns {string} Отформатированная цена
         */
        CartView.prototype.formatPrice = function (price) {
            var result = '';
            if (this.model.currency == MyCart.CartModel.CURRENCY_RUB) {
                result = this.numberFormat(Math.round(price), 0, '.', ' ') + " <sub class=\"rub\">руб.</sub>";
            }
            else {
                result = "<sub>$</sub>" + this.numberFormat(Math.round(price), 0, '.', ',');
            }
            return result;
        };
        // http://javascript.ru/php/number_format
        CartView.prototype.numberFormat = function (number, decimals, dec_point, thousands_sep) {
            var i, j, kw, kd, km;
            // input sanitation & defaults
            if (isNaN(decimals = Math.abs(decimals))) {
                decimals = 2;
            }
            if (dec_point == undefined) {
                dec_point = ",";
            }
            if (thousands_sep == undefined) {
                thousands_sep = ".";
            }
            i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
            if ((j = i.length) > 3) {
                j = j % 3;
            }
            else {
                j = 0;
            }
            km = (j ? i.substr(0, j) + thousands_sep : "");
            kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
            //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
            kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, '0').slice(2) : "");
            return km + kw + kd;
        };
        return CartView;
    }());
    MyCart.CartView = CartView;
})(MyCart || (MyCart = {}));
/// <reference path="CartModel" />
/// <reference path="Product" />
/// <reference path="CartView" />
var MyCart;
(function (MyCart) {
    /**
     * Класс для работы с корзиной
     */
    var Cart = (function () {
        /**
         * Конструктор
         */
        function Cart() {
            var model = new MyCart.CartModel();
            this.model = model;
            this.view = new MyCart.CartView(model);
        }
        /**
         * @returns {MyCart} Интсанс корзины
         */
        Cart.getInstance = function () {
            if (!this.instance) {
                this.instance = new Cart();
            }
            return this.instance;
        };
        /**
         * Добавляет товар в корзину
         * @param id Id
         * @param name Название
         * @param price Цена
         * @param quantity Кол-во
         * @param sku Sku
         */
        Cart.prototype.addProduct = function (id, name, price, quantity, sku, type, options, discount) {
            this.model.addProduct(new MyCart.Product(id, name, price, quantity, sku, type, options, discount));
        };
        /**
         * @param id Id товара
         * @returns {boolean} Есть ли товар в корзине
         */
        Cart.prototype.hasProduct = function (id, type) {
            return this.model.hasProduct(id, type);
        };
        /**
         * Добавляет обработчик события обновления списка товаров в корзине
         * @param listener
         */
        Cart.prototype.addProductsListUpdatedListener = function (listener) {
            this.model.addProductsListUpdatedListener(listener);
        };
        /**
         * Открывает корзину
         */
        Cart.prototype.open = function () {
            this.view.open();
        };
        // Инстанс
        Cart.instance = null;
        return Cart;
    }());
    MyCart.Cart = Cart;
})(MyCart || (MyCart = {}));
