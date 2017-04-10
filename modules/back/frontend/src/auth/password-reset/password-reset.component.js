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
var password_reset_form_1 = require("./password-reset-form");
var PasswordResetComponent = (function () {
    function PasswordResetComponent(form, router) {
        var _this = this;
        this.form = form;
        this.router = router;
        this.isReset = false;
        router.routerState.queryParams.subscribe(function (params) {
            _this.form.userId = params['i'];
            _this.form.resetToken = params['t'];
        });
    }
    PasswordResetComponent.prototype.reset = function () {
        var _this = this;
        this.form.reset()
            .then(function (message) {
            _this.isReset = true;
        })
            .catch(function (message) {
            alert(message);
        });
    };
    PasswordResetComponent = __decorate([
        core_1.Component({
            templateUrl: './password-reset.html',
            providers: [password_reset_form_1.PasswordResetForm],
            directives: [router_1.ROUTER_DIRECTIVES]
        }), 
        __metadata('design:paramtypes', [password_reset_form_1.PasswordResetForm, router_1.Router])
    ], PasswordResetComponent);
    return PasswordResetComponent;
}());
exports.PasswordResetComponent = PasswordResetComponent;
//# sourceMappingURL=password-reset.component.js.map