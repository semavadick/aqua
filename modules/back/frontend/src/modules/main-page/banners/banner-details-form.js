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
var banner_details_i18n_form_1 = require("./banner-details-i18n-form");
var backend_service_1 = require("../../../services/backend.service");
var languages_manager_1 = require("../../../services/languages-manager");
var crud_grid_entity_form_1 = require("../../../common/crud-grid/crud-grid-entity-form");
var BannerDetailsForm = (function (_super) {
    __extends(BannerDetailsForm, _super);
    function BannerDetailsForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.image = new my_cropper_image_1.MyCropperImage();
    }
    BannerDetailsForm.prototype.getBackend = function () {
        return this.backend;
    };
    BannerDetailsForm.prototype.getBackendUrl = function () {
        return 'main-page/banners';
    };
    BannerDetailsForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    BannerDetailsForm.prototype.reset = function () {
        this.image.reset();
    };
    BannerDetailsForm.prototype.populate = function (data) {
        this.image.currentImageUrl = data['imageUrl'];
    };
    BannerDetailsForm.prototype.getData = function () {
        return {
            image: this.image.croppedImage
        };
    };
    BannerDetailsForm.prototype.getI18nFormClass = function () {
        return banner_details_i18n_form_1.BannerDetailsI18nForm;
    };
    BannerDetailsForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], BannerDetailsForm);
    return BannerDetailsForm;
}(crud_grid_entity_form_1.CrudGridEntityForm));
exports.BannerDetailsForm = BannerDetailsForm;
//# sourceMappingURL=banner-details-form.js.map