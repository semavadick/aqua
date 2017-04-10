"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../../common/i18n-form");
var AttributeI18nForm = (function (_super) {
    __extends(AttributeI18nForm, _super);
    function AttributeI18nForm() {
        _super.apply(this, arguments);
        this.saveI18n = true;
    }
    AttributeI18nForm.prototype.reset = function () {
        this.name = '';
        this.value = '';
    };
    AttributeI18nForm.prototype.populate = function (data) {
        this.name = data['name'];
        this.value = data['value'];
    };
    AttributeI18nForm.prototype.getData = function () {
        return {
            name: this.name,
            value: this.value,
        };
    };
    return AttributeI18nForm;
}(i18n_form_1.I18nForm));
exports.AttributeI18nForm = AttributeI18nForm;
//# sourceMappingURL=attribute-i18n-form.js.map