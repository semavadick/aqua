"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var OfficeI18nForm = (function (_super) {
    __extends(OfficeI18nForm, _super);
    function OfficeI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
        this.address = '';
        this.phoneComment = '';
        this.email = '';
        this.comment = '';
    }
    OfficeI18nForm.prototype.reset = function () {
        this.name = '';
        this.address = '';
        this.phoneComment = '';
        this.email = '';
        this.comment = '';
    };
    OfficeI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    OfficeI18nForm.prototype.getData = function () {
        return {
            name: this.name,
            address: this.address,
            phoneComment: this.phoneComment,
            email: this.email,
            comment: this.comment,
        };
    };
    return OfficeI18nForm;
}(i18n_form_1.I18nForm));
exports.OfficeI18nForm = OfficeI18nForm;
//# sourceMappingURL=office-i18n-form.js.map