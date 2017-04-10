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
var search_form_component_1 = require("./search-form/search-form.component");
var my_datatable_component_1 = require("../../../common/my-datatable/my-datatable.component");
var search_form_1 = require("./search-form/search-form");
var products_manager_1 = require("./products-manager");
var product_form_1 = require("./product-form/product-form");
var product_form_component_1 = require("./product-form/product-form.component");
var my_datatable_column_1 = require("../../../common/my-datatable/my-datatable-column");
var ProductsComponent = (function () {
    function ProductsComponent(manager, productForm, searchForm) {
        this.manager = manager;
        this.productForm = productForm;
        this.searchForm = searchForm;
        this.columns = [];
        this.category = null;
        var idColumn = new my_datatable_column_1.MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'SKU';
        nameColumn.attribute = 'sku';
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Название';
        nameColumn.attribute = 'name';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Цена';
        nameColumn.attribute = 'price';
        this.columns.push(nameColumn);
    }
    ProductsComponent.prototype.setCategory = function (category) {
        this.category = category;
        this.searchForm.setCategory(category);
        this.productForm.setCategory(category);
        this.manager.loadEntities();
    };
    ProductsComponent.prototype.formInitialized = function () {
        this.productDetails.initI18ns();
    };
    __decorate([
        core_1.ViewChild(product_form_component_1.ProductFormComponent, undefined), 
        __metadata('design:type', product_form_component_1.ProductFormComponent)
    ], ProductsComponent.prototype, "productDetails", void 0);
    ProductsComponent = __decorate([
        core_1.Component({
            selector: 'catalog-products',
            templateUrl: './products.html',
            directives: [
                my_datatable_component_1.MyDatatableComponent,
                search_form_component_1.SearchFormComponent,
                product_form_component_1.ProductFormComponent,
            ],
            providers: [
                product_form_1.ProductForm, search_form_1.SearchForm, products_manager_1.ProductsManager,
            ]
        }), 
        __metadata('design:paramtypes', [products_manager_1.ProductsManager, product_form_1.ProductForm, search_form_1.SearchForm])
    ], ProductsComponent);
    return ProductsComponent;
}());
exports.ProductsComponent = ProductsComponent;
//# sourceMappingURL=products.component.js.map