"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var form_1 = require("../../common/form");
var publication_gallery_image_form_1 = require("./publication-gallery-image-form");
var PublicationGalleryForm = (function (_super) {
    __extends(PublicationGalleryForm, _super);
    function PublicationGalleryForm(langsManager) {
        _super.call(this);
        this.langsManager = langsManager;
        this.id = null;
        this.images = [];
    }
    PublicationGalleryForm.prototype.reset = function () {
        this.id = null;
        for (var _i = 0, _a = this.images; _i < _a.length; _i++) {
            var image = _a[_i];
            image.reset();
        }
    };
    PublicationGalleryForm.prototype.populate = function (data) {
        this.id = data['id'];
        for (var _i = 0, _a = data['images']; _i < _a.length; _i++) {
            var imageData = _a[_i];
            var image = new publication_gallery_image_form_1.PublicationGalleryImageForm(this.langsManager);
            image.populate(imageData);
            this.images.push(image);
        }
    };
    PublicationGalleryForm.prototype.getData = function () {
        var imagesData = [];
        for (var _i = 0, _a = this.images; _i < _a.length; _i++) {
            var image = _a[_i];
            imagesData.push(image.getData());
        }
        return {
            id: this.id,
            images: imagesData,
        };
    };
    return PublicationGalleryForm;
}(form_1.Form));
exports.PublicationGalleryForm = PublicationGalleryForm;
//# sourceMappingURL=publication-gallery-form.js.map