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
var form_1 = require("../form");
var FormGroupComponent = (function () {
    function FormGroupComponent() {
        this.horizontal = true;
    }
    __decorate([
        core_1.Input(), 
        __metadata('design:type', form_1.Form)
    ], FormGroupComponent.prototype, "form", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], FormGroupComponent.prototype, "attribute", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], FormGroupComponent.prototype, "label", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Boolean)
    ], FormGroupComponent.prototype, "horizontal", void 0);
    FormGroupComponent = __decorate([
        core_1.Component({
            selector: 'form-group',
            templateUrl: './form-group.html'
        }), 
        __metadata('design:paramtypes', [])
    ], FormGroupComponent);
    return FormGroupComponent;
}());
exports.FormGroupComponent = FormGroupComponent;
//# sourceMappingURL=form-group.component.js.map