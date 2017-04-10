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
var web_user_1 = require('../../services/web-user');
var router_1 = require('@angular/router');
var NavbarComponent = (function () {
    function NavbarComponent(wUser, router, eref) {
        this.wUser = wUser;
        this.router = router;
        this.eref = eref;
        this.containerClassChanged = new core_1.EventEmitter();
        this.userDDOpened = false;
        this.mobileMenuOpened = false;
        this.mobileSidebarOpened = false;
        this.sidebarReduced = true;
    }
    NavbarComponent.prototype.logout = function () {
        var _this = this;
        this.wUser.logout()
            .then(function () {
            _this.router.navigate(['/auth/login']);
        })
            .catch(function (message) {
            alert(message);
        });
    };
    NavbarComponent.prototype.toggleUserDD = function () {
        this.userDDOpened = !this.userDDOpened;
    };
    NavbarComponent.prototype.onClick = function (event) {
        if (!this.eref.nativeElement.contains(event.target)) {
            this.userDDOpened = false;
        }
    };
    NavbarComponent.prototype.toggleMobileMenu = function () {
        this.mobileMenuOpened = !this.mobileMenuOpened;
    };
    NavbarComponent.prototype.toggleMobileSidebar = function () {
        this.mobileSidebarOpened = !this.mobileSidebarOpened;
        var className = this.mobileSidebarOpened ? 'sidebar-mobile-main' : '';
        this.containerClassChanged.emit(className);
    };
    NavbarComponent.prototype.closeMobileSidebar = function () {
        if (!this.mobileSidebarOpened) {
            return;
        }
        this.mobileSidebarOpened = false;
        var className = this.mobileSidebarOpened ? 'sidebar-mobile-main' : '';
        this.containerClassChanged.emit(className);
    };
    NavbarComponent.prototype.toggleSidebarMode = function () {
        this.sidebarReduced = !this.sidebarReduced;
        var className = this.sidebarReduced ? 'sidebar-xs' : '';
        this.containerClassChanged.emit(className);
    };
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], NavbarComponent.prototype, "containerClassChanged", void 0);
    NavbarComponent = __decorate([
        core_1.Component({
            selector: 'app-navbar',
            templateUrl: './navbar.html',
            directives: [router_1.ROUTER_DIRECTIVES],
            host: {
                '(document:click)': 'onClick($event)',
            },
        }), 
        __metadata('design:paramtypes', [web_user_1.WebUser, router_1.Router, (typeof (_b = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _b) || Object])
    ], NavbarComponent);
    return NavbarComponent;
    var _a, _b;
}());
exports.NavbarComponent = NavbarComponent;
//# sourceMappingURL=navbar.component.js.map