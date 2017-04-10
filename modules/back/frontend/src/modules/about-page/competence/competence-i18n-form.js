"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var CompetenceI18nForm = (function (_super) {
    __extends(CompetenceI18nForm, _super);
    function CompetenceI18nForm() {
        _super.apply(this, arguments);
        this.title = '';
        this.text = '';
        this.saveI18n = true;
    }
    CompetenceI18nForm.prototype.reset = function () {
        this.title = '';
        this.text = '';
    };
    CompetenceI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    CompetenceI18nForm.prototype.getData = function () {
        return {
            title: this.title,
            text: this.text,
        };
    };
    return CompetenceI18nForm;
}(i18n_form_1.I18nForm));
exports.CompetenceI18nForm = CompetenceI18nForm;
//# sourceMappingURL=competence-i18n-form.js.map