"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../../common/i18n-form");
var FilterI18nForm = (function (_super) {
    __extends(FilterI18nForm, _super);
    function FilterI18nForm() {
        _super.apply(this, arguments);
        this.text = '';
        this.saveI18n = true;
    }
    FilterI18nForm.prototype.reset = function () {
        this.text = '';
    };
    FilterI18nForm.prototype.populate = function (data) {
        this.text = data['text'];
    };
    FilterI18nForm.prototype.getData = function () {
        return {
            text: this.text,
        };
    };
    return FilterI18nForm;
}(i18n_form_1.I18nForm));
exports.FilterI18nForm = FilterI18nForm;
//# sourceMappingURL=filter-18n-form.js.map