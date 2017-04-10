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
var history_i18n_form_1 = require("./history-i18n-form");
var form_panel_form_1 = require("../../../common/form-panel/form-panel-form");
var HistoryForm = (function (_super) {
    __extends(HistoryForm, _super);
    function HistoryForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
    }
    HistoryForm.prototype.getBackend = function () {
        return this.backend;
    };
    HistoryForm.prototype.getBackendUrl = function () {
        return 'about-page/history';
    };
    HistoryForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    HistoryForm.prototype.reset = function () { };
    HistoryForm.prototype.populate = function (data) { };
    HistoryForm.prototype.getData = function () { return {}; };
    HistoryForm.prototype.getI18nFormClass = function () {
        return history_i18n_form_1.HistoryI18nForm;
    };
    HistoryForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], HistoryForm);
    return HistoryForm;
}(form_panel_form_1.FormPanelForm));
exports.HistoryForm = HistoryForm;
//# sourceMappingURL=history-form.js.map