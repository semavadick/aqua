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
var user_form_1 = require("./user-form");
var form_group_component_1 = require("../../../common/form-group/form-group.component");
var categories_discount_component_1 = require("./categories-discount.component");
var UserFormComponent = (function () {
    function UserFormComponent() {
    }
    UserFormComponent.prototype.formInitialized = function () {
        this.discountComponent.load(this.form.discountCategories);
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', user_form_1.UserForm)
    ], UserFormComponent.prototype, "form", void 0);
    __decorate([
        core_1.ViewChild(categories_discount_component_1.CategoriesDiscountComponent, undefined), 
        __metadata('design:type', categories_discount_component_1.CategoriesDiscountComponent)
    ], UserFormComponent.prototype, "discountComponent", void 0);
    UserFormComponent = __decorate([
        core_1.Component({
            selector: 'user-form',
            templateUrl: './user-form.html',
            directives: [
                form_group_component_1.FormGroupComponent,
                categories_discount_component_1.CategoriesDiscountComponent,
            ],
        }), 
        __metadata('design:paramtypes', [])
    ], UserFormComponent);
    return UserFormComponent;
}());
exports.UserFormComponent = UserFormComponent;
//# sourceMappingURL=user-form.component.js.map