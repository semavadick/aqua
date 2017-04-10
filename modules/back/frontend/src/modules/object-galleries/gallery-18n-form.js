"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../common/i18n-form");
var GalleryI18nForm = (function (_super) {
    __extends(GalleryI18nForm, _super);
    function GalleryI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
        this.address = '';
        this.shortDescription = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    }
    GalleryI18nForm.prototype.reset = function () {
        this.name = '';
        this.address = '';
        this.shortDescription = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    };
    GalleryI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    GalleryI18nForm.prototype.getData = function () {
        return {
            name: this.name,
            address: this.name,
            shortDescription: this.shortDescription,
            description: this.description,
            slug: this.description,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    };
    return GalleryI18nForm;
}(i18n_form_1.I18nForm));
exports.GalleryI18nForm = GalleryI18nForm;
//# sourceMappingURL=gallery-18n-form.js.map