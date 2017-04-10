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
var categories_component_1 = require("../categories/categories.component");
var products_component_1 = require("../products/products.component");
var StoreComponent = (function () {
    function StoreComponent() {
    }
    StoreComponent.prototype.selectCategory = function (category) {
        this.products.setCategory(category);
    };
    __decorate([
        core_1.ViewChild(products_component_1.ProductsComponent, undefined), 
        __metadata('design:type', products_component_1.ProductsComponent)
    ], StoreComponent.prototype, "products", void 0);
    StoreComponent = __decorate([
        core_1.Component({
            templateUrl: './store.html',
            directives: [
                categories_component_1.CategoriesComponent,
                products_component_1.ProductsComponent,
            ]
        }), 
        __metadata('design:paramtypes', [])
    ], StoreComponent);
    return StoreComponent;
}());
exports.StoreComponent = StoreComponent;
//# sourceMappingURL=store.component.js.map