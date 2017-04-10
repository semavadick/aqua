"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../common/i18n-form");
var PublicationI18nForm = (function (_super) {
    __extends(PublicationI18nForm, _super);
    function PublicationI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
        this.shortDescription = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    }
    PublicationI18nForm.prototype.reset = function () {
        this.name = '';
        this.shortDescription = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    };
    PublicationI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    PublicationI18nForm.prototype.getData = function () {
        return {
            name: this.name,
            shortDescription: this.shortDescription,
            description: this.description,
            slug: this.description,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    };
    return PublicationI18nForm;
}(i18n_form_1.I18nForm));
exports.PublicationI18nForm = PublicationI18nForm;
//# sourceMappingURL=publication-i18n-form.js.map