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
var header_component_1 = require("../header/header.component");
var form_group_component_1 = require("../../common/form-group/form-group.component");
var form_panel_component_1 = require("../../common/form-panel/form-panel.component");
var settings_form_1 = require("./settings-form");
var SettingsComponent = (function () {
    function SettingsComponent(form) {
        this.form = form;
    }
    SettingsComponent = __decorate([
        core_1.Component({
            templateUrl: './settings.html',
            directives: [
                header_component_1.HeaderComponent,
                form_group_component_1.FormGroupComponent,
                form_panel_component_1.FormPanelComponent,
            ],
            providers: [settings_form_1.SettingsForm],
        }), 
        __metadata('design:paramtypes', [settings_form_1.SettingsForm])
    ], SettingsComponent);
    return SettingsComponent;
}());
exports.SettingsComponent = SettingsComponent;
//# sourceMappingURL=settings.component.js.map