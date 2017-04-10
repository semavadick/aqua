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
var my_datatable_column_1 = require("../../common/my-datatable/my-datatable-column");
var my_datatable_component_1 = require("../../common/my-datatable/my-datatable.component");
var galleries_manager_1 = require("./galleries-manager");
var my_wysiwyg_component_1 = require("../../common/my-wysiwyg/my-wysiwyg.component");
var my_cropper_component_1 = require("../../common/my-cropper/my-cropper.component");
var gallery_form_1 = require("./gallery-form");
var form_group_component_1 = require("../../common/form-group/form-group.component");
var i18n_tabs_component_1 = require("../../common/i18n-tabs/i18n-tabs.component");
var i18n_checkbox_component_1 = require("../../common/i18n-checkbox/i18n-checkbox.component");
var my_checkbox_component_1 = require("../../common/my-checkbox/my-checkbox.component");
var gallery_images_component_1 = require("./gallery-images.component");
var multi_select_component_1 = require("../../common/multi-select/multi-select.component");
var ObjectGalleriesComponent = (function () {
    function ObjectGalleriesComponent(form, manager) {
        this.form = form;
        this.manager = manager;
        this.columns = [];
        var idColumn = new my_datatable_column_1.MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Название';
        nameColumn.attribute = 'name';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
        var nameColumn = new my_datatable_column_1.MyDatatableColumn();
        nameColumn.header = 'Кол-во фотографий';
        nameColumn.attribute = 'imagesCount';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
    }
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], ObjectGalleriesComponent.prototype, "i18ns", void 0);
    ObjectGalleriesComponent = __decorate([
        core_1.Component({
            templateUrl: './object-galleries.html',
            directives: [
                header_component_1.HeaderComponent, my_datatable_component_1.MyDatatableComponent,
                my_wysiwyg_component_1.MyWysiwygComponent, my_cropper_component_1.MyCropperComponent,
                form_group_component_1.FormGroupComponent, i18n_tabs_component_1.I18nTabsComponent,
                i18n_checkbox_component_1.I18nCheckbox, my_checkbox_component_1.MyCheckbox, gallery_images_component_1.GalleryImagesComponent,
                multi_select_component_1.MultiSelect,
            ],
            providers: [galleries_manager_1.GalleriesManager, gallery_form_1.GalleryForm],
        }), 
        __metadata('design:paramtypes', [gallery_form_1.GalleryForm, galleries_manager_1.GalleriesManager])
    ], ObjectGalleriesComponent);
    return ObjectGalleriesComponent;
}());
exports.ObjectGalleriesComponent = ObjectGalleriesComponent;
//# sourceMappingURL=object-galleries.component.js.map