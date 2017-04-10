"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var AttachmentI18nForm = (function (_super) {
    __extends(AttachmentI18nForm, _super);
    function AttachmentI18nForm() {
        _super.apply(this, arguments);
        this.text = '';
    }
    AttachmentI18nForm.prototype.reset = function () {
        this.text = '';
    };
    AttachmentI18nForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    AttachmentI18nForm.prototype.getData = function () {
        return {
            text: this.text,
        };
    };
    return AttachmentI18nForm;
}(i18n_form_1.I18nForm));
exports.AttachmentI18nForm = AttachmentI18nForm;
//# sourceMappingURL=attachment-i18n-form.js.map