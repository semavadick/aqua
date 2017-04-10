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
var general_form_1 = require("./general-form");
var form_panel_component_1 = require("../../../common/form-panel/form-panel.component");
var form_group_component_1 = require("../../../common/form-group/form-group.component");
var i18n_tabs_component_1 = require("../../../common/i18n-tabs/i18n-tabs.component");
var my_cropper_component_1 = require("../../../common/my-cropper/my-cropper.component");
var file_uploader_component_1 = require("../../../common/file-uploader/file-uploader.component");
var my_wysiwyg_component_1 = require("../../../common/my-wysiwyg/my-wysiwyg.component");
var GeneralComponent = (function () {
    function GeneralComponent(form) {
        this.form = form;
    }
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], GeneralComponent.prototype, "i18nTabs", void 0);
    GeneralComponent = __decorate([
        core_1.Component({
            selector: 'catalog-general',
            templateUrl: './general.html',
            directives: [
                form_group_component_1.FormGroupComponent,
                i18n_tabs_component_1.I18nTabsComponent,
                form_panel_component_1.FormPanelComponent,
                my_cropper_component_1.MyCropperComponent,
                file_uploader_component_1.FileUploaderComponent,
                my_wysiwyg_component_1.MyWysiwygComponent,
            ],
            providers: [
                general_form_1.GeneralForm
            ]
        }), 
        __metadata('design:paramtypes', [general_form_1.GeneralForm])
    ], GeneralComponent);
    return GeneralComponent;
}());
exports.GeneralComponent = GeneralComponent;
//# sourceMappingURL=general.component.js.map