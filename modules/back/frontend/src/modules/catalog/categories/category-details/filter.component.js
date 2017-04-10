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
var i18n_tabs_component_1 = require("../../../../common/i18n-tabs/i18n-tabs.component");
var form_group_component_1 = require("../../../../common/form-group/form-group.component");
var filter_form_1 = require("./filter-form");
var FilterComponent = (function () {
    function FilterComponent() {
        this.onDelete = new core_1.EventEmitter();
    }
    FilterComponent.prototype.ngOnInit = function () {
        this.i18ns.init(this.form);
    };
    FilterComponent.prototype.deleteFilter = function () {
        if (confirm('Удалить фильтр?')) {
            this.onDelete.emit(this.form);
        }
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', filter_form_1.FilterForm)
    ], FilterComponent.prototype, "form", void 0);
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], FilterComponent.prototype, "i18ns", void 0);
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], FilterComponent.prototype, "onDelete", void 0);
    FilterComponent = __decorate([
        core_1.Component({
            selector: 'category-filter',
            templateUrl: './filter.html',
            directives: [
                i18n_tabs_component_1.I18nTabsComponent,
                form_group_component_1.FormGroupComponent,
            ],
        }), 
        __metadata('design:paramtypes', [])
    ], FilterComponent);
    return FilterComponent;
    var _a;
}());
exports.FilterComponent = FilterComponent;
//# sourceMappingURL=filter.component.js.map