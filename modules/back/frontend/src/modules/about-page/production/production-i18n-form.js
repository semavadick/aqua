"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var ProductionI18nForm = (function (_super) {
    __extends(ProductionI18nForm, _super);
    function ProductionI18nForm() {
        _super.apply(this, arguments);
        this.title = '';
        this.text = '';
        this.saveI18n = true;
    }
    ProductionI18nForm.prototype.reset = function () {
        this.title = '';
        this.text = '';
    };
    ProductionI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    ProductionI18nForm.prototype.getData = function () {
        return {
            title: this.title,
            text: this.text,
        };
    };
    return ProductionI18nForm;
}(i18n_form_1.I18nForm));
exports.ProductionI18nForm = ProductionI18nForm;
//# sourceMappingURL=production-i18n-form.js.map