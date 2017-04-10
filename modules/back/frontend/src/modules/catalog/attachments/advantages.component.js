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
var attachments_manager_1 = require("./attachments-manager");
var attachment_form_1 = require("./attachment-form");
var crud_grid_component_1 = require("../../../common/crud-grid/crud-grid.component");
var my_cropper_component_1 = require("../../../common/my-cropper/my-cropper.component");
var my_wysiwyg_component_1 = require("../../../common/my-wysiwyg/my-wysiwyg.component");
var i18n_tabs_component_1 = require("../../../common/i18n-tabs/i18n-tabs.component");
var i18n_checkbox_component_1 = require("../../../common/i18n-checkbox/i18n-checkbox.component");
var form_group_component_1 = require("../../../common/form-group/form-group.component");
var AttachmentsComponent = (function () {
    function AttachmentsComponent(manager, form) {
        this.manager = manager;
        this.form = form;
    }
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], AttachmentsComponent.prototype, "i18nTabs", void 0);
    AttachmentsComponent = __decorate([
        core_1.Component({
            selector: 'catalog-attachments',
            templateUrl: './attachments.html',
            directives: [
                crud_grid_component_1.CrudGridComponent,
                my_cropper_component_1.MyCropperComponent,
                my_wysiwyg_component_1.MyWysiwygComponent,
                i18n_tabs_component_1.I18nTabsComponent,
                i18n_checkbox_component_1.I18nCheckbox,
                form_group_component_1.FormGroupComponent,
            ],
            providers: [attachments_manager_1.AttachmentsManager, attachment_form_1.AttachmentForm],
        }), 
        __metadata('design:paramtypes', [attachments_manager_1.AttachmentsManager, attachment_form_1.AttachmentForm])
    ], AttachmentsComponent);
    return AttachmentsComponent;
}());
exports.AttachmentsComponent = AttachmentsComponent;
//# sourceMappingURL=advantages.component.js.map