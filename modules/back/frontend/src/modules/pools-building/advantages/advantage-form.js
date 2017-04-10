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
var crud_grid_entity_form_1 = require("../../../common/crud-grid/crud-grid-entity-form");
var backend_service_1 = require("../../../services/backend.service");
var languages_manager_1 = require("../../../services/languages-manager");
var advantage_i18n_form_1 = require("./advantage-i18n-form");
var AdvantageForm = (function (_super) {
    __extends(AdvantageForm, _super);
    function AdvantageForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.icon = new my_cropper_image_1.MyCropperImage();
    }
    AdvantageForm.prototype.getBackend = function () {
        return this.backend;
    };
    AdvantageForm.prototype.getBackendUrl = function () {
        return 'pools-building/advantages';
    };
    AdvantageForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    AdvantageForm.prototype.reset = function () {
        this.icon.reset();
    };
    AdvantageForm.prototype.populate = function (data) {
        this.icon.currentImageUrl = data['iconUrl'];
    };
    AdvantageForm.prototype.getData = function () {
        return {
            icon: this.icon.croppedImage,
        };
    };
    AdvantageForm.prototype.getI18nFormClass = function () {
        return advantage_i18n_form_1.AdvantageI18nForm;
    };
    AdvantageForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], AdvantageForm);
    return AdvantageForm;
}(crud_grid_entity_form_1.CrudGridEntityForm));
exports.AdvantageForm = AdvantageForm;
//# sourceMappingURL=advantage-form.js.map