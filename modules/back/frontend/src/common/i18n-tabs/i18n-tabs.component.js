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
var entity_form_1 = require("../entity-form");
var I18nTabsComponent = (function () {
    function I18nTabsComponent(eRef) {
        this.eRef = eRef;
        this.forms = [];
        this.entityForm = null;
        this.activeForm = null;
    }
    I18nTabsComponent.prototype.ngOnInit = function () {
        if (this.entityForm) {
            this.init(this.entityForm);
        }
    };
    I18nTabsComponent.prototype.ngAfterViewChecked = function () {
        // Ставим классы табам
        var tabs = this.eRef.nativeElement.querySelector('.tab-content').children;
        if (!this.forms.length || !tabs.length) {
            return;
        }
        var formIndex = this.forms.indexOf(this.activeForm);
        var tabIndex = 0;
        for (var _i = 0, tabs_1 = tabs; _i < tabs_1.length; _i++) {
            var tab = tabs_1[_i];
            var active = tabIndex == formIndex;
            var className = 'tab-pane has-padding';
            if (tabIndex == formIndex) {
                className += ' active';
            }
            tab.setAttribute('class', className);
            tabIndex++;
        }
    };
    I18nTabsComponent.prototype.init = function (entityForm) {
        this.entityForm = entityForm;
        this.forms = entityForm.getI18ns();
        if (!this.forms.length) {
            return;
        }
        this.activeForm = this.forms[0];
    };
    I18nTabsComponent.prototype.selectForm = function (form) {
        this.activeForm = form;
    };
    I18nTabsComponent.prototype.isFormSelected = function (form) {
        return this.activeForm && this.activeForm.language.id == form.language.id;
    };
    I18nTabsComponent.prototype.hasGeneralError = function () {
        return this.entityForm && this.entityForm.hasI18nGeneralError();
    };
    I18nTabsComponent.prototype.getGeneralError = function () {
        if (!this.entityForm) {
            return null;
        }
        return this.entityForm.getI18nGeneralError();
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', entity_form_1.EntityForm)
    ], I18nTabsComponent.prototype, "entityForm", void 0);
    I18nTabsComponent = __decorate([
        core_1.Component({
            selector: 'i18n-tabs',
            templateUrl: './i18n-tabs.html'
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], I18nTabsComponent);
    return I18nTabsComponent;
    var _a;
}());
exports.I18nTabsComponent = I18nTabsComponent;
//# sourceMappingURL=i18n-tabs.component.js.map