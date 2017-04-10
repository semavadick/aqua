"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var my_datatable_entity_form_1 = require("../../common/my-datatable/my-datatable-entity-form");
var publication_i18n_form_1 = require("./publication-i18n-form");
var my_cropper_image_1 = require("../../common/my-cropper/my-cropper-image");
var publication_gallery_form_1 = require("../publications/publication-gallery-form");
var PublicationForm = (function (_super) {
    __extends(PublicationForm, _super);
    function PublicationForm() {
        _super.apply(this, arguments);
        this.preview = new my_cropper_image_1.MyCropperImage();
        this.bg = new my_cropper_image_1.MyCropperImage();
        this.galleries = [];
    }
    PublicationForm.prototype.reset = function () {
        this.preview.reset();
        this.bg.reset();
        this.galleries = [];
    };
    PublicationForm.prototype.populate = function (data) {
        this.preview.currentImageUrl = data['previewUrl'];
        this.bg.currentImageUrl = data['bgUrl'];
        for (var _i = 0, _a = data['galleries']; _i < _a.length; _i++) {
            var galleryData = _a[_i];
            var gallery = new publication_gallery_form_1.PublicationGalleryForm(this.getLanguagesManager());
            gallery.populate(galleryData);
            this.galleries.push(gallery);
        }
    };
    PublicationForm.prototype.getData = function () {
        var galleriesData = [];
        for (var _i = 0, _a = this.galleries; _i < _a.length; _i++) {
            var gallery = _a[_i];
            galleriesData.push(gallery.getData());
        }
        return {
            preview: this.preview.croppedImage,
            bg: this.bg.croppedImage,
            galleries: galleriesData,
        };
    };
    PublicationForm.prototype.getI18nFormClass = function () {
        return publication_i18n_form_1.PublicationI18nForm;
    };
    return PublicationForm;
}(my_datatable_entity_form_1.MyDatatableEntityForm));
exports.PublicationForm = PublicationForm;
//# sourceMappingURL=publication-form.js.map