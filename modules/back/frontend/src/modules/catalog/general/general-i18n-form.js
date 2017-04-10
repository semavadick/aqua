"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var i18n_form_1 = require("../../../common/i18n-form");
var file_uploader_model_1 = require("../../../common/file-uploader/file-uploader-model");
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var GeneralI18nForm = (function (_super) {
    __extends(GeneralI18nForm, _super);
    function GeneralI18nForm() {
        _super.apply(this, arguments);
        this.deliveryDescription = '';
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
        this.catalogImage = new my_cropper_image_1.MyCropperImage();
        this.catalogFile = new file_uploader_model_1.FileUploaderModel();
        this.saveI18n = true;
    }
    GeneralI18nForm.prototype.reset = function () {
        this.deliveryDescription = '';
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
        this.catalogImage.reset();
        this.catalogFile.reset();
    };
    GeneralI18nForm.prototype.populate = function (data) {
        this.deliveryDescription = data['deliveryDescription'];
        this.title = data['title'];
        this.metaKeywords = data['metaKeywords'];
        this.metaDescription = data['metaDescription'];
        this.catalogImage.currentImageUrl = data['catalogImageUrl'];
        this.catalogFile.currentFileUrl = data['catalogFileUrl'];
    };
    GeneralI18nForm.prototype.getData = function () {
        return {
            deliveryDescription: this.deliveryDescription,
            title: this.title,
            metaKeywords: this.metaKeywords,
            metaDescription: this.metaDescription,
            catalogImage: this.catalogImage.croppedImage,
            catalogFileUrl: this.catalogFile.uploadedFileUrl,
            catalogFileName: this.catalogFile.uploadedFileName,
        };
    };
    return GeneralI18nForm;
}(i18n_form_1.I18nForm));
exports.GeneralI18nForm = GeneralI18nForm;
//# sourceMappingURL=general-i18n-form.js.map