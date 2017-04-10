"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require("@angular/core");
var backend_service_1 = require("../../services/backend.service");
var languages_manager_1 = require("../../services/languages-manager");
var my_datatable_entity_form_1 = require("../../common/my-datatable/my-datatable-entity-form");
var gallery_18n_form_1 = require("./gallery-18n-form");
var gallery_image_form_1 = require("./gallery-image-form");
var galleries_manager_1 = require("./galleries-manager");
var GalleryForm = (function (_super) {
    __extends(GalleryForm, _super);
    function GalleryForm(backend, langsManager, galleriesManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.galleriesManager = galleriesManager;
        this.isTop = false;
        this.isExclusive = false;
        this.coordsLat = 0;
        this.coordsLng = 0;
        this.typeIds = [];
        this.images = [];
    }
    GalleryForm.prototype.init = function (entity) {
        var _this = this;
        if (entity === void 0) { entity = null; }
        return _super.prototype.init.call(this, entity)
            .then(function (message) {
            return _this.galleriesManager.loadPoolTypes();
        });
    };
    GalleryForm.prototype.getBackendUrl = function () {
        return 'object-galleries';
    };
    GalleryForm.prototype.getBackend = function () {
        return this.backend;
    };
    GalleryForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    GalleryForm.prototype.reset = function () {
        this.isTop = false;
        this.isExclusive = false;
        this.coordsLat = 0;
        this.coordsLng = 0;
        this.typeIds = [];
        this.images = [];
    };
    GalleryForm.prototype.populate = function (data) {
        this.isTop = data['isTop'];
        this.isExclusive = data['isExclusive'];
        this.coordsLat = data['coordsLat'];
        this.coordsLng = data['coordsLng'];
        this.typeIds = data['typeIds'];
        for (var _i = 0, _a = data['images']; _i < _a.length; _i++) {
            var imageData = _a[_i];
            var image = new gallery_image_form_1.GalleryImageForm();
            image.populate(imageData);
            this.images.push(image);
        }
    };
    GalleryForm.prototype.getData = function () {
        var imagesData = [];
        for (var _i = 0, _a = this.images; _i < _a.length; _i++) {
            var image = _a[_i];
            imagesData.push(image.getData());
        }
        return {
            isTop: this.isTop,
            isExclusive: this.isExclusive,
            coordsLat: this.coordsLat,
            coordsLng: this.coordsLng,
            typeIds: this.typeIds,
            images: imagesData,
        };
    };
    GalleryForm.prototype.getI18nFormClass = function () {
        return gallery_18n_form_1.GalleryI18nForm;
    };
    GalleryForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager, galleries_manager_1.GalleriesManager])
    ], GalleryForm);
    return GalleryForm;
}(my_datatable_entity_form_1.MyDatatableEntityForm));
exports.GalleryForm = GalleryForm;
//# sourceMappingURL=gallery-form.js.map