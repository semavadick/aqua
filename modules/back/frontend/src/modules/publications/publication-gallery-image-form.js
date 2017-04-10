"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var my_cropper_image_1 = require("../../common/my-cropper/my-cropper-image");
var publication_gallery_image_i18n_form_1 = require("./publication-gallery-image-i18n-form");
var entity_form_1 = require("../../common/entity-form");
var PublicationGalleryImageForm = (function (_super) {
    __extends(PublicationGalleryImageForm, _super);
    function PublicationGalleryImageForm(langsManager) {
        _super.call(this);
        this.langsManager = langsManager;
        this.id = null;
        this.image = new my_cropper_image_1.MyCropperImage();
    }
    PublicationGalleryImageForm.prototype.getBackend = function () {
        return undefined;
    };
    PublicationGalleryImageForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    PublicationGalleryImageForm.prototype.getI18nFormClass = function () {
        return publication_gallery_image_i18n_form_1.PublicationGalleryImageI18nForm;
    };
    PublicationGalleryImageForm.prototype.reset = function () {
        this.id = null;
        this.image.reset();
        for (var _i = 0, _a = this.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            i18n.reset();
        }
    };
    PublicationGalleryImageForm.prototype.populate = function (data) {
        this.id = data['id'];
        this.image.currentImageUrl = data['imageUrl'];
        for (var _i = 0, _a = data['i18ns']; _i < _a.length; _i++) {
            var i18nData = _a[_i];
            var languageId = i18nData['languageId'];
            for (var _b = 0, _c = this.getI18ns(); _b < _c.length; _b++) {
                var i18n = _c[_b];
                if (i18n.language.id == languageId) {
                    i18n.populate(i18nData);
                    break;
                }
            }
        }
    };
    PublicationGalleryImageForm.prototype.getData = function () {
        var i18nsData = [];
        for (var _i = 0, _a = this.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            var i18nData = i18n.getData();
            i18nData['languageId'] = i18n.language.id;
            i18nsData.push(i18nData);
        }
        return {
            id: this.id,
            image: this.image.croppedImage,
            i18ns: i18nsData,
        };
    };
    PublicationGalleryImageForm.prototype.getPreviewUrl = function () {
        var image = this.image;
        if (image.croppedImage) {
            return image.croppedImage;
        }
        if (image.uploadedImage) {
            return image.uploadedImage;
        }
        if (image.currentImageUrl) {
            return image.currentImageUrl;
        }
        return null;
    };
    return PublicationGalleryImageForm;
}(entity_form_1.EntityForm));
exports.PublicationGalleryImageForm = PublicationGalleryImageForm;
//# sourceMappingURL=publication-gallery-image-form.js.map