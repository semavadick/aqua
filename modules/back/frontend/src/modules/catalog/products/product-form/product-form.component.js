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
var product_form_1 = require("./product-form");
var i18n_tabs_component_1 = require("../../../../common/i18n-tabs/i18n-tabs.component");
var i18n_checkbox_component_1 = require("../../../../common/i18n-checkbox/i18n-checkbox.component");
var form_group_component_1 = require("../../../../common/form-group/form-group.component");
var form_button_component_1 = require("../../../../common/form-button/form-button.component");
var my_cropper_component_1 = require("../../../../common/my-cropper/my-cropper.component");
var my_wysiwyg_component_1 = require("../../../../common/my-wysiwyg/my-wysiwyg.component");
var my_grid_component_1 = require("../../../../common/my-grid/my-grid.component");
var product_images_component_1 = require("./product-images.component");
var product_attributes_component_1 = require("./product-attributes.component");
var related_products_component_1 = require("./related-products.component");
var my_checkbox_component_1 = require("../../../../common/my-checkbox/my-checkbox.component");
var file_uploader_component_1 = require("../../../../common/file-uploader/file-uploader.component");
var multi_select_component_1 = require("../../../../common/multi-select/multi-select.component");
var ProductFormComponent = (function () {
    function ProductFormComponent() {
    }
    ProductFormComponent.prototype.initI18ns = function () {
        this.i18nTabs.init(this.form);
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', product_form_1.ProductForm)
    ], ProductFormComponent.prototype, "form", void 0);
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], ProductFormComponent.prototype, "i18nTabs", void 0);
    ProductFormComponent = __decorate([
        core_1.Component({
            selector: 'product-form',
            templateUrl: './product-form.html',
            directives: [
                i18n_tabs_component_1.I18nTabsComponent,
                i18n_checkbox_component_1.I18nCheckbox,
                form_group_component_1.FormGroupComponent,
                form_button_component_1.FormButtonComponent,
                my_cropper_component_1.MyCropperComponent,
                my_wysiwyg_component_1.MyWysiwygComponent,
                my_grid_component_1.MyGridComponent,
                product_images_component_1.ProductImagesComponent,
                product_attributes_component_1.ProductAttributesComponent,
                related_products_component_1.RelatedProductsComponent,
                my_checkbox_component_1.MyCheckbox,
                file_uploader_component_1.FileUploaderComponent,
                multi_select_component_1.MultiSelect,
            ],
        }), 
        __metadata('design:paramtypes', [])
    ], ProductFormComponent);
    return ProductFormComponent;
}());
exports.ProductFormComponent = ProductFormComponent;
//# sourceMappingURL=product-form.component.js.map