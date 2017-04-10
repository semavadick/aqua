"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var FaqItemI18nForm = (function (_super) {
    __extends(FaqItemI18nForm, _super);
    function FaqItemI18nForm() {
        _super.apply(this, arguments);
        this.question = '';
        this.answer = '';
    }
    FaqItemI18nForm.prototype.reset = function () {
        this.question = '';
        this.answer = '';
    };
    FaqItemI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    FaqItemI18nForm.prototype.getData = function () {
        return {
            question: this.question,
            answer: this.answer,
        };
    };
    return FaqItemI18nForm;
}(i18n_form_1.I18nForm));
exports.FaqItemI18nForm = FaqItemI18nForm;
//# sourceMappingURL=faq-item-i18n-form.js.map