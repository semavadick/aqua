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
var crud_grid_entity_form_1 = require("../../../common/crud-grid/crud-grid-entity-form");
var backend_service_1 = require("../../../services/backend.service");
var languages_manager_1 = require("../../../services/languages-manager");
var faq_item_i18n_form_1 = require("./faq-item-i18n-form");
var FaqItemForm = (function (_super) {
    __extends(FaqItemForm, _super);
    function FaqItemForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
    }
    FaqItemForm.prototype.getBackend = function () {
        return this.backend;
    };
    FaqItemForm.prototype.getBackendUrl = function () {
        return 'pools-building/faq';
    };
    FaqItemForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    FaqItemForm.prototype.reset = function () {
    };
    FaqItemForm.prototype.populate = function (data) {
    };
    FaqItemForm.prototype.getData = function () {
        return {};
    };
    FaqItemForm.prototype.getI18nFormClass = function () {
        return faq_item_i18n_form_1.FaqItemI18nForm;
    };
    FaqItemForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], FaqItemForm);
    return FaqItemForm;
}(crud_grid_entity_form_1.CrudGridEntityForm));
exports.FaqItemForm = FaqItemForm;
//# sourceMappingURL=faq-item-form.js.map