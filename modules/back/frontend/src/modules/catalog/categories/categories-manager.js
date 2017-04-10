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
var category_1 = require("./category");
var backend_service_1 = require("../../../services/backend.service");
var CategoriesManager = (function () {
    function CategoriesManager(backend) {
        this.backend = backend;
        this.isLoading = false;
        this.categories = [];
        this.backendUrl = 'catalog/categories';
    }
    CategoriesManager.prototype.loadCategories = function () {
        var _this = this;
        this.isLoading = true;
        return new Promise(function (resolve, reject) {
            _this.backend.get(_this.backendUrl)
                .then(function (resp) {
                _this.isLoading = false;
                _this.categories = [];
                for (var _i = 0, _a = resp.json(); _i < _a.length; _i++) {
                    var categoryData = _a[_i];
                    _this.categories.push(_this.getCategoryFromData(categoryData));
                }
                resolve('ok');
            })
                .catch(function (resp) {
                reject(resp.text());
            });
        });
    };
    CategoriesManager.prototype.getCategoryFromData = function (data) {
        var category = new category_1.Category();
        category.id = data['id'];
        category.name = data['name'];
        for (var _i = 0, _a = data['children']; _i < _a.length; _i++) {
            var childData = _a[_i];
            category.children.push(this.getCategoryFromData(childData));
        }
        return category;
    };
    CategoriesManager.prototype.deleteCategory = function (category) {
        var _this = this;
        this.isLoading = true;
        var url = this.backendUrl + '/' + category.id;
        return new Promise(function (resolve, reject) {
            _this.backend.delete(url)
                .then(function (resp) {
                _this.isLoading = false;
                resolve('ok');
            })
                .catch(function (resp) {
                reject(resp.text());
            });
        });
    };
    CategoriesManager.prototype.sortCategories = function (categories, parent) {
        var _this = this;
        this.isLoading = true;
        var url = this.backendUrl + '/sort';
        var categoriesIds = [];
        for (var _i = 0, categories_1 = categories; _i < categories_1.length; _i++) {
            var category = categories_1[_i];
            categoriesIds.push(category.id);
        }
        var options = {
            parentId: parent ? parent.id : null,
            categoriesIds: categoriesIds
        };
        this.backend.put(url, options)
            .then(function (resp) {
            _this.isLoading = false;
        })
            .catch(function (resp) {
            _this.isLoading = false;
            alert(resp.text());
        });
    };
    CategoriesManager = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService])
    ], CategoriesManager);
    return CategoriesManager;
}());
exports.CategoriesManager = CategoriesManager;
//# sourceMappingURL=categories-manager.js.map