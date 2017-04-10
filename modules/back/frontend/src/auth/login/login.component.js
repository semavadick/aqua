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
var login_form_1 = require("./login-form");
var LoginComponent = (function () {
    function LoginComponent(form, router, route) {
        this.form = form;
        this.router = router;
        this.route = route;
        this.returnUrl = null;
    }
    LoginComponent.prototype.login = function () {
        var _this = this;
        this.form.login()
            .then(function (message) {
            var url = _this.returnUrl ? _this.returnUrl : '/';
            _this.router.navigateByUrl(url);
        })
            .catch(function (message) {
            alert(message);
        });
    };
    LoginComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.route
            .params
            .subscribe(function (params) {
            var returnUrl = params['returnUrl'];
            if (returnUrl !== undefined) {
                _this.returnUrl = returnUrl;
            }
        });
    };
    LoginComponent = __decorate([
        core_1.Component({
            templateUrl: './login.html',
            providers: [login_form_1.LoginForm],
            directives: [router_1.ROUTER_DIRECTIVES]
        }), 
        __metadata('design:paramtypes', [login_form_1.LoginForm, router_1.Router, router_1.ActivatedRoute])
    ], LoginComponent);
    return LoginComponent;
}());
exports.LoginComponent = LoginComponent;
//# sourceMappingURL=login.component.js.map