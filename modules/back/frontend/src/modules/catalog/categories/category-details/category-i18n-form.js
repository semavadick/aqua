"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../../common/i18n-form");
var CategoryI18nForm = (function (_super) {
    __extends(CategoryI18nForm, _super);
    function CategoryI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
        this.saveI18n = true;
    }
    CategoryI18nForm.prototype.reset = function () {
        this.name = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    };
    CategoryI18nForm.prototype.populate = function (data) {
        this.name = data['name'];
        this.description = data['description'];
        this.slug = data['slug'];
        this.pageTitle = data['pageTitle'];
        this.pageMetaKeywords = data['pageMetaKeywords'];
        this.pageMetaDescription = data['pageMetaDescription'];
    };
    CategoryI18nForm.prototype.getData = function () {
        return {
            name: this.name,
            description: this.description,
            slug: this.slug,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    };
    return CategoryI18nForm;
}(i18n_form_1.I18nForm));
exports.CategoryI18nForm = CategoryI18nForm;
//# sourceMappingURL=category-i18n-form.js.map