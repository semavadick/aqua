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
var general_i18n_form_1 = require("./general-i18n-form");
var form_panel_form_1 = require("../../../common/form-panel/form-panel-form");
var GeneralForm = (function (_super) {
    __extends(GeneralForm, _super);
    function GeneralForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
    }
    GeneralForm.prototype.getBackendUrl = function () {
        return 'catalog/general';
    };
    GeneralForm.prototype.reset = function () { };
    GeneralForm.prototype.populate = function (data) {
    };
    GeneralForm.prototype.getData = function () {
        return {};
    };
    GeneralForm.prototype.getBackend = function () {
        return this.backend;
    };
    GeneralForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    GeneralForm.prototype.getI18nFormClass = function () {
        return general_i18n_form_1.GeneralI18nForm;
    };
    GeneralForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], GeneralForm);
    return GeneralForm;
}(form_panel_form_1.FormPanelForm));
exports.GeneralForm = GeneralForm;
//# sourceMappingURL=general-form.js.map