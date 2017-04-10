"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var my_cropper_image_1 = require("../../common/my-cropper/my-cropper-image");
var form_1 = require("../../common/form");
var GalleryImageForm = (function (_super) {
    __extends(GalleryImageForm, _super);
    function GalleryImageForm() {
        _super.apply(this, arguments);
        this.id = null;
        this.image = new my_cropper_image_1.MyCropperImage();
    }
    GalleryImageForm.prototype.reset = function () {
        this.id = null;
        this.image.reset();
    };
    GalleryImageForm.prototype.populate = function (data) {
        this.id = data['id'];
        this.image.currentImageUrl = data['imageUrl'];
    };
    GalleryImageForm.prototype.getData = function () {
        return {
            id: this.id,
            image: this.image.croppedImage,
        };
    };
    GalleryImageForm.prototype.getPreviewUrl = function () {
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
    return GalleryImageForm;
}(form_1.Form));
exports.GalleryImageForm = GalleryImageForm;
//# sourceMappingURL=gallery-image-form.js.map