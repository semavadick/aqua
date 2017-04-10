"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var file_uploader_model_1 = require("../../../common/file-uploader/file-uploader-model");
var TypeI18nForm = (function (_super) {
    __extends(TypeI18nForm, _super);
    function TypeI18nForm() {
        _super.apply(this, arguments);
        this.name = '';
        this.description = '';
        this.stages = new file_uploader_model_1.FileUploaderModel();
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    }
    TypeI18nForm.prototype.reset = function () {
        this.name = '';
        this.description = '';
        this.stages.reset();
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    };
    TypeI18nForm.prototype.populate = function (data) {
        this.name = data['name'];
        this.description = data['description'];
        this.slug = data['slug'];
        this.pageTitle = data['pageTitle'];
        this.pageMetaKeywords = data['pageMetaKeywords'];
        this.pageMetaDescription = data['pageMetaDescription'];
        this.stages.currentFileUrl = data['stagesUrl'];
    };
    TypeI18nForm.prototype.getData = function () {
        return {
            name: this.name,
            description: this.description,
            stagesUrl: this.stages.uploadedFileUrl,
            stagesName: this.stages.uploadedFileName,
            slug: this.slug,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    };
    return TypeI18nForm;
}(i18n_form_1.I18nForm));
exports.TypeI18nForm = TypeI18nForm;
//# sourceMappingURL=type-i18n-form.js.map