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
var router_1 = require('@angular/router');
var http_1 = require('@angular/http');
/**
 * Класс для работы с API backend
 */
var BackendService = (function () {
    function BackendService(http, router) {
        this.router = router;
        this.backendBaseUrl = '/back/';
        this.http = http;
    }
    BackendService.prototype.get = function (url, options) {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.get(url, options));
    };
    BackendService.prototype.post = function (url, options) {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.post(url, options));
    };
    BackendService.prototype.put = function (url, options) {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.put(url, options));
    };
    BackendService.prototype.delete = function (url, options) {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.delete(url, options));
    };
    BackendService.prototype.obsToPromise = function (obs) {
        var _this = this;
        return new Promise(function (resolve, reject) {
            obs.subscribe(function (response) {
                resolve(response);
            }, function (response) {
                if (response.status == 401) {
                    _this.router.navigate(['/auth/login', { returnUrl: _this.router.routerState.snapshot.url }]);
                    return;
                }
                reject(response);
            });
        });
    };
    BackendService = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [http_1.Http, router_1.Router])
    ], BackendService);
    return BackendService;
}());
exports.BackendService = BackendService;
//# sourceMappingURL=backend.service.js.map