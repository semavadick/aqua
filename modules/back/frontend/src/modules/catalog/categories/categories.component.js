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
var panel_spinner_component_1 = require("../../../common/panel-spinner/panel-spinner.component");
var categories_manager_1 = require("./categories-manager");
var categories_tree_component_1 = require("./categories-tree/categories-tree.component");
var category_details_component_1 = require("./category-details/category-details.component");
var CategoriesComponent = (function () {
    function CategoriesComponent(manager) {
        this.manager = manager;
        this.onSelect = new core_1.EventEmitter();
        this.selectedCategory = null;
    }
    CategoriesComponent.prototype.ngOnInit = function () {
        this.updateCategories();
    };
    CategoriesComponent.prototype.updateCategories = function () {
        var _this = this;
        this.manager.loadCategories()
            .then(function () {
            var selected = [];
            if (_this.selectedCategory) {
                selected.push(_this.selectedCategory);
            }
            _this.tree.load(_this.manager.categories, selected);
        })
            .catch(function (message) {
            if (message) {
                alert(message);
            }
        });
    };
    CategoriesComponent.prototype.sortCategories = function ($event) {
        this.manager.sortCategories($event.categories, $event.parent);
    };
    CategoriesComponent.prototype.selectCategories = function (categories) {
        var category = categories.length ? categories[0] : null;
        this.selectedCategory = category;
        this.onSelect.emit(category);
    };
    CategoriesComponent.prototype.createCategory = function (parent) {
        if (parent === void 0) { parent = null; }
        this.categoryDetails.createCategory(parent, this.manager.categories);
    };
    CategoriesComponent.prototype.updateCategory = function (category) {
        this.categoryDetails.updateCategory(category, this.manager.categories);
    };
    CategoriesComponent.prototype.deleteCategory = function (category) {
        var _this = this;
        this.manager.deleteCategory(category)
            .then(function () {
            _this.updateCategories();
        })
            .catch(function (message) {
            if (message) {
                alert(message);
            }
        });
    };
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], CategoriesComponent.prototype, "onSelect", void 0);
    __decorate([
        core_1.ViewChild(categories_tree_component_1.CategoriesTreeComponent, undefined), 
        __metadata('design:type', categories_tree_component_1.CategoriesTreeComponent)
    ], CategoriesComponent.prototype, "tree", void 0);
    __decorate([
        core_1.ViewChild(category_details_component_1.CategoryDetailsComponent, undefined), 
        __metadata('design:type', category_details_component_1.CategoryDetailsComponent)
    ], CategoriesComponent.prototype, "categoryDetails", void 0);
    CategoriesComponent = __decorate([
        core_1.Component({
            selector: 'catalog-categories',
            templateUrl: './categories.html',
            directives: [
                panel_spinner_component_1.PanelSpinnerComponent,
                categories_tree_component_1.CategoriesTreeComponent,
                category_details_component_1.CategoryDetailsComponent,
            ],
            providers: [
                categories_manager_1.CategoriesManager,
            ]
        }), 
        __metadata('design:paramtypes', [categories_manager_1.CategoriesManager])
    ], CategoriesComponent);
    return CategoriesComponent;
    var _a;
}());
exports.CategoriesComponent = CategoriesComponent;
//# sourceMappingURL=categories.component.js.map