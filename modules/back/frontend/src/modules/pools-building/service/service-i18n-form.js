"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var file_uploader_model_1 = require("../../../common/file-uploader/file-uploader-model");
var ServiceI18nForm = (function (_super) {
    __extends(ServiceI18nForm, _super);
    function ServiceI18nForm() {
        _super.apply(this, arguments);
        this.title = '';
        this.text = '';
        this.presentation = new file_uploader_model_1.FileUploaderModel();
        this.saveI18n = true;
    }
    ServiceI18nForm.prototype.reset = function () {
        this.title = '';
        this.text = '';
        this.presentation.reset();
    };
    ServiceI18nForm.prototype.populate = function (data) {
        this.title = data['title'];
        this.text = data['text'];
        this.presentation.currentFileUrl = data['presentationUrl'];
    };
    ServiceI18nForm.prototype.getData = function () {
        return {
            title: this.title,
            text: this.text,
            presentationUrl: this.presentation.uploadedFileUrl,
            presentationName: this.presentation.uploadedFileName,
        };
    };
    return ServiceI18nForm;
}(i18n_form_1.I18nForm));
exports.ServiceI18nForm = ServiceI18nForm;
//# sourceMappingURL=service-i18n-form.js.map