"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var form_panel_form_1 = require("../../../common/form-panel/form-panel-form");
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var pools_building_static_i18n_form_1 = require("./pools-building-static-i18n-form");
var pools_building_static_gallery_form_1 = require("../publications/pools-building-static-gallery-form");
var PoolsBuildingStaticForm = (function (_super) {
    __extends(PoolsBuildingStaticForm, _super);
    function PoolsBuildingStaticForm() {
        _super.apply(this, arguments);
        this.bg = new my_cropper_image_1.MyCropperImage();
        this.galleries = [];
    }
    PoolsBuildingStaticForm.prototype.reset = function () {
        this.bg.reset();
        this.galleries = [];
    };
    PoolsBuildingStaticForm.prototype.populate = function (data) {
        this.bg.currentImageUrl = data['bgUrl'];
        for (var _i = 0, _a = data['galleries']; _i < _a.length; _i++) {
            var galleryData = _a[_i];
            var gallery = new pools_building_static_gallery_form_1.PoolsBuildingStaticGalleryForm(this.getLanguagesManager());
            gallery.populate(galleryData);
            this.galleries.push(gallery);
        }
    };
    PoolsBuildingStaticForm.prototype.getData = function () {
        var galleriesData = [];
        for (var _i = 0, _a = this.galleries; _i < _a.length; _i++) {
            var gallery = _a[_i];
            galleriesData.push(gallery.getData());
        }
        return {
            bg: this.bg.croppedImage,
            galleries: galleriesData,
        };
    };
    PoolsBuildingStaticForm.prototype.getI18nFormClass = function () {
        return pools_building_static_i18n_form_1.PoolsBuildingStaticI18nForm;
    };
    PoolsBuildingStaticForm.prototype.setErrors = function (errors) {
        _super.prototype.setErrors.call(this, errors);
    };
    return PoolsBuildingStaticForm;
}(form_panel_form_1.FormPanelForm));
exports.PoolsBuildingStaticForm = PoolsBuildingStaticForm;
//# sourceMappingURL=pools-building-static-form.js.map