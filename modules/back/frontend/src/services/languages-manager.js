"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var language_1 = require("./language");
var backend_service_1 = require("./backend.service");
var core_1 = require('@angular/core');
/**
 * Класс для работы с менеджером языков
 */
var LanguagesManager = (function () {
    function LanguagesManager(backend) {
        this.backend = backend;
        this.languages = [];
        this.isInitialized = false;
    }
    LanguagesManager.prototype.init = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            if (_this.isInitialized) {
                resolve();
                return;
            }
            _this.backend.get('auth/languages-init')
                .then(function (resp) {
                _this.languages = [];
                for (var _i = 0, _a = resp.json(); _i < _a.length; _i++) {
                    var langData = _a[_i];
                    var language = new language_1.Language();
                    Object.assign(language, langData);
                    _this.languages.push(language);
                }
                if (!_this.languages.length) {
                    reject();
                }
                _this.isInitialized = true;
                resolve();
            })
                .catch(function (resp) {
                console.error(resp.text());
                reject();
            });
        });
    };
    LanguagesManager.prototype.getLanguages = function () {
        return this.languages;
    };
    LanguagesManager.prototype.getDefaultLanguage = function () {
        return this.languages[0];
    };
    LanguagesManager.prototype.getLanguageById = function (id) {
        for (var _i = 0, _a = this.languages; _i < _a.length; _i++) {
            var language = _a[_i];
            if (language.id == id) {
                return language;
            }
        }
        return null;
    };
    LanguagesManager = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService])
    ], LanguagesManager);
    return LanguagesManager;
}());
exports.LanguagesManager = LanguagesManager;
//# sourceMappingURL=languages-manager.js.map