"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var AdvantagesBlockI18nForm = (function (_super) {
    __extends(AdvantagesBlockI18nForm, _super);
    function AdvantagesBlockI18nForm() {
        _super.apply(this, arguments);
        this.menuName = '';
        this.title = '';
        this.saveI18n = true;
    }
    AdvantagesBlockI18nForm.prototype.reset = function () {
        this.menuName = '';
        this.title = '';
    };
    AdvantagesBlockI18nForm.prototype.populate = function (data) {
        this.menuName = data['menuName'];
        this.title = data['title'];
    };
    AdvantagesBlockI18nForm.prototype.getData = function () {
        return {
            menuName: this.menuName,
            title: this.title,
        };
    };
    return AdvantagesBlockI18nForm;
}(i18n_form_1.I18nForm));
exports.AdvantagesBlockI18nForm = AdvantagesBlockI18nForm;
//# sourceMappingURL=advantages-block-i18n-form.js.map