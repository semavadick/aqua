"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require("@angular/core");
var backend_service_ts_1 = require("../../../services/backend.service.ts");
var languages_manager_1 = require("../../../services/languages-manager");
var my_datatable_entity_form_1 = require("../../../common/my-datatable/my-datatable-entity-form");
var order_product_1 = require("../order-product");
var OrderForm = (function (_super) {
    __extends(OrderForm, _super);
    function OrderForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.status = OrderForm.STATUS_PRE_PROCESSING;
        this.orderProducts = [];
    }
    OrderForm.prototype.getStatuses = function () {
        return OrderForm.statuses;
    };
    OrderForm.prototype.getBackend = function () {
        return this.backend;
    };
    OrderForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    OrderForm.prototype.getBackendUrl = function () {
        return 'orders';
    };
    OrderForm.prototype.reset = function () {
        this.status = OrderForm.STATUS_PRE_PROCESSING;
        this.discount = null;
        this.orderProducts = [];
    };
    OrderForm.prototype.populate = function (data) {
        Object.assign(this, data);
        this.orderProducts = [];
        for (var _i = 0, _a = data['orderProducts']; _i < _a.length; _i++) {
            var prodData = _a[_i];
            var orderProduct = new order_product_1.OrderProduct();
            Object.assign(orderProduct, prodData);
            this.orderProducts.push(orderProduct);
        }
    };
    OrderForm.prototype.getData = function () {
        return {
            status: this.status,
            discount: this.discount,
            orderProducts: this.orderProducts,
        };
    };
    OrderForm.prototype.getI18ns = function () {
        return [];
    };
    OrderForm.prototype.getI18nFormClass = function () {
        return null;
    };
    OrderForm.prototype.getTotalCost = function () {
        var cost = 0;
        for (var _i = 0, _a = this.orderProducts; _i < _a.length; _i++) {
            var product = _a[_i];
            cost += product.getTotalCost();
        }
        if (this.discount) {
            var discount = this.discount.toString();
            cost *= Math.round(100 - parseInt(discount));
            cost /= 100;
        }
        return cost;
    };
    OrderForm.STATUS_PRE_PROCESSING = 0;
    OrderForm.STATUS_PROCESSING = 1;
    OrderForm.STATUS_DELIVERED = 2;
    OrderForm.STATUS_CANCELED = 3;
    OrderForm.statuses = [
        {
            id: OrderForm.STATUS_PRE_PROCESSING,
            label: 'Оформляется',
        },
        {
            id: OrderForm.STATUS_PROCESSING,
            label: 'В работе',
        },
        {
            id: OrderForm.STATUS_DELIVERED,
            label: 'Доставлен',
        },
        {
            id: OrderForm.STATUS_CANCELED,
            label: 'Отменен',
        },
    ];
    OrderForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof backend_service_ts_1.BackendService !== 'undefined' && backend_service_ts_1.BackendService) === 'function' && _a) || Object, languages_manager_1.LanguagesManager])
    ], OrderForm);
    return OrderForm;
    var _a;
}(my_datatable_entity_form_1.MyDatatableEntityForm));
exports.OrderForm = OrderForm;
//# sourceMappingURL=order-form.js.map