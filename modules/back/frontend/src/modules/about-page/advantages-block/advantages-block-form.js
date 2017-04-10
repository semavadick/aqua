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
var advantages_block_i18n_form_1 = require("./advantages-block-i18n-form");
var form_panel_form_1 = require("../../../common/form-panel/form-panel-form");
var AdvantagesBlockForm = (function (_super) {
    __extends(AdvantagesBlockForm, _super);
    function AdvantagesBlockForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
    }
    AdvantagesBlockForm.prototype.getBackend = function () {
        return this.backend;
    };
    AdvantagesBlockForm.prototype.getBackendUrl = function () {
        return 'about-page/advantages-block';
    };
    AdvantagesBlockForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    AdvantagesBlockForm.prototype.reset = function () { };
    AdvantagesBlockForm.prototype.populate = function (data) { };
    AdvantagesBlockForm.prototype.getData = function () { return {}; };
    AdvantagesBlockForm.prototype.getI18nFormClass = function () {
        return advantages_block_i18n_form_1.AdvantagesBlockI18nForm;
    };
    AdvantagesBlockForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], AdvantagesBlockForm);
    return AdvantagesBlockForm;
}(form_panel_form_1.FormPanelForm));
exports.AdvantagesBlockForm = AdvantagesBlockForm;
//# sourceMappingURL=advantages-block-form.js.map