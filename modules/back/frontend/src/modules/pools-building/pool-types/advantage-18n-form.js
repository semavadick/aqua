"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var AdvantageI18nForm = (function (_super) {
    __extends(AdvantageI18nForm, _super);
    function AdvantageI18nForm() {
        _super.apply(this, arguments);
        this.text = '';
        this.saveI18n = true;
    }
    AdvantageI18nForm.prototype.reset = function () {
        this.text = '';
    };
    AdvantageI18nForm.prototype.populate = function (data) {
        this.text = data['text'];
    };
    AdvantageI18nForm.prototype.getData = function () {
        return {
            text: this.text,
        };
    };
    return AdvantageI18nForm;
}(i18n_form_1.I18nForm));
exports.AdvantageI18nForm = AdvantageI18nForm;
//# sourceMappingURL=advantage-18n-form.js.map