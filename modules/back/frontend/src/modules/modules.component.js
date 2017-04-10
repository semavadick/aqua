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
var navbar_component_1 = require('./navbar/navbar.component');
var sidebar_component_1 = require('./sidebar/sidebar.component');
var ModulesComponent = (function () {
    function ModulesComponent() {
        this.containerClass = "sidebar-xs";
    }
    ModulesComponent.prototype.closeMobileSidebar = function () {
        this.navbar.closeMobileSidebar();
    };
    ModulesComponent.prototype.ngOnInit = function () {
        $('.page-container').css({
            minHeight: $(window).height() - $('.navbar').outerHeight()
        });
    };
    __decorate([
        core_1.ViewChild(navbar_component_1.NavbarComponent, undefined), 
        __metadata('design:type', navbar_component_1.NavbarComponent)
    ], ModulesComponent.prototype, "navbar", void 0);
    ModulesComponent = __decorate([
        core_1.Component({
            templateUrl: './modules.html',
            directives: [navbar_component_1.NavbarComponent, sidebar_component_1.SidebarComponent, router_1.ROUTER_DIRECTIVES],
        }), 
        __metadata('design:paramtypes', [])
    ], ModulesComponent);
    return ModulesComponent;
}());
exports.ModulesComponent = ModulesComponent;
//# sourceMappingURL=modules.component.js.map