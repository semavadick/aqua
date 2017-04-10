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
var core_1 = require('@angular/core');
var backend_service_1 = require("./backend.service");
var languages_manager_1 = require("./languages-manager");
/**
 * Класс для работы с веб-юзером
 */
var WebUser = (function () {
    function WebUser(backend, langsManager) {
        this.backend = backend;
        this.langsManager = langsManager;
        this.isInitialized = false;
        /** Залогинен ли юзер */
        this.isLoggedIn = false;
        /** Может ли юзер управлять главной страницей */
        this.canManageMainPage = false;
        /** Может ли юзер управлять страницей О компании */
        this.canManageAboutPage = false;
        /** Может ли юзер управлять страницей Строительство бассейнов */
        this.canManagePoolsBuildingPage = false;
        /** Может ли юзер управлять Объектами */
        this.canManageObjectGalleries = false;
        /** Может ли юзер управлять новостями */
        this.canManageNews = false;
        /** Может ли юзер управлять статьями */
        this.canManageArticles = false;
        /** Может ли юзер управлять услугами */
        this.canManageServices = false;
        /** Может ли юзер управлять каталогом */
        this.canManageCatalog = false;
        /** Может ли юзер управлять пользователями */
        this.canManageUsers = false;
        /** Может ли юзер управлять заказами */
        this.canManageOrders = false;
        /** Может ли юзер управлять настройками */
        this.canManageSettings = false;
    }
    WebUser.prototype.logout = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            _this.backend.post('auth/logout')
                .then(function (resp) {
                _this.isLoggedIn = false;
                resolve('ok');
            })
                .catch(function (resp) {
                reject(resp.text());
            });
        });
    };
    WebUser.prototype.init = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            if (_this.isInitialized) {
                resolve();
                return;
            }
            _this.updateInformation()
                .then(resolve)
                .catch(reject);
        });
    };
    WebUser.prototype.updateInformation = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            _this.backend.get('auth/user-init')
                .then(function (resp) {
                Object.assign(_this, resp.json());
                resolve();
            })
                .catch(function (resp) {
                console.error(resp.text());
                reject();
            });
        });
    };
    WebUser = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], WebUser);
    return WebUser;
}());
exports.WebUser = WebUser;
//# sourceMappingURL=web-user.js.map