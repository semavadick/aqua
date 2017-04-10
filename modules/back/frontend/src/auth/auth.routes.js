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
var auth_component_1 = require('./auth.component');
var login_component_1 = require('./login/login.component');
var Observable_1 = require("rxjs/Observable");
var web_user_1 = require("../services/web-user");
var password_recovery_component_1 = require("./password-recovery/password-recovery.component");
var password_reset_component_1 = require("./password-reset/password-reset.component");
var AuthGuard = (function () {
    function AuthGuard(wUser, router) {
        this.wUser = wUser;
        this.router = router;
    }
    AuthGuard.prototype.canActivate = function () {
        var _this = this;
        var wUser = this.wUser;
        return Observable_1.Observable.create(function (observer) {
            wUser.init()
                .then(function () {
                if (wUser.isLoggedIn) {
                    _this.router.navigate(['/']);
                    observer.next(false);
                }
                else {
                    observer.next(true);
                }
                observer.complete();
            })
                .catch(function () {
                alert('Ошибка инициализации приложения');
                observer.next(false);
                observer.complete();
            });
        });
    };
    AuthGuard = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [web_user_1.WebUser, router_1.Router])
    ], AuthGuard);
    return AuthGuard;
}());
exports.AuthGuard = AuthGuard;
exports.authRoutes = [
    {
        path: 'auth',
        component: auth_component_1.AuthComponent,
        canActivate: [AuthGuard],
        children: [
            {
                path: 'login',
                component: login_component_1.LoginComponent
            },
            {
                path: 'password-recovery',
                component: password_recovery_component_1.PasswordRecoveryComponent
            },
            {
                path: 'password-reset',
                component: password_reset_component_1.PasswordResetComponent
            },
        ],
    },
];
exports.authProviders = [
    AuthGuard
];
//# sourceMappingURL=auth.routes.js.map