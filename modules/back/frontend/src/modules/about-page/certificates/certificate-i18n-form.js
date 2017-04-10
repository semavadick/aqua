"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var CertificateI18nForm = (function (_super) {
    __extends(CertificateI18nForm, _super);
    function CertificateI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
    }
    CertificateI18nForm.prototype.reset = function () {
        this.name = '';
    };
    CertificateI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    CertificateI18nForm.prototype.getData = function () {
        return {
            name: this.name,
        };
    };
    return CertificateI18nForm;
}(i18n_form_1.I18nForm));
exports.CertificateI18nForm = CertificateI18nForm;
//# sourceMappingURL=certificate-i18n-form.js.map