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
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var core_1 = require('@angular/core');
var production_banner_details_i18n_form_1 = require("./production-banner-details-i18n-form");
var backend_service_1 = require("../../../services/backend.service");
var languages_manager_1 = require("../../../services/languages-manager");
var crud_grid_entity_form_1 = require("../../../common/crud-grid/crud-grid-entity-form");
var ProductionBannerDetailsForm = (function (_super) {
    __extends(ProductionBannerDetailsForm, _super);
    function ProductionBannerDetailsForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.image = new my_cropper_image_1.MyCropperImage();
    }
    ProductionBannerDetailsForm.prototype.getBackend = function () {
        return this.backend;
    };
    ProductionBannerDetailsForm.prototype.getBackendUrl = function () {
        return 'about-page/production-banners';
    };
    ProductionBannerDetailsForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    ProductionBannerDetailsForm.prototype.reset = function () {
        this.image.reset();
    };
    ProductionBannerDetailsForm.prototype.populate = function (data) {
        this.image.currentImageUrl = data['imageUrl'];
    };
    ProductionBannerDetailsForm.prototype.getData = function () {
        return {
            image: this.image.croppedImage
        };
    };
    ProductionBannerDetailsForm.prototype.getI18nFormClass = function () {
        return production_banner_details_i18n_form_1.ProductionBannerDetailsI18nForm;
    };
    ProductionBannerDetailsForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], ProductionBannerDetailsForm);
    return ProductionBannerDetailsForm;
}(crud_grid_entity_form_1.CrudGridEntityForm));
exports.ProductionBannerDetailsForm = ProductionBannerDetailsForm;
//# sourceMappingURL=production-banner-details-form.js.map