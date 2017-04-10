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
var FormButtonComponent = (function () {
    function FormButtonComponent() {
    }
    __decorate([
        core_1.Input(), 
        __metadata('design:type', form_1.Form)
    ], FormButtonComponent.prototype, "form", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], FormButtonComponent.prototype, "attribute", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', String)
    ], FormButtonComponent.prototype, "label", void 0);
    FormButtonComponent = __decorate([
        core_1.Component({
            selector: 'form-button',
            templateUrl: './form-button.html'
        }), 
        __metadata('design:paramtypes', [])
    ], FormButtonComponent);
    return FormButtonComponent;
}());
exports.FormButtonComponent = FormButtonComponent;
//# sourceMappingURL=form-button.component.js.map