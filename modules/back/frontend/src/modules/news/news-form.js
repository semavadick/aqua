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
var core_1 = require("@angular/core");
var backend_service_1 = require("../../services/backend.service");
var languages_manager_1 = require("../../services/languages-manager");
var publication_form_1 = require("../publications/publication-form");
var NewsForm = (function (_super) {
    __extends(NewsForm, _super);
    function NewsForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
    }
    NewsForm.prototype.getBackendUrl = function () {
        return 'news';
    };
    NewsForm.prototype.getBackend = function () {
        return this.backend;
    };
    NewsForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    NewsForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], NewsForm);
    return NewsForm;
}(publication_form_1.PublicationForm));
exports.NewsForm = NewsForm;
//# sourceMappingURL=news-form.js.map