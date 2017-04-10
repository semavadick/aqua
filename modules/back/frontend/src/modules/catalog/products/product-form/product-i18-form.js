"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../../common/i18n-form");
var ProductI18Form = (function (_super) {
    __extends(ProductI18Form, _super);
    function ProductI18Form() {
        _super.apply(this, arguments);
        this.name = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    }
    ProductI18Form.prototype.reset = function () {
        this.name = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    };
    ProductI18Form.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    ProductI18Form.prototype.getData = function () {
        return {
            name: this.name,
            description: this.description,
            slug: this.description,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    };
    return ProductI18Form;
}(i18n_form_1.I18nForm));
exports.ProductI18Form = ProductI18Form;
//# sourceMappingURL=product-i18-form.js.map