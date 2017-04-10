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
var i18n_form_1 = require("../i18n-form");
var I18nCheckbox = (function () {
    function I18nCheckbox(eRef) {
        this.eRef = eRef;
        this.form = null;
        this.oldValue = null;
    }
    I18nCheckbox.prototype.toggle = function (value) {
        this.form.saveI18n = value;
        this.toggleFormGroups();
    };
    I18nCheckbox.prototype.ngDoCheck = function () {
        if (this.oldValue !== this.form.saveI18n) {
            this.oldValue = this.form.saveI18n;
            this.toggleFormGroups();
        }
    };
    I18nCheckbox.prototype.toggleFormGroups = function () {
        var groups = this.eRef.nativeElement.parentElement.querySelectorAll('form-group');
        var className = this.form.saveI18n ? '' : 'disabled';
        for (var _i = 0, groups_1 = groups; _i < groups_1.length; _i++) {
            var group = groups_1[_i];
            group.setAttribute('class', className);
        }
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', i18n_form_1.I18nForm)
    ], I18nCheckbox.prototype, "form", void 0);
    I18nCheckbox = __decorate([
        core_1.Component({
            selector: 'i18n-checkbox',
            template: "\n        <div class=\"form-group\">\n            <div class=\"checkbox\">\n                <label>\n                    <div class=\"checker border-primary-600 text-primary-800\">\n                        <span [class.checked]=\"form.saveI18n\">\n                            <input type=\"checkbox\" class=\"control-primary\" [ngModel]=\"form.saveI18n\" (ngModelChange)=\"toggle($event)\">\n                        </span>\n                    </div>\n                    \u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u044F\u0437\u044B\u043A\n                </label>\n            </div>\n        </div>\n    ",
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], I18nCheckbox);
    return I18nCheckbox;
    var _a;
}());
exports.I18nCheckbox = I18nCheckbox;
//# sourceMappingURL=i18n-checkbox.component.js.map