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
var type_i18n_form_1 = require("./type-i18n-form");
var advantage_form_1 = require("./advantage-form");
var TypeForm = (function (_super) {
    __extends(TypeForm, _super);
    function TypeForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.preview = new my_cropper_image_1.MyCropperImage();
        this.widePreview = new my_cropper_image_1.MyCropperImage();
        this.bg = new my_cropper_image_1.MyCropperImage();
        this.advantages = [];
    }
    TypeForm.prototype.getBackend = function () {
        return this.backend;
    };
    TypeForm.prototype.getBackendUrl = function () {
        return 'pools-building/pool-types';
    };
    TypeForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    TypeForm.prototype.reset = function () {
        this.preview.reset();
        this.widePreview.reset();
        this.bg.reset();
        this.advantages = [];
    };
    TypeForm.prototype.populate = function (data) {
        this.preview.currentImageUrl = data['previewUrl'];
        this.widePreview.currentImageUrl = data['widePreviewUrl'];
        this.bg.currentImageUrl = data['bgUrl'];
        for (var _i = 0, _a = data['advantages']; _i < _a.length; _i++) {
            var advData = _a[_i];
            var advantage = new advantage_form_1.AdvantageForm(this.langsManager);
            advantage.populate(advData);
            this.advantages.push(advantage);
        }
    };
    TypeForm.prototype.getData = function () {
        var advsData = [];
        for (var _i = 0, _a = this.advantages; _i < _a.length; _i++) {
            var advantage = _a[_i];
            advsData.push(advantage.getData());
        }
        return {
            preview: this.preview.croppedImage,
            widePreview: this.widePreview.croppedImage,
            bg: this.bg.croppedImage,
            advantages: advsData,
        };
    };
    TypeForm.prototype.getI18nFormClass = function () {
        return type_i18n_form_1.TypeI18nForm;
    };
    TypeForm.prototype.setErrors = function (errors) {
        _super.prototype.setErrors.call(this, errors);
        var i = 0;
        for (var _i = 0, _a = errors['advantages']; _i < _a.length; _i++) {
            var advErrors = _a[_i];
            this.advantages[i].setErrors(advErrors);
            i++;
        }
    };
    TypeForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], TypeForm);
    return TypeForm;
}(crud_grid_entity_form_1.CrudGridEntityForm));
exports.TypeForm = TypeForm;
//# sourceMappingURL=type-form.js.map