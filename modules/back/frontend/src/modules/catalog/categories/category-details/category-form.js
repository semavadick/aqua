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
var core_1 = require('@angular/core');
var backend_service_1 = require("../../../../services/backend.service");
var languages_manager_1 = require("../../../../services/languages-manager");
var my_cropper_image_1 = require("../../../../common/my-cropper/my-cropper-image");
var category_i18n_form_1 = require("./category-i18n-form");
var entity_form_1 = require("../../../../common/entity-form");
var filter_form_1 = require("./filter-form");
var category_1 = require("../category");
var CategoryForm = (function (_super) {
    __extends(CategoryForm, _super);
    function CategoryForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.image = new my_cropper_image_1.MyCropperImage();
        this.bg = new my_cropper_image_1.MyCropperImage();
        this.relatedCategoriesIds = [];
        this.hasDiscount = false;
        this.parent = null;
        this.filters = [];
        this.backendUrl = 'catalog/categories';
        this.category = null;
    }
    CategoryForm.prototype.init = function (category, parent) {
        if (category === void 0) { category = null; }
        if (parent === void 0) { parent = null; }
        this.category = category;
        this.parent = parent;
        if (!category) {
            return this.initLocally();
        }
        return this.initFromUrl(this.backendUrl + '/' + category.id);
    };
    CategoryForm.prototype.save = function () {
        var url = this.backendUrl;
        var isNewEntity = true;
        if (this.category) {
            url += '/' + this.category.id;
            isNewEntity = false;
        }
        return this.saveViaUrl(url, isNewEntity);
    };
    CategoryForm.prototype.reset = function () {
        this.image.reset();
        this.bg.reset();
        this.filters = [];
        this.relatedCategoriesIds = [];
        this.hasDiscount = false;
    };
    CategoryForm.prototype.populate = function (data) {
        this.image.currentImageUrl = data['imageUrl'];
        this.bg.currentImageUrl = data['bgUrl'];
        this.relatedCategoriesIds = data['relatedCategoriesIds'];
        this.hasDiscount = data['hasDiscount'];
        for (var _i = 0, _a = data['filters']; _i < _a.length; _i++) {
            var filterData = _a[_i];
            var filter = new filter_form_1.FilterForm(this.getLanguagesManager());
            filter.populate(filterData);
            this.filters.push(filter);
        }
    };
    CategoryForm.prototype.getData = function () {
        var filtersData = [];
        for (var _i = 0, _a = this.filters; _i < _a.length; _i++) {
            var filter = _a[_i];
            filtersData.push(filter.getData());
        }
        return {
            bg: this.bg.croppedImage,
            image: this.image.croppedImage,
            filters: filtersData,
            parentId: this.parent ? this.parent.id : null,
            relatedCategoriesIds: this.relatedCategoriesIds,
            hasDiscount: this.hasDiscount,
        };
    };
    CategoryForm.prototype.getBackend = function () {
        return this.backend;
    };
    CategoryForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    CategoryForm.prototype.getI18nFormClass = function () {
        return category_i18n_form_1.CategoryI18nForm;
    };
    CategoryForm.prototype.getRelatedCategories = function () {
        var categories = [];
        for (var _i = 0, _a = this.relatedCategoriesIds; _i < _a.length; _i++) {
            var id = _a[_i];
            var category = new category_1.Category();
            category.id = id;
            categories.push(category);
        }
        return categories;
    };
    CategoryForm.prototype.setRelatedCategories = function (categories) {
        this.relatedCategoriesIds = [];
        for (var _i = 0, categories_1 = categories; _i < categories_1.length; _i++) {
            var category = categories_1[_i];
            this.relatedCategoriesIds.push(category.id);
        }
    };
    CategoryForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], CategoryForm);
    return CategoryForm;
}(entity_form_1.EntityForm));
exports.CategoryForm = CategoryForm;
//# sourceMappingURL=category-form.js.map