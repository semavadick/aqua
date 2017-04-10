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
var core_1 = require('@angular/core');
var backend_service_1 = require("../../../services/backend.service");
var languages_manager_1 = require("../../../services/languages-manager");
var competence_i18n_form_1 = require("./competence-i18n-form");
var form_panel_form_1 = require("../../../common/form-panel/form-panel-form");
var my_cropper_image_1 = require("../../../common/my-cropper/my-cropper-image");
var CompetenceForm = (function (_super) {
    __extends(CompetenceForm, _super);
    function CompetenceForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.image = new my_cropper_image_1.MyCropperImage();
    }
    CompetenceForm.prototype.getBackend = function () {
        return this.backend;
    };
    CompetenceForm.prototype.getBackendUrl = function () {
        return 'about-page/competence';
    };
    CompetenceForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    CompetenceForm.prototype.reset = function () {
        this.image.reset();
    };
    CompetenceForm.prototype.populate = function (data) {
        this.image.currentImageUrl = data['imageUrl'];
    };
    CompetenceForm.prototype.getData = function () {
        return {
            image: this.image.croppedImage
        };
    };
    CompetenceForm.prototype.getI18nFormClass = function () {
        return competence_i18n_form_1.CompetenceI18nForm;
    };
    CompetenceForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], CompetenceForm);
    return CompetenceForm;
}(form_panel_form_1.FormPanelForm));
exports.CompetenceForm = CompetenceForm;
//# sourceMappingURL=competence-form.js.map