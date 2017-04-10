"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var ProductionImageDetailsI18nForm = (function (_super) {
    __extends(ProductionImageDetailsI18nForm, _super);
    function ProductionImageDetailsI18nForm() {
        _super.apply(this, arguments);
        this.text = '';
    }
    ProductionImageDetailsI18nForm.prototype.reset = function () {
        this.text = '';
    };
    ProductionImageDetailsI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    ProductionImageDetailsI18nForm.prototype.getData = function () {
        return {
            text: this.text,
        };
    };
    return ProductionImageDetailsI18nForm;
}(i18n_form_1.I18nForm));
exports.ProductionImageDetailsI18nForm = ProductionImageDetailsI18nForm;
//# sourceMappingURL=production-image-details-i18n-form.js.map