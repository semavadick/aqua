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
var web_user_1 = require("../../services/web-user");
var core_1 = require('@angular/core');
var backend_service_1 = require("../../services/backend.service");
/**
 * Класс для работы с формой логина
 */
var PasswordRecoveryForm = (function () {
    function PasswordRecoveryForm(wUser, backend) {
        this.wUser = wUser;
        this.backend = backend;
    }
    PasswordRecoveryForm.prototype.recover = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            var params = {
                email: _this.email
            };
            _this.backend.post('auth/password-recovery', params)
                .then(function (resp) {
                resolve(resp.text());
            })
                .catch(function (resp) {
                reject(resp.text());
            });
        });
    };
    PasswordRecoveryForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [web_user_1.WebUser, backend_service_1.BackendService])
    ], PasswordRecoveryForm);
    return PasswordRecoveryForm;
}());
exports.PasswordRecoveryForm = PasswordRecoveryForm;
//# sourceMappingURL=password-recovery-form.js.map