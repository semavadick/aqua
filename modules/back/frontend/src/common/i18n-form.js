"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var form_1 = require("./form");
/**
 * Базовый класс для форм
 */
var I18nForm = (function (_super) {
    __extends(I18nForm, _super);
    function I18nForm(language) {
        _super.call(this);
        this.language = language;
        this.saveI18n = false;
    }
    return I18nForm;
}(form_1.Form));
exports.I18nForm = I18nForm;
//# sourceMappingURL=i18n-form.js.map