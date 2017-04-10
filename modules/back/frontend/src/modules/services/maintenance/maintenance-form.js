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
var maintenance_i18n_form_1 = require("./maintenance-i18n-form");
var service_form_1 = require("../service/service-form");
var MaintenanceForm = (function (_super) {
    __extends(MaintenanceForm, _super);
    function MaintenanceForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
    }
    MaintenanceForm.prototype.getBackend = function () {
        return this.backend;
    };
    MaintenanceForm.prototype.getBackendUrl = function () {
        return 'services/maintenance';
    };
    MaintenanceForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    MaintenanceForm.prototype.getI18nFormClass = function () {
        return maintenance_i18n_form_1.MaintenanceI18nForm;
    };
    MaintenanceForm.prototype.hasBg = function () {
        return false;
    };
    MaintenanceForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], MaintenanceForm);
    return MaintenanceForm;
}(service_form_1.ServiceForm));
exports.MaintenanceForm = MaintenanceForm;
//# sourceMappingURL=maintenance-form.js.map