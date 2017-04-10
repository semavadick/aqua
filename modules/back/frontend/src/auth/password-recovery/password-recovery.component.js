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
var password_recovery_form_1 = require("./password-recovery-form");
var PasswordRecoveryComponent = (function () {
    function PasswordRecoveryComponent(form) {
        this.form = form;
        this.recovered = false;
    }
    PasswordRecoveryComponent.prototype.recover = function () {
        var _this = this;
        this.form.recover()
            .then(function (message) {
            _this.recovered = true;
        })
            .catch(function (message) {
            alert(message);
        });
    };
    PasswordRecoveryComponent = __decorate([
        core_1.Component({
            templateUrl: './password-recovery.html',
            providers: [password_recovery_form_1.PasswordRecoveryForm],
            directives: [router_1.ROUTER_DIRECTIVES]
        }), 
        __metadata('design:paramtypes', [password_recovery_form_1.PasswordRecoveryForm])
    ], PasswordRecoveryComponent);
    return PasswordRecoveryComponent;
}());
exports.PasswordRecoveryComponent = PasswordRecoveryComponent;
//# sourceMappingURL=password-recovery.component.js.map