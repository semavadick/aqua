"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var file_uploader_model_1 = require("../../../common/file-uploader/file-uploader-model");
var PageContentI18nForm = (function (_super) {
    __extends(PageContentI18nForm, _super);
    function PageContentI18nForm() {
        _super.apply(this, arguments);
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
        this.catalogImage = new my_cropper_image_1.MyCropperImage();
        this.catalogFile = new file_uploader_model_1.FileUploaderModel();
        this.saveI18n = false;
    }
    PageContentI18nForm.prototype.reset = function () {
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
        this.catalogImage.reset();
        this.catalogFile.reset();
    };
    PageContentI18nForm.prototype.populate = function (data) {
        this.title = data['title'];
        this.metaKeywords = data['metaKeywords'];
        this.metaDescription = data['metaDescription'];
        this.catalogImage.currentImageUrl = data['catalogImageUrl'];
        this.catalogFile.currentFileUrl = data['catalogFileUrl'];
    };
    PageContentI18nForm.prototype.getData = function () {
        return {
            title: this.title,
            metaKeywords: this.metaKeywords,
            metaDescription: this.metaDescription,
            catalogImage: this.catalogImage.croppedImage,
            catalogFileUrl: this.catalogFile.uploadedFileUrl,
            catalogFileName: this.catalogFile.uploadedFileName,
        };
    };
    return PageContentI18nForm;
}(i18n_form_1.I18nForm));
exports.PageContentI18nForm = PageContentI18nForm;
//# sourceMappingURL=page-content-i18n-form.js.map