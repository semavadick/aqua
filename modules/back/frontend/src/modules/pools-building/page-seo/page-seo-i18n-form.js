"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var PageSeoI18nForm = (function (_super) {
    __extends(PageSeoI18nForm, _super);
    function PageSeoI18nForm() {
        _super.apply(this, arguments);
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
        this.saveI18n = true;
    }
    PageSeoI18nForm.prototype.reset = function () {
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
    };
    PageSeoI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    PageSeoI18nForm.prototype.getData = function () {
        return {
            title: this.title,
            metaKeywords: this.metaKeywords,
            metaDescription: this.metaDescription,
        };
    };
    return PageSeoI18nForm;
}(i18n_form_1.I18nForm));
exports.PageSeoI18nForm = PageSeoI18nForm;
//# sourceMappingURL=page-seo-i18n-form.js.map