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
var backend_service_1 = require("../../services/backend.service");
var languages_manager_1 = require("../../services/languages-manager");
var publication_form_1 = require("../publications/publication-form");
var category_1 = require("../catalog/categories/category");
var ArticleForm = (function (_super) {
    __extends(ArticleForm, _super);
    function ArticleForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.categoriesIds = [];
    }
    ArticleForm.prototype.getBackendUrl = function () {
        return 'articles';
    };
    ArticleForm.prototype.getBackend = function () {
        return this.backend;
    };
    ArticleForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    ArticleForm.prototype.reset = function () {
        _super.prototype.reset.call(this);
        this.categoriesIds = [];
    };
    ArticleForm.prototype.populate = function (data) {
        _super.prototype.populate.call(this, data);
        this.categoriesIds = data['categoriesIds'];
    };
    ArticleForm.prototype.getData = function () {
        return Object.assign(_super.prototype.getData.call(this), {
            categoriesIds: this.categoriesIds,
        });
    };
    ArticleForm.prototype.getCategories = function () {
        var categories = [];
        for (var _i = 0, _a = this.categoriesIds; _i < _a.length; _i++) {
            var id = _a[_i];
            var category = new category_1.Category();
            category.id = id;
            categories.push(category);
        }
        return categories;
    };
    ArticleForm.prototype.setCategories = function (categories) {
        this.categoriesIds = [];
        for (var _i = 0, categories_1 = categories; _i < categories_1.length; _i++) {
            var category = categories_1[_i];
            this.categoriesIds.push(category.id);
        }
    };
    ArticleForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], ArticleForm);
    return ArticleForm;
}(publication_form_1.PublicationForm));
exports.ArticleForm = ArticleForm;
//# sourceMappingURL=article-form.js.map