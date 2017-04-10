"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var order_form_1 = require("./order-form");
var form_group_component_1 = require("../../../common/form-group/form-group.component");
var OrderFormComponent = (function () {
    function OrderFormComponent() {
    }
    OrderFormComponent.prototype.deleteProduct = function (orderProduct) {
        if (confirm('Удалить товар?')) {
            var index = this.form.orderProducts.indexOf(orderProduct);
            this.form.orderProducts.splice(index, 1);
        }
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', order_form_1.OrderForm)
    ], OrderFormComponent.prototype, "form", void 0);
    OrderFormComponent = __decorate([
        core_1.Component({
            selector: 'order-form',
            templateUrl: './order-form.html',
            directives: [
                form_group_component_1.FormGroupComponent,
            ],
        }), 
        __metadata('design:paramtypes', [])
    ], OrderFormComponent);
    return OrderFormComponent;
}());
exports.OrderFormComponent = OrderFormComponent;
//# sourceMappingURL=order-form.component.js.map