"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var form_1 = require("../../../common/form");
var pools_building_static_gallery_image_form_1 = require("./pools-building-static-gallery-image-form");
var PoolsBuildingStaticGalleryForm = (function (_super) {
    __extends(PoolsBuildingStaticGalleryForm, _super);
    function PoolsBuildingStaticGalleryForm(langsManager) {
        _super.call(this);
        this.langsManager = langsManager;
        this.id = null;
        this.images = [];
    }
    PoolsBuildingStaticGalleryForm.prototype.reset = function () {
        this.id = null;
        for (var _i = 0, _a = this.images; _i < _a.length; _i++) {
            var image = _a[_i];
            image.reset();
        }
    };
    PoolsBuildingStaticGalleryForm.prototype.populate = function (data) {
        this.id = data['id'];
        for (var _i = 0, _a = data['images']; _i < _a.length; _i++) {
            var imageData = _a[_i];
            var image = new pools_building_static_gallery_image_form_1.PoolsBuildingStaticGalleryImageForm(this.langsManager);
            image.populate(imageData);
            this.images.push(image);
        }
    };
    PoolsBuildingStaticGalleryForm.prototype.getData = function () {
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
    return PoolsBuildingStaticGalleryForm;
}(form_1.Form));
exports.PoolsBuildingStaticGalleryForm = PoolsBuildingStaticGalleryForm;
//# sourceMappingURL=pools-building-static-gallery-form.js.map