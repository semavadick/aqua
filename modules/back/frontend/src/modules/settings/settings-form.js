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
var backend_service_1 = require("../../services/backend.service");
var languages_manager_1 = require("../../services/languages-manager");
var form_panel_form_1 = require("../../common/form-panel/form-panel-form");
var SettingsForm = (function (_super) {
    __extends(SettingsForm, _super);
    function SettingsForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.phone1 = '';
        this.phone2 = '';
        this.colnsultEmail = '';
        this.calcEmail = '';
        this.feedbackEmail = '';
        this.facebookLink = '';
        this.twitterLink = '';
        this.youtubeLink = '';
        this.countersCode = '';
    }
    SettingsForm.prototype.getBackend = function () {
        return this.backend;
    };
    SettingsForm.prototype.getBackendUrl = function () {
        return 'settings';
    };
    SettingsForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    SettingsForm.prototype.reset = function () {
    };
    SettingsForm.prototype.populate = function (data) {
        Object.assign(this, data);
    };
    SettingsForm.prototype.getData = function () {
        return {
            phone1: this.phone1,
            phone2: this.phone2,
            colnsultEmail: this.colnsultEmail,
            calcEmail: this.calcEmail,
            feedbackEmail: this.feedbackEmail,
            facebookLink: this.facebookLink,
            twitterLink: this.twitterLink,
            youtubeLink: this.youtubeLink,
            countersCode: this.countersCode,
        };
    };
    SettingsForm.prototype.getI18nFormClass = function () {
        return null;
    };
    SettingsForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], SettingsForm);
    return SettingsForm;
}(form_panel_form_1.FormPanelForm));
exports.SettingsForm = SettingsForm;
//# sourceMappingURL=settings-form.js.map