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
var languages_manager_1 = require("../../../../services/languages-manager");
var my_grid_component_1 = require("../../../../common/my-grid/my-grid.component");
var form_group_component_1 = require("../../../../common/form-group/form-group.component");
var attribute_form_1 = require("./attribute-form");
var i18n_tabs_component_1 = require("../../../../common/i18n-tabs/i18n-tabs.component");
var ProductAttributesComponent = (function () {
    function ProductAttributesComponent(langsManager) {
        this.langsManager = langsManager;
        this.attributes = [];
    }
    ProductAttributesComponent.prototype.addAttribute = function () {
        this.attributes.push(new attribute_form_1.AttributeForm(this.langsManager));
    };
    ProductAttributesComponent.prototype.deleteAttribute = function (attribute) {
        if (confirm('Удалить характеристику?')) {
            var index = this.attributes.indexOf(attribute);
            this.attributes.splice(index, 1);
        }
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Array)
    ], ProductAttributesComponent.prototype, "attributes", void 0);
    ProductAttributesComponent = __decorate([
        core_1.Component({
            selector: 'product-attributes',
            templateUrl: './product-attributes.html',
            directives: [
                my_grid_component_1.MyGridComponent,
                form_group_component_1.FormGroupComponent,
                i18n_tabs_component_1.I18nTabsComponent,
            ]
        }), 
        __metadata('design:paramtypes', [languages_manager_1.LanguagesManager])
    ], ProductAttributesComponent);
    return ProductAttributesComponent;
}());
exports.ProductAttributesComponent = ProductAttributesComponent;
//# sourceMappingURL=product-attributes.component.js.map